<?php




class loginModel extends coreModel{


	public function verifyUser(array $data){

		$uModel = new userModel();

		if ($user = $uModel->verifyUser($data)) {
			
			return $user;
		}
		return false;
	}

}