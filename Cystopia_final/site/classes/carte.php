<?php
class Carte
{
    private $_id; // _ car private;
    private $_nom;
    private $_mana;
    private $_description;
    private $_type;
    private $_team;
    private $_attaque;
    private $_defense;
    private $_src;
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
    // GETTERS & SETTERS****************************************************
    public function getId(){ return $this->_id; }
    public function setId($id){ $this->_id = $id; }
    public function getNom(){ return $this->_nom; }
    public function setNom($nom){ $this->_nom = $nom; }
    public function getDescription(){ return $this->_description; }
    public function setDescription($description){ $this->_description = $description; }
    public function getType(){ return $this->_type; }
    public function setType($type){ $this->_type = $type; }
    public function getTeam(){ return $this->_team; }
    public function setTeam($team){ $this->_team = $team; }
    public function getMana(){ return $this->_mana; }
    public function setMana($mana){ $this->_mana = $mana; }
    public function getAttaque(){ return $this->_attaque; }
    public function setAttaque($attaque){ $this->_attaque = $attaque; }
    public function getDefense(){ return $this->_defense; }
    public function setDefense($defense){ $this->_defense = $defense;}
    public function getSrc(){ return $this->_src; }
    public function setSrc($src){ $this->_src = $src; }
    // METHODES *****************************************************
    public function attaquer($cible){
        if ($cible instanceof Carte) {
            // $cible->_setDefense()
        }
        // if ($cible instanceof Hero) {
        // 	# code...
        // }
    }
}
