<?php
class users extends core implements IModule
{
	var $info;
	function main()
	{
		$this->info['name']='users';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='User managment';
		
		core::getModule('menu')->add('Управление пользователями','index.php?action=users');
		return 0;
	}
}
?>
