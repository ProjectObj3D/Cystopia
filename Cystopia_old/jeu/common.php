<?php

spl_autoload_register(function($class){
require 'classes/'.$class.'.class.php';
});



function validFormInscription($post){

	$uManager = new UserManager();

	if(!empty($_POST['subscribe'])){

		$error = array();

		if(!empty($_POST['pseudo_register'])){

			$params['login'] = htmlentities($_POST['pseudo_register']);
		}
		
		else $error['Error_pseudo'] = "Pseudo incorrect";
		

		if(!empty($_POST['name_register'])){

			$params['nom'] = htmlentities($_POST['name_register']);
		}

		else $error['Error_name'] = "Indiquer un nom";
		

		if(!empty($_POST['prenom_register'])){

			$params['prenom'] = htmlentities($_POST['prenom_register']);
		}

		else $error['Error_prenom'] = "Indiquer un prénom";
		

		if(!empty($_POST['email_register'])){

			if(filter_var($_POST['email_register'],FILTER_VALIDATE_EMAIL)){

				$params['mail'] = htmlentities($_POST['email_register']);				
			}

			else $error['Error_mail'] = "Renseignez une adresse mail valide";
			
		}

		else $error['Error_mail'] = "Indiquer une adresse mail";
		

		if(!empty($_POST['password_register'])){

			if ($_POST['password_register'] === $_POST['confirm-password_register']) {

				$mdp = htmlentities($_POST['password_register']);
				$params['mdp'] = password_hash($mdp, PASSWORD_DEFAULT);
			}
			else $error['Error_password'] = "Mots de passe incorrects";
		}

		else $error['Error_password'] = "Mot de passe incorrect";
			

		if(!empty($error)){
			
			$_SESSION['Error'] = $error;
			header('location: .');
		}

		else{
			if ($uManager->addUser($params)) {
				echo "Utilisateur <bold>".$params['login']."</bold> ajouter avec succès !";
				echo '<a href=".">Revenir au formulaire</a>';
			}
		}	
	}
}


function validFormConnexion($post){

	$uManager = new UserManager();

	if(isset($_POST['pseudo_connexion']) && isset($_POST['password_connexion'])){
	
		$login = htmlentities($_POST['pseudo_connexion']);
		$mdp = htmlentities($_POST['password_connexion']);

		if($user = $uManager->verifyUser($params = array('login'=>$login, 'mdp'=>$mdp))){

			return $user;
		}
		else echo "error";
	}

	else echo "pseudo ou mdp incorrect";
}