<?php

spl_autoload_register(function($class) {
	$path = '..'.DS.'app'.DS . str_replace('\\', DS, $class) . '.php';
	if (file_exists($path)) {
		include $path;
	}
});

?>