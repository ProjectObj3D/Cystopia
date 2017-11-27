<?php 

class userController extends coreController
{
    public function displayAction()
    {	

    	$user = new userModel();
    	$user = $user->getUser($_SESSION['CY']['id']);
        
        include 'views' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'user.php';
    }

    public function modifAction()
    {
    	$user = new UserModel();
    	
    	$user->updateUser($_POST);
    	$user = $user->getUser($_SESSION['CY']['id']);
    	 include 'views' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'user.php';
    }
}