<?php

define('MYSQL_HOST', 'localhost');
define('MYSQL_NAME', 'Cystopia2');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');


spl_autoload_register(function($class)
{
	$folder = 'classes';

	if (strpos($class, 'Model'))
	{
		$folder = 'models';
	}
	elseif (strpos($class, 'Controller'))
    {
		$folder = 'controllers';
	}
	else
    {
		$class = strtolower($class);
	}

	$file = '.'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$class.'.php';
	
	if (file_exists($file)) 
	{
		require $file;
	}
});


if (!isset($_SESSION)) session_start();

if (isset($_GET['logout']) && $_GET['logout'] == 1)
{
	 unset($_SESSION['CY']);
	 unset($_SESSION['Error']);
}
