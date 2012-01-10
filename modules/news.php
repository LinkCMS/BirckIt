<?php
class news extends core implements IModule
{
	var $info;
	function main()
	{
		$this->info['name']='news';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='Модуль вывода новостей';
		$this->getItems();
		return 0;
	}
	function getItems($count=10)
	{
		core::getModule('db')->query('SELECT * FROM `news`');
		
	}
}
?>
