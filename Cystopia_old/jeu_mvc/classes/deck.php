<?php


class Deck{

	private $_id;
	private $_nom;
	private $_team;
	private $_cartes = array(); // le tableau de cartes


	public function __construct(array $donnees){

		$this->hydrate($donnees);
	}


	public function hydrate($donnees){

		foreach ($donnees as $key => $val) {
			$key = substr($key, 2);
			$method = 'set'.ucfirst($key); // ucfirst première lettre en majuscule (camelCase);

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



	public function getNom(){

		return $this->_nom;
	}

	public function setNom($nom){

		$this->_nom = $nom;
	}


	
	public function getTeam(){

		return $this->_team;
	}


	public function setTeam($team){

		$this->_team = $team;
	}

	public function getCartes(){

		return $this->_cartes;
	}


	public function setCartes(array $cartes){

		$this->_cartes = $cartes;
	}





	// METHODES *****************************************************

}

// $donnees = array('c_id' => 5, 'c_nom' => 'robocop', 'c_description' => 'je fais ceci', 'c_type' => 5);
// $cartes = array();

// for ($i=0; $i <10 ; $i++) { 
	
// 	$cartes[$i] = new Carte($donnees);
// }

// $data = ['d_id' => 5, 'd_nom' => 'rty', 'd_team' => 1, 'd_cartes' => $cartes];
// $deck = new Deck($data);

// var_dump($deck);

// var_dump($deck->getCartes();

