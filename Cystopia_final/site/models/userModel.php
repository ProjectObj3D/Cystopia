<?php



class userModel extends coreModel
{

	public function addUser(array $data)
    {
		if($add = $this->MakeInsert('INSERT INTO users(u_login, u_mdp, u_prenom, u_nom, u_mail, u_date_inscription) 
                                         VALUES (:login, :mdp, :prenom, :nom, :mail, NOW())', array(':login'=>$data['login'],':mdp'=>$data['mdp'], ':prenom'=>$data['prenom'], ':nom'=>$data['nom'], ':mail'=>$data['mail'])))
		{
			// Faire un getUser() pour récupérer un objet de l'utilisateur et le connecter directement.
			return true;
		}
		return false;
	}


	public function verifyUser(array $data)
    {
		if($verif = $this->MakeSelect('SELECT u_id, u_login, u_mdp, u_prenom, u_nom, u_mail, u_date_inscription AS u_date FROM users WHERE u_login = :login', array(':login'=>$data['login'])))
		{
			if (password_verify($data['mdp'], $verif[0]['u_mdp']))
			{
				$user = new User($verif[0]);
				return $user;
			}
			return false;
		}
		return false;
	}

	

	public function notInBdd(array $data)
    {
		if($verif = $this->MakeSelect('SELECT COUNT(u_login) AS login FROM users WHERE u_login = :login', array(':login'=>$data['login'])))
		{
			if (intval($verif[0]['login']) === 0) 

			return true;
		}
		return false;
	}



	public function getUser($id)
    {
		$sql = 'SELECT u_id, u_login, u_prenom, u_nom, u_mail, u_date_inscription u_date FROM users WHERE u_id = :id'; 
		if ($get = $this->MakeSelect($sql, array(':id' => $id)))
		{
			$user = new User($get[0]);
			return $user;
		}
		return false;
	}

	public function updateUser(array $data)
    {
		$login = htmlentities($data['login']);
		$prenom = htmlentities($data['prenom']);
		$nom = htmlentities($data['nom']);
		$mail = htmlentities($data['mail']);
		$id = htmlentities($_SESSION['CY']['id']);

		$sql = 'UPDATE users SET u_login = :login, u_prenom = :prenom, u_nom = :nom, u_mail = :mail WHERE u_id = :id';

		if($login != '' && $prenom != '' && $nom != '' && $mail != '')
		{
            if ($this->MakeInsert($sql, array(':login' => $login, ':prenom' => $prenom, ':nom' => $nom, ':mail' => $mail, ':id' => $id))) {
                return true;
            }
        }
		return false;
	}

}










