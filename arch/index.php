<?php
$modules=null;
foreach(scandir('./files') as $mod)
{
	if($mod!='.' && $mod!='..' && $mod!='admin')
	$modules.='<option value='.$mod.'>'.$mod.'</option>';
}
?>
<html>
<head>
<title>Архиватор модулей</title>
<meta charset="utf-8">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('select[name="type"]').change(function(){
			$.ajax({
				url: "ajax.php",
				type: "GET",
				data: "type="+$('select[name="type"]').val(),
				success: function(data){
					$('select[name="module"]').html(data);
				}
			});
		})
			
		$('button').click(function(){
			$.ajax({
				url: "ajax.php",
				type: "POST",
				data: "type="+$('select[name="type"]').val()+"&module="+$('select[name="module"]').val()+"&action="+$('select[name="action"]').val(),
				success: function(data){
					$('button').fadeTo('slow',0.5);
					$('button').fadeTo('slow',1);
					//$('button').css('background-color','#00ff00');
				}
			});
			return 0;
		})
			
		});
</script>
</head>
<body>
	<form method="get" action="index.php">
		Операция:<br>
		<select name="action">
			<option value="pack">Упаковать</option>
			<option value="unpack">Распаковать</option>
		</select><br>
		Тип:<br>
		<select name="type">
			<option></option>
			<option value="admin">Администраторский</option>
			<option value="debug">Отладочный</option>
		</select><br>
		Модуль:<br>
		<select name="module">
			<option></option>
			<?=$modules?>
		</select><br>
		<button type="button">Отправить</button>
	</form>
</body>
</html>
