<?php
class panic extends core implements IModule
{
	function main($args=NULL,$halt=true)
	{
		
		$this->info['name']='panic';
		$this->info['version']='0.1';
		$this->info['author']='Link';
		$this->info['description']='Обрабатывает исключительные ситуации, формирует и выводит ошибки';
		
		$style='<style>
		.panic {
			background-color:#FF8585;
			border:1px dashed #FF0000;
			padding:10px;
		}
		</style>';
		$div='<div class="panic">При выполнении модуля "'.$args[1].'" возникла ошибка №'.$args[2].':<br>
		<i>'.$args[3].'</i>
		</div>';
		echo $style.$div;
		
		if($halt)
		exit();
		
		return 0;
	}
}
?>
