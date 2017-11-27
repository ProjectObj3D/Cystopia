<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<script src="assets/js/jquery-3.2.1.min.js"></script>

		<link rel="stylesheet" type="text/css" href="assets/css/userStyle.css">
		<link rel="stylesheet" href="assets/css/bootstrap-3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/font-awesome-4.7.0/css/font-awesome.min.css">
		<script src="assets/css/bootstrap-3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h2>Bienvenue <?=$user->getLogin()?> !</h2><a href="?logout=1">Deconnexion</a><br><br>
				Mon compte :
				
				<div class="container-fluid well span6">
					<div class="row-fluid">     
				        <div class="span8">
				            <h3>Login: <?=$user->getLogin()?></h3>
				            <h6>Email: <?=$user->getMail()?></h6>
				            <h6>Nom: <?=$user->getNom()?></h6>
				            <h6>Prenom: <?=$user->getPrenom()?></h6>
				        </div>
				        
				        <div class="span2">
				            <div class="btn-group">
				                <button class="btn dropdown-toggle btn-info" aria-expanded="true" data-toggle="dropdown">
				                    Action 
				                    <i class="fa fa-cog"></i>
				                </button>
				                <ul class="dropdown-menu">
				                    <li><a href="?control=user&action=display&modif=1"><span class="icon-wrench"></span>Modifier</a></li>
				                </ul>
				            </div>
				        </div>
					</div>
				</div>

				<?php


					if (isset($_GET['modif']) && $_GET['modif'] == 1 && !isset($modif)) { ?>
						<form id="formModif" method="POST" action="?control=user&action=modif">
							<table>
								<tr>
									<td>Login :</td>
									<td> 
										<div class="input-group">
											<input type="text" class="form-control"  value="<?=$user->getLogin()?>" name="login"></input>
										</div>
									</td>
								</tr>
								<tr>
									<td>Prenom :</td>
									<td> 
										<div class="input-group">
											<input type="text" class="form-control"  value="<?=$user->getPrenom()?>" name="prenom"></input>
										</div>
									</td>
								</tr>
								<tr>
									<td>Nom :</td>
									<td> 
										<div class="input-group">
											<input type="text" class="form-control" value="<?=$user->getNom()?>" name="nom"></input>
										</div>
									</td>
								</tr>
								<tr>
									<td>Email :</td>
									<td> 
										<div class="input-group">
										  <input type="text" class="form-control" value="<?=$user->getMail()?>"  name="mail" aria-describedby="basic-addon1">
										</div>
									</td>
								</tr>
								<tr><td><input type="submit" class="btn btn-info" name="updateUser"></td></tr>
							</table>
						</form>
				<?php }
				?>
				<a href="?control=deck&action=manager"><button class="btn">choisir un deck</button></a>
				<a href="?control=deck&action=manager"><button class="btn">créer un deck</button></a>
			</div>
		</div>
	</body>
</html>

<?php

?>