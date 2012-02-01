<?php
class groups extends core implements IModule
{
	var $info;
	
	function main()
	{
		$this->info['name']='groups';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='Users and groups managment';
		
		core::getModule('menu')->add('Управление группами','index.php?action=groups');
		
		if($_GET['action']=='groups')
		{
			$query=core::getModule('db')->query('SELECT * FROM `groups` ORDER BY `id` DESC');
			
			$tpl=core::loadModule('parser');
			$tpl->loadTpl('table.tpl');
			
			$groups=null;
			while($group=mysql_fetch_array($query,MYSQL_ASSOC))
			{
				$groups.=$group['name'].'<br>';
			}
			core::getModule('main_tpl')->parse('{CONTENT}',$tpl->tpl);
		}
		return 0;
	}
}

class users extends groups
{

}
?>
