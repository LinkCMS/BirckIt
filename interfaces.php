<?php
interface IModule {
	function main();
}

interface IDb {
	static function connect();
}
?>
