<?php

spl_autoload_register(function($class) {
	if(file_exists('../app/'.str_replace('\\', '/', $class).'.php')) {
		require '../app/'.str_replace('\\', '/', $class).'.php';
	} elseif (file_exists('../' . str_replace('\\', '/', $class) . '.php')) {
		include '../' . str_replace('\\', '/', $class) . '.php';
	}
});

?>