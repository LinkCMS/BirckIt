<html>
<head>
	<title>Администрирование</title>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="tpl/style.css" rel="stylesheet" />
</head>
<body>
	<div id="menu">
		<img src="img/logo1.jpg" id="logo" />
		{MENU}
	</div>

	<div id="main">
		<div id="user">
			<span>Вы вошли, как: <b>{USERNAME}</b>. (<a href="index.php?action=exit">Выйти</a>)</span>
		</div>
		<div id="content">
			{CONTENT}
		</div>
	</div>
</body>
</html>
