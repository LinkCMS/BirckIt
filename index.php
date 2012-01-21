<?php
include('./core.php');
header('Content-Type: text/html; charset= utf-8');

$db=core::loadModule('mysql','db');
$db->connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_CHARSET);

core::loadModule('parser');
//core::loadModule('demo');

core::loadModule('test');

/*
$db=core::loadModule('mysql','db');
$db->connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_CHARSET);
$tpl=core::loadModule('parser');
$tpl->loadTpl('main.tpl');

$test=core::loadModule('demo');

$news=core::loadModule('news');
$tpl->tpl();
*/
?>
