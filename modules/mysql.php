<?php
class mysql extends core implements IModule, IDb
{
	var $info;
	private static $instance;
	static $db;
	
	//private function __construct() { }
	
	function main()
	{
		$this->info['name']='mysql';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='MySQL database module';
		return 0;
	}
	static function connect($host,$user,$pass,$db,$charset)
	{
		self::$db=mysql_connect($host,$user,$pass);
		mysql_select_db($db);
		self::query('SET NAMES '.$charset);
		//echo 'asd';
	}
	static function query($query)
	{
		return mysql_query($query);
	}
	static function getInstance()
	{
		if(is_null(self::$instance))
		self::$instance=new self();
		return self::$instance;
	}
}
?>
