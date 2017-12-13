<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="assets/css/bootstrap-3.3.6/css/bootstrap.min.css">
	<script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/login.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link rel="stylesheet" href="assets/css/font-awesome-4.7.0/css/font-awesome.min.css">
	<title>Connexion</title>
</head>
<body>
	<div class="main"> <!-- <a href="?logout=1">Deconnexion</a> -->
		<div class="container">
		   <div class="row">
		    <div class="col-md-6 col-md-offset-3 card">
		      <div class="panel panel-login card_front" id="animA">
		        <div class="panel-body">
		        <?php if(isset($message)) echo $message; ?>
		          <div class="row">
		            <div class="col-lg-12">
			
					<!-- ********************************    Formulaire de connexion *********************************************   -->
				<?php 
				if(isset($_SESSION['params']))
				{
					echo '<form id="login-form" action="" method="post" role="form" style="display: none;">';
				}
				else{
					echo '<form id="login-form" action="" method="post" role="form" style="display: block;">';
				}
				?>
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
		                  		<input type="hidden" name="action" value="signin"> 
		                        <input type="submit" name="login-submit" id="login-submit"  class="form-control btn btn-login" value="Connexion">
		                  </div>
		              </form>


					<!-- ********************************    Formulaire d'inscription' *********************************************   -->
				
					<?php 
					if(isset($_SESSION['params']))
					{
						echo '<form id="register-form" action="" method="post" role="form" style="display: ;">';
					}
					else{
						echo '<form id="register-form" action="" method="post" role="form" style="display: none;">';
					}
					?>
		              
		                <h2>Formulaire d'inscription</h2>
		                  <div class="form-group">
		                    <input type="text" name="pseudo_register" id="pseudo_register" class="form-control <?php if(isset($_SESSION['Error']['Error_pseudo'])){echo 'has-error error_subscribe';}?>" placeholder="<?php if(isset($_SESSION['Error']['Error_pseudo'])){echo $_SESSION['Error']['Error_pseudo'];}else{echo 'Pseudo';}?>" value="<?php if(isset($_SESSION['params']['login'])){echo $_SESSION['params']['login'];} ?>">
		                  </div>
		                  <div class="form-group">
		                    <input type="text" name="name_register" id="nam_registere"  class="form-control <?php if(isset($_SESSION['Error']['Error_name'])){echo 'has-error error_subscribe';}?>" placeholder="Nom" value="<?php if(isset($_SESSION['params']['nom'])){echo $_SESSION['params']['nom'];} ?>">
		                  </div>
		                  <div class="form-group">
		                    <input type="text" name="prenom_register" id="prenom_register"  class="form-control <?php if(isset($_SESSION['Error']['Error_prenom'])){echo 'has-error error_subscribe';}?>" placeholder="<?php if(isset($_SESSION['Error']['Error_prenom'])){echo $_SESSION['Error']['Error_prenom'];}else{echo 'Prenom';}?>" value="<?php if(isset($_SESSION['params']['prenom'])){echo $_SESSION['params']['prenom'];} ?>">
		                  </div>
		                  <div class="form-group">
		                    <input type="email" name="email_register" id="email_register"  class="form-control <?php if(isset($_SESSION['Error']['Error_mail'])){echo 'has-error error_subscribe';}?>" placeholder="<?php if(isset($_SESSION['Error']['Error_mail'])){echo $_SESSION['Error']['Error_mail'];}else{echo 'Adresse e-mail';}?>" value="<?php if(isset($_SESSION['params']['mail'])){echo $_SESSION['params']['mail'];} ?>">
		                  </div>
		                  <div class="form-group">
		                    <input type="password" name="password_register" id="password_register"  class="form-control <?php if(isset($_SESSION['Error']['Error_password'])){echo 'has-error error_subscribe';}?>" placeholder="<?php if(isset($_SESSION['Error']['Error_password'])){echo $_SESSION['Error']['Error_password'];}else{echo 'Mot de passe';}?>" required>
		                  </div>
		                  <div class="form-group">
		                    <input type="password" name="confirm-password_register" id="confirm-password_register" class="form-control " placeholder="Confirmez le mot de passe">
		                  </div>
		                  <input type="hidden" name="subscribe" id="subscribe" value="subscribe"/>
		                  <div class="form-group">
		                    <div class="row">
		                      <div class="col-sm-6 col-sm-offset-3">
		                      	<input type="hidden" name="action" value="valid">
		                        <input type="submit" name="register-submit" id="register-submit"  class="form-control btn btn-register" value="Valider">
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
		      <div class="card_back" id="animB"></div>
		    </div>
		  </div>
		</div>
	</div>
</body>
</html>











