<?php
spl_autoload_register(function($class){
require 'classes/'.$class.'.class.php';
});


class UserManager{



	public function addUser($params = array()){

		if($add = SQL::getInst()->MakeInsert('INSERT INTO users(u_login, u_mdp, u_prenom, u_nom, u_mail, u_date_inscription) VALUES (:login, :mdp, :prenom, :nom, :mail, NOW())', array(':login'=>$params['login'],':mdp'=>$params['mdp'], ':prenom'=>$params['prenom'], ':nom'=>$params['nom'], ':mail'=>$params['mail']))){

			// Faire un getUser() pour récupérer un objet de l'utilisateur et le connecter directement.
			return $add;
		}
	}


	public function verifyUser($params = array()){

		if($verif = SQL::getInst()->MakeSelect('SELECT u_id, u_login, u_mdp, u_prenom, u_nom, u_mail, u_date_inscription AS u_date FROM users WHERE u_login = :login', array(':login'=>$params['login']))){

			if (password_verify($params['mdp'], $verif[0]['u_mdp'])) {

				$user = new User($verif[0]);
				return $user;
			}
			else return false;
		}
	}



}

















