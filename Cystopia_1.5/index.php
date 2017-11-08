<?php


require 'config.php'; // config de base + autoload

// initialisaton par défaut des controleurs et actions + merge si nouveau GET.
$params = array_merge(array('control' => 'login', 'action' => 'display'), $_GET);
$params = array_merge($params, $_POST);

// echo "PARAMS > <br>".

//var_dump($_SESSION);
if(isset( $params['choix_hero'])){
    $_SESSION['choix_hero'] = $params['choix_hero'];
}


foreach ( $params as $key => $val) {

    if ( 18 == strlen($key)){
        $key = substr($key, 0, -1);}

    if ( 19 == strlen($key)){
        $key = substr($key, 0, -2);}

    if ( 20 == strlen($key )){
        $key = substr($key, 0, -3);}

    if ($key === 'choix_cartes_team') {
        $choix_carte_team[] = $val;
    }
}

if( isset($choix_carte_team) )
{
    $_SESSION['choix_cartes_team'] = $choix_carte_team;
}

if( isset($params['idDeckDisplay'] ))
{
    $_SESSION['idDeckDisplay'] = $params['idDeckDisplay'] ;
}



//var_dump($_SESSION);
//var_dump($params);


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


