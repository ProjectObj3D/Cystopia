<?php


class Creature extends Carte{

	private $_defense;


	public function __construct(array $donnees){

		parent::__construct($donnees);
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

	public function getDefense(){

		return $this->_defense;
	}

	public function setDefense($defense){

		$this->_defense = $defense;
	}


	// METHODES *****************************************************

}


// $donnees = array('c_id' => 5, 'c_nom' => 'robocop', 'c_description' => 'je fais ceci', 'c_attaque' => 15, 'c_defense' => 23, 'c_type' => 'bouclier', 'c_team' => 4, 'c_mana' => 8);

// $carte = new Creature($donnees);
// $carte2 = new Creature($donnees);

// var_dump($carte);var_dump($carte2);