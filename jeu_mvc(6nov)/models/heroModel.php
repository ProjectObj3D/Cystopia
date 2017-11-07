<?php




class heroModel extends coreModel{


	public function listHero(){

		if($res = $this->MakeSelect('SELECT h_model_id h_id, h_model_nom h_nom, h_model_pv h_pv from hero_modele')){
			
			$heros = array();

			foreach ($res as $val) {
				
				$heros[] = new Hero($val);
			}
			return $heros;
		}
		return false;
	}

		

		
	

	

}