<?php

/**
 * Application specific autoloader
 */
function appAutoloader($class)
{
	$pos = strpos($class, 'stdClass');
	if ($pos == false) {
		$classWithPath = __DIR__. '/' . str_replace('\\', '/', $class) . '.php';
		require($classWithPath);
	}
}

spl_autoload_register('appAutoloader');

?>