<?php
include(__DIR__.'/interfaces.php');
include(__DIR__.'/config.php');

function __autoload($class)
{
	if(file_exists(MOD_DIR.$class.'.php')) // Проверяем наличие файла относительно текущей папки
    include(MOD_DIR.$class.'.php');
    elseif(file_exists('../'.MOD_DIR.$class.'.php')) // Если нет, спускаемся на уровень ниже и пытаемся найти там
    include('.'.MOD_DIR.$class.'.php');
	/*
	if(file_exists(MOD_DIR.$class.'.phar')) // Проверяем наличие файла относительно текущей папки
    include(MOD_DIR.$class.'.phar');
    elseif(file_exists('../'.MOD_DIR.$class.'.phar')) // Если нет, спускаемся на уровень ниже и пытаемся найти там
    include('.'.MOD_DIR.$class.'.phar');
    */
    else
    {
		core::loadModule('panic',$class,200,'Ошибка загрузки модуля "'.$class.'". Такого файла не существует');
		exit();
	}
}

class Registry
{
	//static private $data = array();
	static $data = array();
	static public function set($key, $value) 
	{
		self::$data[$key] = $value;
	}
	static public function get($key)
	{
		$alias=@self::$data[$key];
		if(!$alias)
		core::loadModule('panic',$key,300,'Ошибка обращения к алиасу "'.$key.'". Данный аллиас не зарегистрирован');
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
	
	function loadModule($module,$allias=null,$args=null)
	{	
		$mod=new $module;
		$headers = array('name','version','author','description');
		
		($allias)?Registry::set($allias,$mod):Registry::set($module,$mod);
		
		try
		{
			if($error=$mod->main(array_slice(func_get_args(),2)))
			throw new Exception('Функция main() выполнилась с ошибкой',$error);
			else
			{
			(@$mod->info)?$info=array_keys($mod->info):$info=array();
			if($diff=array_diff(array_values($headers),$info))
			throw new Exception('Ошибка инициализации модуля. Отсутствуют заголовки: <b>'.implode(', ',$diff).'</b>',100);
			}
		}
		catch(Exception $e)
		{
			self::loadModule('panic',$module,$e->getCode(),$e->getMessage());
		}
		
		return $mod;
	}
	
}
?>
