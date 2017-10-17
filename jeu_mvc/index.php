<?php

require 'config.php'; // config de base + autoload

// initialisaton par défaut des controleurs et actions + merge si nouveau GET.
$params = array_merge(array('control' => 'login', 'action' => 'display'), $_GET);
$params = array_merge($params, $_POST);

//récup du nom du controleur dans le GET.
$control = $params['control'].'Controller';


//Appel du fichier du controleur
require 'controllers/'.$control.'.php';


// Instance du controleur appelé en GET.
$controller = new $control();

$controller->setParams($_GET);
$controller->setData($_POST);

// Appel de la méthode d'action appelée en GET dans le controleur.
$controller->CallAction($params['action']);

// var_dump($params);