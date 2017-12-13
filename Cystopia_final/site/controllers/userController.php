<?php 

class userController extends coreController
{
    public function displayAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php?control=login&action=display');
        }

    	$user = new userModel();
    	$user = $user->getUser($_SESSION['CY']['id']);
        
        include 'views' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'user.php';
    }

    public function modifAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php?control=login&action=display');
        }

    	$user = new UserModel();
    	
    	$user->updateUser($_POST);
    	$user = $user->getUser($_SESSION['CY']['id']);
    	 include 'views' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'user.php';
    }
}