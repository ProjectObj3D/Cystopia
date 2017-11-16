<?php

class Hero
{
	private $_id;
	private $_nom;
	private $_pv;


	public function __construct(array $donnees)
    {
		$this->hydrate($donnees);
	}


	public function hydrate($donnees)
    {
		foreach ($donnees as $key => $val)
		{
			$key = substr($key, 2);
			$method = 'set'.ucfirst($key); // uc first première lettre en majuscule (camelCase);

			if (method_exists($this, $method))
			{
				$this->{$method}($val);
			}
		}
	}

	public function getId(){ return $this->_id; }
	public function setId($id){ $this->_id = $id; }

	public function getNom(){ return $this->_nom; }
	public function setNom($nom){ $this->_nom = $nom; }

	public function getPv(){ return $this->_pv; }
	public function setPv($pv){ $this->_pv = $pv;}

}