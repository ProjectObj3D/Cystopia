<?php




class loginModel extends coreModel
{
	public function verifyUser(array $data)
    {
		$uModel = new userModel();

		if ($user = $uModel->verifyUser($data))
		{
			return $user;
		}
		return false;
	}

	public function addUser(array $data)
    {
		$uModel = new userModel();

		if ($uModel->notInBdd($data))
		{
			if($uModel->addUser($data))
			{
				return true;
			}
		}
		return false;
	}

    public function checkGame($userId)
    {
        $sql = 'SELECT partie.p_termine FROM users 
                INNER JOIN hero_tmp ON users.u_id = hero_tmp.h_tmp_user_fk 
                INNER JOIN partie ON partie.p_id = hero_tmp.h_tmp_partie_fk 
                WHERE users.u_id = :userId ORDER BY partie.p_id DESC LIMIT 1';

        if($res = $this->makeSelect($sql, [':userId' => $userId]))
        {
            return $res[0]['p_termine'];
        }
        return false;
    }

}