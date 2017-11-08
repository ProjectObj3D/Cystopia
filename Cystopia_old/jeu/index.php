<?php 
if (!isset($_SESSION)) session_start(); 

if (isset($_GET['logout'])){
	 unset($_SESSION['CY']);
	 unset($_SESSION['Error']);
}


require 'common.php';

if (isset($_POST)) {
	if (isset($_POST['register-submit'])) validFormInscription($_POST);

	else{
		if($user = validFormConnexion($_POST)){
			$_SESSION['CY']['login'] = $user->getLogin();
			$_SESSION['CY']['nom'] = $user->getNom();
			$_SESSION['CY']['prenom'] = $user->getPrenom();
			$_SESSION['CY']['id'] = $user->getId();
			header('location: user.php?id='.$_SESSION['CY']['id'].'');
		}
		else $error = validFormConnexion($_POST);
	}
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<!-- <link rel="stylesheet" href="css/bootstrap-3.3.6/css/bootstrap.min.css"> -->
	<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>

	<!-- <link rel="stylesheet" type="text/css" href="css/register.css"> -->
	<script src="js/register.js" type="text/javascript"></script>

	<link rel="stylesheet" href="assets/css/font-awesome-4.7.0/css/font-awesome.min.css">
	<title>Connexion</title>

</head>
<body>
	<div class="main"> <a href="?logout=1">Deconnexion</a>
		<div class="container">
		   <div class="row">
		    <div class="col-md-6 col-md-offset-3">
		      <div class="panel panel-login">
		        <div class="panel-body">
		          <div class="row">
		            <div class="col-lg-12">
			
					<!-- ********************************    Formulaire de connexion *********************************************   -->

		              <form id="login-form" action="" method="post" role="form" style="display: block;">
		                <h2>Se connecter</h2>
		                  <div class="form-group">
		                    <input type="text" name="pseudo_connexion" id="pseudo_connexion"  class="form-control" placeholder="Pseudo">
		                  </div>
		                  <div class="form-group">
		                    <input type="password" name="password_connexion" id="password_connexion" class="form-control" placeholder="Mot de passe">
		                  </div>
		                  <div class="col-xs-6 form-group pull-left">
		                    <a href="#" class="password_forget" ><p>Mot de passe oublié</p></a> 
		                  </div>
		                  <input type="hidden" name="login" id="login" value="login"/>
		                  <div class="col-xs-6 form-group pull-right">     
		                        <input type="submit" name="login-submit" id="login-submit"  class="form-control btn btn-login" value="Connexion">
		                  </div>
		              </form>


					<!-- ********************************    Formulaire d'inscription' *********************************************   -->
				

		              <form id="register-form" action="" method="post" role="form" style="display: none;">
		                <h2>Formulaire d'inscription</h2>
		                  <div class="form-group">
		                    <input type="text" name="pseudo_register" id="pseudo_register" class="form-control <?php if(isset($_SESSION['Error']['Error_pseudo'])){echo 'has-error error_subscribe';}?>" placeholder="Pseudo" value="">
		                  </div>
		                  <div class="form-group">
		                    <input type="text" name="name_register" id="nam_registere"  class="form-control <?php if(isset($_SESSION['Error']['Error_name'])){echo 'has-error error_subscribe';}?>" placeholder="Nom" value="">
		                  </div>
		                  <div class="form-group">
		                    <input type="text" name="prenom_register" id="prenom_register"  class="form-control <?php if(isset($_SESSION['Error']['Error_prenom'])){echo 'has-error error_subscribe';}?>" placeholder="<?php if(isset($_SESSION['Error']['Error_prenom'])){echo $_SESSION['Error']['Error_prenom'];}else{echo 'Prenom';}?>" value="">
		                  </div>
		                  <div class="form-group">
		                    <input type="email" name="email_register" id="email_register"  class="form-control <?php if(isset($_SESSION['Error']['Error_mail'])){echo 'has-error error_subscribe';}?>" placeholder="Adresse e-mail" value="">
		                  </div>
		                  <div class="form-group">
		                    <input type="password" name="password_register" id="password_register"  class="form-control <?php if(isset($_SESSION['Error']['Error_password'])){echo 'has-error error_subscribe';}?>" placeholder="Mot de passe">
		                  </div>
		                  <div class="form-group">
		                    <input type="password" name="confirm-password_register" id="confirm-password_register" class="form-control <?php if(isset($_SESSION['Error']['Error_pseudo'])){echo 'has-error error_subscribe';}?>" placeholder="Confirmez le mot de passe">
		                  </div>
		                  <input type="hidden" name="subscribe" id="subscribe" value="subscribe"/>
		                  <div class="form-group">
		                    <div class="row">
		                      <div class="col-sm-6 col-sm-offset-3">
		                        <input type="submit" name="register-submit" id="register-submit"  class="form-control btn btn-register" value="S'inscrire">
		                      </div>
		                    </div>
		                  </div>
		              </form>
		            </div>
		          </div>
		        </div>
		        <div class="panel-heading">
		          <div class="row">
		            <div class="col-xs-6 tabs">
		              <a href="#" class="active" id="login-form-link"><div class="login">Connexion</div></a>
		            </div>
		            <div class="col-xs-6 tabs">
		              <a href="#" id="register-form-link"><div class="register">S'inscrire</div></a>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
<footer>

</footer>
	
</body>
</html>
<?php
if (isset($_SESSION['CY'])) var_dump($_SESSION['CY']);
var_dump($_POST);
?>