<?php
include('./interfaces.php');
include('./config.php');

function __autoload($class)
{
	if(file_exists(MOD_DIR.$class.'.php'))
    include(MOD_DIR.$class.'.php');
    else
    {
		core::loadModule('panic',$class,200,'Ошибка загрузки модуля "'.$class.'". Такого файла не существует');
		exit();
	}
}

class Registry
{
	static private $data = array();
	static public function set($key, $value) 
	{
		self::$data[$key] = $value;
	}
	static public function get($key)
	{
		$alias=@self::$data[$key];
		if(!$alias)
		core::loadModule('panic',$key,300,'Ошибка обращения к алиасу "'.$key.'". Данный алиас не зарегистрирован');
		return $alias;
	}
	static public function remove($key)
	{
		if (isset(self::$data[$key]))
		unset(self::$data[$key]);
	}
}

abstract class core {
	
	function getModule($allias)
	{
		return Registry::get($allias);
	}
	
	function loadModule($module,$allias=NULL)
	{	
		$mod=new $module;
		$headers = array('name','version','author','description');
		
		($allias)?Registry::set($allias,$mod):Registry::set($module,$mod);
		
		try
		{
			if($error=$mod->main(func_get_args()))
			throw new Exception('Функция main() выполнилась с ошибкой',$error);
			else
			if($diff=array_diff(array_values($headers),array_keys($mod->info)))
			throw new Exception('Ошибка инициализации модуля. Отсутствуют заголовки: <b>'.implode(', ',$diff).'</b>',100);
		}
		catch(Exception $e)
		{
			self::load_module('panic',$module,$e->getCode(),$e->getMessage());
		}
		
		return $mod;
	}
	
}
?>
