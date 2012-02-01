<?php
class parser extends core implements IModule
{
	var $tpl_dir='./tpl/';
	var $tpl_name;
	var $tpl;
	var $info;

	function main($tpl=null)
	{
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
			{
			$this->tpl_name=$tpl;
			
			if(preg_match_all('^({!include..(.*)...)^',$this->tpl,$includes))
			{
				foreach($includes[2] as $id=>$inc)
				{
					if(file_exists('./tpl/'.$inc))
					{
						$tpl=new parser();
						$tpl->loadTpl($inc);
						$this->parse($includes[0][$id],$tpl->tpl);
					}
				}
			}
			
			}
		}
	}

	function parse($var,$value)
	{		
		if(preg_match('^'.$var.'\(\'(.*)\'\)^',$this->tpl,$ret))
		{
		echo 'Итератор: '.$ret[0].'<br>Шаблон: '.$ret[1];
		$this->tpl=str_replace($ret[0],$value,$this->tpl);
		return $ret[1];
		}
		
		$this->tpl=str_replace($var,$value,$this->tpl);
	}

	function tpl()
	{
		echo $this->tpl;
	}
}
?>
