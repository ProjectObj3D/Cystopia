<?php
spl_autoload_register(function($class){
	require 'classes/'.$class.'.class.php';
});


class {

	private $_;


	public function __construct(array $donnees){

		parent::__construct($donnees);
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

	public function get(){

		return $this->_;
	}

	public function set($){

		$this->_ = $;
	}


	// METHODES *****************************************************

}