<?php
interface IModule {
	function main();
}

interface IDb {
	function connect($host,$user,$pass,$db,$charset);
	function query($query);
}
?>
