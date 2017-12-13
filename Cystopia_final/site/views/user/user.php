<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<script src="assets/js/jquery-3.2.1.min.js"></script>


		<link rel="stylesheet" href="assets/css/bootstrap-3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/userStyle.css">
		<script src="assets/css/bootstrap-3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h2>Bienvenue <?=$user->getLogin()?> !</h2><a href="?logout=1"><button class="btn btn-danger" id="deco">Deconnexion</button></a><br><br>
                <button class="btn" id="monCompte">Mon compte</button>
					<div class="container-fluid well span6" id="container1">
						<div class="row-fluid">
							<div class="col-lg-6">

						        <div class="span8">
						            <h3>Login: <?=$user->getLogin()?></h3>
						            <h6>Email: <?=$user->getMail()?></h6>
						            <h6>Nom: <?=$user->getNom()?></h6>
						            <h6>Prenom: <?=$user->getPrenom()?></h6>
						        </div>
							</div>
							<div class="col-lg-6">
						        <div class="span2">
						            <div class="btn-group">
						                <button class="btn dropdown-toggle btn-info" id="modif1" aria-expanded="true" data-toggle="dropdown">Modifier <i class="fa fa-cog"></i>
						                </button>
						            </div>
						        </div>
						    </div>
						</div>
					</div>
						<form id="formModif" method="POST" action="?control=user&action=modif">
							<table>
								<tr>
									<td>Login :</td>
									<td> 
										<div class="input-group">
											<input type="text" class="form-control"  value="<?=$user->getLogin()?>" name="login" id="input1">
										</div>
									</td>
								</tr>
								<tr>
									<td>Prenom :</td>
									<td> 
										<div class="input-group">
											<input type="text" class="form-control"  value="<?=$user->getPrenom()?>" name="prenom">
										</div>
									</td>
								</tr>
								<tr>
									<td>Nom :</td>
									<td> 
										<div class="input-group">
											<input type="text" class="form-control" value="<?=$user->getNom()?>" name="nom">
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
								<tr><td><input type="submit" class="btn btn-info" name="updateUser" id="sub1" value="valider"></td></tr>
							</table>
						</form><br>
				<a href="?control=deck&action=displayDeck"><button class="btn" id="btnJouer">Jouer</button></a>
			</div>
		</div>
        <script>
            $('#monCompte').on('click', function ()
            {
                $('#monCompte').css('display', 'none');
                $('#container1').css('display', 'block');
                $('#modif1').on('click', function ()
                {
                    $('#container1').css('display', 'none');
                    $('#formModif').css('display', 'block');
                });
            });
        </script>
	</body>
</html>
