<?php
class mysql extends core implements IModule, IDb
{
	var $info;
	static $db;

	function main()
	{
		$this->info['name']='mysql';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='MySQL database module';
		return 0;
	}
	function connect($host,$user,$pass,$db,$charset)
	{
		if(!self::$db=@mysql_connect($host,$user,$pass))
		core::loadModule('panic',$this->info['name'],500,'Ошибка подключения к базе данных');
		if(!@mysql_select_db($db))
		core::loadModule('panic',$this->info['name'],501,'Ошибка выбора базы данных');
		self::query('SET NAMES '.$charset);
	}
	function query($query)
	{
		return mysql_query($query);
	}
}
?>
