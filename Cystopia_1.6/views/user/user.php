<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<link rel="stylesheet" type="text/css" href="css/userStyle.css">
	</head>
	<body>
		<h2>Bienvenue <?=$user->getLogin()?> !</h2><a href="?logout=1">Deconnexion</a><br><br>
		Mon compte :
		
		<div id="dataUser">
			<span>Login: <?=$user->getLogin()?></span><br>
			<span>Prenom: <?=$user->getPrenom()?></span><br>
			<span>Nom: <?=$user->getNom()?></span><br>
			<span>Email: <?=$user->getMail()?></span><br>
			<a href="?modif=1">Modifier</a>
		</div>
		<?php
			if (isset($_GET['modif']) && $_GET['modif'] == 1 && !isset($modif)) { ?>
				<form id="formModif" method="POST">
					<table>
						<tr><td>Login :</td><td> <input type="text" value="<?=$user->getLogin()?>" name="login"></input></td></tr>
						<tr><td>Prenom :</td><td> <input type="text" value="<?=$user->getPrenom()?>" name="prenom"></input></td></tr>
						<tr><td>Nom :</td><td> <input type="text" value="<?=$user->getNom()?>" name="nom"></input></td></tr>
						<tr><td>Email :</td><td> <input type="text" value="<?=$user->getMail()?>" name="mail"></input></td></tr>
						<tr><td><input type="submit" name="updateUser"></td></tr>
					</table>
				</form>
		<?php }
		?>
		<a href="?control=deck&action=manager">choisir un deck</a>
		<a href="?control=deck&action=manager">créer un deck</a>
	</body>
</html>

<?php

// var_dump($user);
// var_dump($_SESSION);
var_dump($this->_params);
?>