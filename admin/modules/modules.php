<?php
class modules extends core implements IModule
{
	var $info;
	function main()
	{
		$this->info['name']='modules';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='List of existing modules';
		
		core::getModule('menu')->add('Управление модулями','index.php?action=modules');
		if(@$_GET['action']=='modules')
		{
			$tpl=core::loadModule('parser');
			$tpl->loadTpl('modules.tpl');
			
			$modules=null;
			foreach(Registry::$data as $alias=>$module)
			{
				$mod_tpl=core::loadModule('parser');
				$mod_tpl->loadTpl('module_list.tpl');
				$mod_tpl->parse('{MODULE}',$module->info['name']);
				$mod_tpl->parse('{AUTHOR}',$module->info['author']);
				$mod_tpl->parse('{VERSION}',$module->info['version']);
				$mod_tpl->parse('{DESCRIPTION}',$module->info['description']);
				$mod_tpl->parse('{ALLIAS}',$alias);
				$modules.=$mod_tpl->tpl;
			}
			/*
			$install=core::loadModule('parser');
			$install->loadTpl('module_install.tpl');
			$install=$install->tpl;			

			$modules=null;
			foreach(Registry::$data as $alias=>$module)
			{
				$tpl=core::loadModule('parser');
				$tpl->loadTpl('module_list.tpl');
				$tpl->parse('{MODULE}',$module->info['name']);
				$tpl->parse('{AUTHOR}',$module->info['author']);
				$tpl->parse('{VERSION}',$module->info['version']);
				$tpl->parse('{DESCRIPTION}',$module->info['description']);
				$tpl->parse('{ALLIAS}',$alias);
				$modules.=$tpl->tpl;
			}
			core::getModule('main_tpl')->parse('{CONTENT}',$install.$modules);
			*/
			$tpl->parse('{MODULES}',$modules);
			core::getModule('main_tpl')->parse('{CONTENT}',$tpl->tpl);
		}
		
		return 0;
	}
}
?>
