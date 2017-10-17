<?php
spl_autoload_register(function($class){
	require $class.'.class.php';
});


class User{

	private $_id;
	private $_login;
	private $_prenom;
	private $_nom;
	private $_mail;
	private $_date;


	public function __construct(array $donnees){

		$this->hydrate($donnees);
	}


	public function hydrate($donnees){

		foreach ($donnees as $key => $val) {
			$key = substr($key, 2);
			$method = 'set'.ucfirst($key); // uc first première lettre en majuscule (camelCase);

			if (method_exists($this, $method)) {
				$this->{$method}($val);
			}
		}
	}

	// GETTERS & SETTERS****************************************************

	public function getId(){

		return $this->_id;
	}

	public function setId($id){

		$this->_id = $id;
	}


	public function getLogin(){

		return $this->_login;
	}

	public function setLogin($login){

		$this->_login = $login;
	}

	public function getPrenom(){

		return $this->_prenom;
	}

	public function setPrenom($prenom){

		$this->_prenom = $prenom;
	}
	

	public function getNom(){

		return $this->_nom;
	}

	public function setNom($nom){

		$this->_nom = $nom;
	}

	public function getMail(){

		return $this->_mail;
	}

	public function setMail($mail){

		$this->_mail = $mail;
	}

	public function getDate(){

		return $this->_date;
	}

	public function setDate($date){

		$this->_date = $date;
	}



	// METHODES *****************************************************

}

// $data = ['u_id'=>5, 'u_login'=>'jako', 'u_prenom'=>'polo', 'u_nom'=> 'dubois', 'u_mail' => 'hgshd@khgj.com'];
// $user = new User($data);

// var_dump($user);