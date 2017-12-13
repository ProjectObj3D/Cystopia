<?php



class loginController extends coreController{


	public function displayAction()
    {
		include 'views'.DIRECTORY_SEPARATOR.'login'.DIRECTORY_SEPARATOR.'login.php';
	}




	public function signinAction()
    {
		$data = $this->getData();

		
		if(isset($data['pseudo_connexion']) && isset($data['password_connexion']))
		{
			$login = htmlentities($data['pseudo_connexion']);
			$mdp = htmlentities($data['password_connexion']);

			if($user = $this->getModel()->verifyUser($data = array('login'=>$login, 'mdp'=>$mdp)))
			{

				$_SESSION['CY']['login'] = $user->getLogin();
				$_SESSION['CY']['nom'] = $user->getNom();
				$_SESSION['CY']['prenom'] = $user->getPrenom();
				$_SESSION['CY']['id'] = $user->getId();

                if($this->checkGameAction() == 1)
                {
                    header('location:.?control=plateau&action=display');
                    exit;
                }
                header('location:index.php?control=user&action=display');
                exit;
			}
			else include 'views'.DIRECTORY_SEPARATOR.'login'.DIRECTORY_SEPARATOR.'login.php';
		}
	}




	public function validAction()
    {
		$data = $this->getData();
		//$uManager = new UserManager();

		if(!empty($_POST['subscribe']))
		{
			$error = array();

			if(!empty($_POST['pseudo_register'])) $params['login'] = htmlentities($_POST['pseudo_register']);
			
			else $error['Error_pseudo'] = "Pseudo incorrect";
			

			if(!empty($_POST['name_register'])) $params['nom'] = htmlentities($_POST['name_register']);
			
			else $error['Error_name'] = "Indiquer un nom";
			

			if(!empty($_POST['prenom_register'])) $params['prenom'] = htmlentities($_POST['prenom_register']);
			
			else $error['Error_prenom'] = "Indiquer un prénom";
			

			if(!empty($_POST['email_register']))
			{
				if(filter_var($_POST['email_register'],FILTER_VALIDATE_EMAIL)) $params['mail'] = htmlentities($_POST['email_register']);				
				else $error['Error_mail'] = "Renseignez une adresse mail valide";	
			}

			else $error['Error_mail'] = "Indiquer une adresse mail";
			

			if(!empty($_POST['password_register']))
			{
				if ($_POST['password_register'] === $_POST['confirm-password_register'])
				{
					$mdp = htmlentities($_POST['password_register']);
					$params['mdp'] = password_hash($mdp, PASSWORD_DEFAULT);
				}
				else $error['Error_password'] = "Mots de passe incorrects";
			}

			else $error['Error_password'] = "Mot de passe incorrect";
				

			if(!empty($error))
			{
				$_SESSION['Error'] = $error;
				header('location:index.php?control=login&action=display');
			}

			else
            {
					// var_dump($params);
					
				if($user = $this->getModel()->addUser($params))
				{
					$message = "Utilisateur <bold>".$params['login']."</bold> ajouté avec succès !";
				}


				else
                {
				 $message = 'Ce login existe déjà';
				}

				include 'views'.DIRECTORY_SEPARATOR.'login'.DIRECTORY_SEPARATOR.'login.php';	
			}	
		}
	}

    public function checkGameAction()
    {
        $userId = $_SESSION['CY']['id'];

        return $this->getModel()->checkGame($userId);
    }

    public function homeAction()
    {
        include 'views'.DIRECTORY_SEPARATOR.'login'.DIRECTORY_SEPARATOR.'home.php';
    }

}




















