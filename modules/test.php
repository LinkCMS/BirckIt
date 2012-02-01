<?php
class test extends core implements IModule
{
	var $info;
	function main()
	{
		$this->info['name']='test';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='Тест пакетных модулей, с использованием ресурсов';
		
		$tpl=core::getModule('parser');
		$tpl->loadTpl('main.tpl');
		$tpl->parse('{TEST}','Просто файл');
		$tpl->tpl();
		
		return 0;
	}
}
?>
