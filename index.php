<?php
include('./core.php');
header('Content-Type: text/html; charset= utf-8');

$db=core::loadModule('mysql','db');
$db->connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_CHARSET);
$news=core::loadModule('news');
?>
