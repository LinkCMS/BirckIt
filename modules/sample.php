<?php
class demo extends core implements IModule
{
	var $info;
	function main()
	{
		$this->info['name']='demo';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='Demo module';
		return 0;
	}
}
?>
