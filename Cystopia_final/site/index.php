<?php


if (!isset($_SESSION))
{
    session_start();
}

if (isset($_GET['logout']) && $_GET['logout'] == 1)
{
    session_destroy();
    header('location:.');
    exit;
}

require 'config.php';

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


try
{
    // initialisaton par défaut des controleurs et actions + merge si nouveau GET.
    $params = array_merge(array('control' => 'login', 'action' => 'home'), $_GET);
    $params = array_merge($params, $_POST);


    //récup du nom du controleur en GET.
    $control = $params['control'] . 'Controller';

    if(file_exists('controllers/' . $control . '.php'))
    {
        // Instance du controleur appelé en GET.
        $controller = new $control();
        $controller->setParams($_GET);
        $controller->setData($_POST);

        // Appel de la méthode d'action appelée en GET dans le controleur.
        $controller->CallAction($params['action']);
    }
    else
    {
        include 'views'.DIRECTORY_SEPARATOR.'errors'.DIRECTORY_SEPARATOR.'404.php';
    }
}
catch (Exception $e)
{
    //log erreurs
}



