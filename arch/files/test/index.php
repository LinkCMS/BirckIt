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
		$tpl->loadTpl(__DIR__.'/tpl/main.tpl');
		$tpl->parse('{TEST}','Шаблон, загруженный из упакованного модуля');
		$tpl->tpl();
		
		return 0;
	}
}
?>
