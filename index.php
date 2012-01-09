<?php
include('./core.php');
header('Content-Type: text/html; charset= utf-8');

//$db=core::load_module('mysql');
//Registry::set('db',core::load_module('mysql'));
$db=core::loadModule('mysql','db');
//$test=core::loadModule('test');
$test=core::loadModule('news');

//print_r($GLOBALS);
//echo core::$db->connect();
?>
