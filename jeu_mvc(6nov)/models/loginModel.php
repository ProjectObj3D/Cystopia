<?php




class loginModel extends coreModel{


	public function verifyUser(array $data){

		$uModel = new userModel();

		if ($user = $uModel->verifyUser($data)) {
			
			return $user;
		}
		return false;
	}

	public function addUser(array $data){
		
		$uModel = new userModel();

		if ($uModel->notInBdd($data)) {
			
			if($uModel->addUser($data)){
				
				return true;
			}
		}
		return false;
	}

}