<?php
class parser extends core implements IModule
{
	var $tpl_dir;
	var $tpl_name;
	var $tpl;
	var $info;

	function main($tpl=null)
	{
		//$this->tpl_dir='';
		$this->info['name']='parser';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='Simple templater module';
		
		if(@$tpl[1])
		$this->loadTpl($tpl[1]);
		
		return 0;
	}

	function loadTpl($tpl)
	{
		if($tpl)
		{
			if(!$this->tpl=file_get_contents($this->tpl_dir.$tpl))
			echo 'Ошибка загрузки шаблона '.$this->tpl_dir.$tpl.'<br>';
			else
			$this->tpl_name=$tpl;	
		}
	}

	function parse($var,$value)
	{
		$this->tpl=str_replace($var,$value,$this->tpl);
	}

	function tpl()
	{
		echo $this->tpl;
	}
}
?>
