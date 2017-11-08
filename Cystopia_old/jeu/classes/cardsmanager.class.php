<?php
spl_autoload_register(function($class){
require 'classes/'.$class.'.class.php';
});


class CardsManager {
    
    public function getCardById($id) {
    	$data=array();
        if(($load = SQL::getInst()->makeSelect('SELECT * FROM `carte_modele` WHERE c_id='.$id.' LIMIT 1')) !== false) {
        	$data = $load[0];
        	$carte = new Carte($data);
            return $carte;
        }
        return false;
    }

    public function getCardByName($name) {
    	$data=array();
        if(($load = SQL::getInst()->makeSelect('SELECT * FROM `carte_modele` WHERE c_nom=\''.$name.'\' LIMIT 1')) !== false) {
        	$data = $load[0];
            $carte = new Carte($data);
        	return $carte;
        }
        return false;
    }

    public function getCardByTeam($team) {

        if(($load = SQL::getInst()->makeSelect('SELECT * FROM `carte_modele` WHERE c_team='.$team.'')) !== false) {
            
            $cartes = array();
            foreach ($load as $carte) {
                
                $cartes[] = new Carte($carte);
            }
            return $cartes;
        }
        return false;
    }

   public function getAllCards() {
        if(($load = SQL::getInst()->makeSelect('SELECT * FROM `carte_modele`')) !== false) {
        	$cartes = array();
            foreach ($load as $carte) {
                
                $cartes[] = new Carte($carte);
            }
            return $cartes;
        }
        return false;
    }

    public function getValueCardById($id, $var) {
    	$data=array();
    	if(($load = SQL::getInst()->makeSelect('SELECT '.$var.' FROM `carte_modele` WHERE c_id='.$id.' LIMIT 1')) !== false) {
    		$data = $load[0];
        	return $data;
        }
        return false;
    }

    public function getValueCardByName($name, $var) {
    	$data=array();
    	if(($load = SQL::getInst()->makeSelect('SELECT '.$var.' FROM `carte_modele` WHERE c_nom=\''.$name.'\' LIMIT 1')) !== false) {
    		$data = $load[0];
        	return $data;
        }
        return false;
    }
}

?>