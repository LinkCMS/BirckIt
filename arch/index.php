<?php
if($_GET['action']=='pack')
{
$modname=$_GET['module'];
$phar=new Phar('../modules/'.$modname.'.phar');

$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./files/'.$modname));

foreach($dir as $file) {
    if(!strrpos($file,'/.'))
    $files[]=$file;
}
$phar->buildFromIterator(new ArrayIterator($files),'/var/www/LinkCMS/arch/files/'.$modname);
}
elseif($_GET['action']=='unpack')
{
$modname=$_GET['module'];
$phar=new Phar('./'.$modname.'.phar');
//$phar->compressFiles(Phar::GZ);
$phar->ConvertToData(Phar::ZIP,Phar::NONE,'.zip');
//echo $phar['index.php'];
//echo file_get_contents('phar://'.$modname.'.phar/index.php');
}
?>
