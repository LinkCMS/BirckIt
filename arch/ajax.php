<?php
function getUser(&$modules)
{
	foreach(scandir('./files') as $mod)
	{
		if($mod!='.' && $mod!='..' && $mod!='admin')
		$modules.='<option value='.$mod.'>'.$mod.'</option>';
	}
}
function getAdmin(&$modules)
{
	foreach(scandir('./files/admin') as $mod)
	{
		if($mod!='.' && $mod!='..')
		$modules.='<option value='.$mod.'>'.$mod.'</option>';
	}
}

if(isset($_GET))
{
$modules='<option></option>';

if(!@$_GET['type'])
getUser($modules);
elseif($_GET['type']=='admin')
getAdmin($modules);
else
{
getUser($modules);
$modules.='<option>---ADMIN---</option>';
getAdmin($modules);
}

echo $modules;
}

if(isset($_POST))
{
	if(@$_POST['action']=='pack')
	{
	$modname=$_POST['module'];
	$type=$_POST['type'];
	$admin=null;

	switch($type)
	{
		case 'debug':$file='./'.$modname.'.phar.zip';break;
		case 'admin':$file='../admin/modules/'.$modname.'.phar';$admin='admin/';break;
		default:$file='../modules/'.$modname.'.phar';
	}

	$phar=new Phar($file);

	$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./files/'.$admin.$modname));

	foreach($dir as $file) {
		if(!strrpos($file,'/.'))
		$files[]=$file;
	}
	$phar->buildFromIterator(new ArrayIterator($files),'/var/www/LinkCMS/arch/files/'.$admin.$modname);
	}
	elseif(@$_POST['action']=='unpack')
	{
	$modname=$_POST['module'];
	$phar=new Phar('./'.$modname.'.phar');
	$phar->ConvertToData(Phar::ZIP,Phar::NONE,'.zip');
	}
}
?>
