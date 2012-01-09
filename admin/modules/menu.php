<?php
class menu extends core implements module
{
	var $items;
	function main()
	{
		$module['name']='Menu';
		$module['version']='0.1';
		$module['author']='Link';
		$module['description']='Menu sample';
		return $module;
	}
	function add($title,$url)
	{
		$this->items[]='<a href="'.$url.'">'.$title.'</a>';
	}
}
?>
