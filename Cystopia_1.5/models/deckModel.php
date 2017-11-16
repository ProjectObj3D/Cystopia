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
        if($add = $this->MakeInsert('INSERT INTO deck ( d_hero_model_fk, d_user_fk) VALUES ( :hero, :userFk)',
            array(':hero'=>$data['hero'], ':userFk'=>$data['userFk']))){
            $_SESSION['last_deck_creater']=$this->lastInsertId();
            return true;
        }
        return false;
    }

    public function addRelDeck(array $data)
    {
        if($add = $this->MakeInsert('INSERT INTO rel_deck_carte ( d_id, c_id) VALUES ( :deckId, :carteID)', array(':deckId'=>$data['deckId'], ':carteID'=>$data['carteID'])))
        {
            return true;
        }
        return false;
    }

    public function listCardOfDeckById($id)
    {
        if($res = $this->MakeSelect('SELECT  carte_modele.c_id,carte_modele.c_nom,carte_modele.c_mana,carte_modele.c_attaque,carte_modele.c_defense, carte_modele.c_type, carte_modele.c_team,carte_modele.c_description from carte_modele, rel_deck_carte where rel_deck_carte.d_id =:id and rel_deck_carte.c_id = carte_modele.c_id', array(':id'=>$id)))
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
		

}