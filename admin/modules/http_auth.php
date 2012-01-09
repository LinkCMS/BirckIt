<?php
class http_auth extends core implements module
{
	function main()
	{
		$module['name']='HTTP Authentication';
		$module['version']='0.1';
		$module['author']='Link';
		$module['description']='Basic access authentication';
		return $module;
	}
	
	function login()
	{
			$realm = 'Запретная зона';
			header('Content-type:text/html; charset="utf-8"');
			
			if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
				header('HTTP/1.1 401 Unauthorized');
				header('WWW-Authenticate: Digest realm="'.$realm.
					   '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');

				die('Текст, посылаемый, если пользователь нажал Cancel');
			}

			//echo $_SERVER['PHP_AUTH_DIGEST'];
			$user=$this->http_digest_parse($_SERVER['PHP_AUTH_DIGEST']);
			//echo $user['username'];
			//header('HTTP/1.1 401 Unauthorized');
			// анализируем переменную PHP_AUTH_DIGEST
			$t=new mysql();
			$t->connect('localhost','root','321vecrek67','radio');
			$query=$t->query('SELECT * FROM `users` WHERE `name`="'.$user['username'].'"');
			//$login_from_db = $t->fetch_row($query);
			$login_from_db = mysql_fetch_assoc($query);

			if (!$user || !$login_from_db)
			{
				//header('HTTP/1.1 401 Unauthorized');
				die('Неправильные данные!');
			}

			// генерируем корректный ответ
			$A1 = md5($user['username'] . ':' . $realm . ':' . $login_from_db['pass']);
			$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$user['uri']);
			$valid_response = md5($A1.':'.$user['nonce'].':'.$user['nc'].':'.$user['cnonce'].':'.$user['qop'].':'.$A2);

			if ($user['response'] != $valid_response)
				die('Неправильные данные!');

			// ok, логин и пароль верны
			//echo 'Вы вошли как: ' . $user['username'];
			return $user['username'];
	}
			// функция разбора заголовка http auth
			function http_digest_parse($txt)
			{
				// защита от отсутствующих данных
				$needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
				$data = array();
				$keys = implode('|', array_keys($needed_parts));

				preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

				foreach ($matches as $m) {
					$data[$m[1]] = $m[3] ? $m[3] : $m[4];
					unset($needed_parts[$m[1]]);
				}

				return $needed_parts ? false : $data;
			}
}
?>
