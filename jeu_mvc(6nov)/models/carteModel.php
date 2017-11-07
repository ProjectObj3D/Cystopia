<?php




class carteModel extends coreModel{


    public function getCarte($id){

        if($res = $this->MakeSelect('SELECT * from carte_modele where carte_modele.c_id=:id', array(':id'=>$id))){

              return  $carte = new Carte($res[0]);
            }
        return false;

    }



	public function listCarte(){

		if($res = $this->MakeSelect('SELECT * from carte_modele',array())){

			$cartes = array();

			foreach ($res as $val) {
				$cartes[] = new Carte($val);
			}
			return $cartes;
		}
		return false;
	}



    public function listCarteTeam($team){

        if($res = $this->MakeSelect('SELECT * from carte_modele where carte_modele.c_team=:team', array(':team'=>$team))){

            $cartes = array();

            foreach ($res as $val) {
                $cartes[] = new Carte($val);
            }
            return $cartes;
        }
        return false;
    }







}