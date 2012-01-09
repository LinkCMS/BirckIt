<?php
include('../config.php');
include('../core.php');

$db=core::load_module('mysql','../modules/');
$db->connect('localhost','root','321vecrek67','radio');

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
?>
