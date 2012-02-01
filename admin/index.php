<?php
//include('../config.php');
include('../core.php');
header('Content-Type: text/html; charset= utf-8');

$db=core::loadModule('mysql','db');
$db->connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_CHARSET);

$menu=core::loadModule('menu');
$tpl=core::loadModule('parser','main_tpl');
$tpl->loadTpl('main.tpl');

$users=core::loadModule('groups');

$modules=core::loadModule('modules');
$tpl->parse('{USERNAME}','demo');
$tpl->parse('{MENU}',implode('<br />',$menu->items));

$tpl->tpl();
/*
$menu=core::loadModule('menu');

$login=core::loadModule('http_auth');
$tpl=core::loadModule('parser','main_tpl');
$tpl->loadTpl('main.tpl');
$modules=core::loadModule('modules');
$tpl->parse('{USERNAME}','demo');
$tpl->parse('{MENU}',implode('<br />',$menu->items));
$tpl->tpl();
*/

//$user=$login->login();
/*
$login=core::load_module('http_auth');
$user=$login->login();

$tpl=core::load_module('parser','../modules/');
$tpl->load_tpl('main.tpl');
$tpl->parse('{USERNAME}',$user);

$menu=core::load_module('menu');
$menu->add('Управление модулями','index.php?action=modules');
$menu->add('Управление модулями','index.php?action=modules');

$tpl->parse('{MENU}',implode('<br />',$menu->items));

$tpl->tpl();
*/
?>
