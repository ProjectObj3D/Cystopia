<?php




class deckModel extends coreModel
{

	public function listDeck($id)
    {
		if($res = $this->MakeSelect('SELECT *, d_hero_model_fk d_hero from deck WHERE deck.d_user_fk =:id', array(':id'=>$id))){

			$decks = array();

			foreach ($res as $val)
			{
				$decks[] = new Deck($val);
			}
			return $decks;
		}
		return false;
	}

	public function getHeroList()
    {
		$hModel = new heroModel();
		$heros = $hModel->listHero();

		return $heros;
	}

    public function listCarteTeam($team)
    {
        $cModel = new carteModel();
        $carte = $cModel->listCarteTeam($team);

        return $carte;
    }
		
    public function getCarte($id)
    {
        $cModel = new carteModel();
        $carte = $cModel->getCarte($id);

        return $carte;
    }


    public function addDeck(array $data)
    {
        if($add = $this->MakeInsert('INSERT INTO deck ( d_nom, d_hero_model_fk, d_user_fk) VALUES ( :nom, :hero, :userFk)',
            array(':nom' => $data['nom'], ':hero'=>$data['hero'], ':userFk'=>$data['userFk']))){
            $_SESSION['last_deck_creater']=$this->lastInsertId();
            return true;
        }
        return false;
    }

    public function addRelDeck(array $data)
    {
        if($add = $this->MakeInsert('INSERT INTO rel_deck_carte ( d_id, c_id,c_num) VALUES ( :deckId, :carteID, :nbreCartes)', array(':deckId'=>$data['deckId'], ':carteID'=>$data['carteID'], ':nbreCartes'=>$data['nbreCartes'] )))
        {
            return true;
        }
        return false;
    }

    public function deleteDeck(array $data)
    {
        return $this->makeStatement( 'DELETE FROM `deck` WHERE `d_id`=:id', array( ':id' => $data['idDeck'] ));
    }





    public function listCardOfDeckById($id)
    {
        if($res = $this->MakeSelect('SELECT CONCAT(d_id,"_",rel_deck_carte.c_id ,"_",c_num) as c_id,carte_modele.c_nom,carte_modele.c_mana,carte_modele.c_attaque,carte_modele.c_defense, carte_modele.c_type, carte_modele.c_team,carte_modele.c_description, c_src from carte_modele, rel_deck_carte where rel_deck_carte.d_id =:id and rel_deck_carte.c_id = carte_modele.c_id', array(':id'=>$id)))
        {

            $cartes = array();
            foreach ($res as $val)
            {   
                $cartes[] = new Carte($val);
            }
            return $cartes;
        }
        return false;
    }

    public function listeDeck($id)
    {
        if($res = $this->MakeSelect('SELECT deck.* FROM `deck` where d_user_fk = :id ', array(':id' => $id )))
        {

            $deck = array();

            foreach ($res as $val)
            {
                $deck[] = new Deck($val);
            }
            return $deck;
        }
        return false;

  }

}