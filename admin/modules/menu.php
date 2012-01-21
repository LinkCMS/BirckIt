<?php
class menu extends core implements IModule
{
	var $items;
	var $info;
	function main()
	{
		$this->info['name']='menu';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='Admin menu';
		return 0;
	}
	function add($title,$url)
	{
		$this->items[]='<a href="'.$url.'">'.$title.'</a>';
	}
}
?>
