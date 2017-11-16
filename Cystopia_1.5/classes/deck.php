<?php


class Deck
{

	private $_id;
	private $_nom;
	private $_hero;
	private $_cartes = array(); // le tableau de cartes


	public function __construct(array $donnees)
    {
		$this->hydrate($donnees);
	}


	public function hydrate($donnees)
    {
		foreach ($donnees as $key => $val)
		{
			$key = substr($key, 2);
			$method = 'set'.ucfirst($key); // ucfirst première lettre en majuscule (camelCase);

			if (method_exists($this, $method))
			{
				$this->{$method}($val);
			}
		}
	}

	// GETTERS & SETTERS****************************************************

	public function getId(){ return $this->_id; }
	public function setId($id){ $this->_id = $id; }

	public function getNom(){ return $this->_nom; }
	public function setNom($nom){ $this->_nom = $nom; }

	public function getHero(){ return $this->_hero; }
	public function setHero($hero){ $this->_hero = $hero; }

	public function getCartes(){ return $this->_cartes; }
	public function setCartes(array $cartes){ $this->_cartes = $cartes; }


	// METHODES *****************************************************

}
