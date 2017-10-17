<?php
	global $db;
    try {$db = new PDO('mysql:host=localhost;dbname=cystopia;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
    catch(exception $e){ die('Erreur '.$e->getMessage()); }

    if(count($_POST)) {

    	if(isset($_POST['submitNews'])) {  // NEWSLETTER
    		if(isset($_POST['mailNewsletter']) && !empty($_POST['mailNewsletter'])) {

	            $q = $db->prepare('INSERT INTO newsletters(email, valdate) VALUES (?, NOW())');
	            $q->execute(array($_POST['mailNewsletter']));

	            if($q) echo '<script>sessionStorage.setItem("valid", 1);smoothControl(\'sectionBas\')</script>';    
    		}
    	}

    	if(isset($_POST['submitPop'])) { // FORM CONTACT
            if(isset($_POST['mailPopUp']) && isset($_POST['nomPopUp']) && isset($_POST['prenomPopUp']) && isset($_POST['textArea'])) {

                $q = $db->prepare('INSERT INTO contact (c_email, c_firstname, c_lastname, c_content, c_valdate) VALUES (?,?,?,?, NOW())');
                $q->execute(array($_POST['mailPopUp'], $_POST['prenomPopUp'], $_POST['nomPopUp'], $_POST['textArea']));
                
                if($q) echo '<script>sessionStorage.setItem("card", 1);</script>';
            }
    	}
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Cystopia</title>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">

	<script>
	   sessionStorage.setItem("valid", 0);

	</script>


</head>

<body>
	<!-- <section class="sectionHaut">
		<div class="conteneurLogo">
			<img class="imgLogo" src="assets/Logo.png">
		</div>
		<div class="annonce">
			<span class="spanHaut colorBlueHaut">Un jeu de carte stratégique</span>
			<br>
			<span class="spanBas colorWhite">en ligne le 28 novembre 2017</span>
		</div>


		<div class="conteneurMain">
			<div class="logoCentreAutour">
			     <img class="imgLogoGaucheBas" src="assets/gauche_bleu.png">
				 <img class="imgLogoGaucheHaut" src="assets/hover_gauche.png"> 
				
			</div>
			
			<div id="CyberImageDroite" class="logoCentreAutourDroite">
				<img class="imgLogoDroite" src="assets/droite_manga_bleue_03.png">
			</div>


			<div class="logoHexagone">
				<img class="imgHexagoneGauche" src="assets/logo_cyber.png">
				<img class="imgHexagoneDroite" src="assets/logo_manga.png">
			</div>
		</div>
	</section> -->

	<section class="sectionHaut">
		<div class="conteneurLogo">
			
			<div class="imgLogo"> </div>
			
		</div>
		<div class="annonce">
			<span class="spanHaut colorBlueHaut">Un jeu de carte stratégique</span>
			<br>
			<span class="spanBas colorWhite">en ligne le 28 novembre 2017</span>
		</div>


		<div class="conteneurMain">
			<!-- cyber à gauche -->
			<div class="logoCentreAutour">
				<img class="imgLogoGaucheBas" src="assets/gauche_bleu.png">
			    <img class="imgLogoGaucheHaut" src="assets/hover_gauche.png">
			</div>

			<!-- Manga à droite -->
			<div class="logoCentreAutourDroite">
				<img class="imgLogoDroite" src="assets/droite_manga_bleue_03.png">
				<img class="imgLogoDroiteManga" src="assets/manga.png">
			</div>

			<!-- Icone hexagonale gauche et droite -->
			<div class="logoHexagone">
				<div class="imgHexagoneGauche">
				</div>
				<div class="imgHexagoneDroite">
				</div>

				<!-- <img class="imgHexagoneGauche" src="assets/IconeGSansEffets.png">
				<img class="imgHexagoneGaucheCache" src="assets/IconeGAvecEffets.png"> -->

				<!-- <img class="imgHexagoneDroite" src="assets/MangaIconeSansEffets.png">
				<img class="imgHexagoneDroiteCache" src="assets/MangaIconeAvecEffets.png"> -->
				
			</div>


		</div>
	</section>

	
	 <section class="section_middle">
		<div class="transition_haut"></div>

        <div class="contentMiddle">
		<h2 class="colorBlueMilieu title">A Propos</h2>
		<div class="img_gauche">
			<img src="images/tron.png" alt="tron">
		</div>
		<div class="div_middle">
		
			<div class="hexagon un">
				<div class="text_hexa">
				<d>CHOISISSEZ</d><br>
				une faction,<br> incarnez un héro<br> de l'univers<br> Manga ou<br> Cyberpunk.
				</div>
			</div>
			<div class="hexagon deux">
				<div class="text_hexa">
				<d>INVOQUEZ</d><br>
				des créatures,<br> lancez des sorts<br> et amenez votre<br> héro à la<br> victoire.
				</div>
			</div>
			<div class="hexagon trois">
				<div class="text_hexa">
				<d>AFFRONTEZ</d><br>
				vos adversaires<br> lors de duels<br> épiques.
				</div>
			</div>
			<div class="hexagon quatre">
				<div class="text_hexa">
				<d>RETROUVEZ</d><br>
				dans votre deck<br>des personnages<br>cultes.
				</div>
			</div>
			<div class="hexagon cinq">
				<div class="text_hexa">
				<d>CYSTOPIA</d><br>
				théâtre d'une<br> guerre sans<br>merci entre les<br>Cyberpunk et la<br>rebelion<br>Manga.
				</div>
			</div>
			<div class="clear"></div>
			<div class="dispo">
				<div class="colorBlueMilieu">DISPONIBLE LE : </div><br>
				<p>28 novembre 2017</p> <br>
				<div class="icon_social">
					<i class="fa fa-facebook" aria-hidden="true"></i>
					<i class="fa fa-twitter" aria-hidden="true"></i>
					<i class="fa fa-instagram" aria-hidden="true"></i>
				</div>
				<div class="colorBlueMilieu url">www.CYSTOPIA.COM</div>
			</div>
		</div>
		<div class="img_droite">
			<img src="images/fma.png" alt="Full metal alchimiste">
		</div>
		</div>
		<div class="transition_bas"></div>

	</section> 

	<section class="sectionBas">

		<div id="hexR"><img src="images/hex_x4.png" id="hex4" alt="hexA"></div>	
	
		<div class="wrapper">
			<div id="inscription">
				<div id="hex1"><img src="images/hex_x3.png" id="hex3" alt="hexB"></div>
				<div id="texIns">	
					<h4>Inscription</h4>
					<p>Newsletter</p>
				</div>
					
			</div>

			<div id="midForm">
				<div id="tr1_L" class="tr1_LDef">
					<div id="dot1" class="dot1Def"></div>
				</div><div id="tr2_L" class="tr2_LDef"></div>
				<div id="midRecWrap">
					<div id="blueRec">
						<form action="" method="POST" id="newsForm" onsubmit="return valideMail();">
							<input type="text" name="mailNewsletter" id="inMail" onfocus="displayValid()">
							<button type="submit" id="subMail" class="subMailDef" disabled="disabled" name="submitNews">Entrez Email</button>
						</form>
					</div>
				</div>
				
				<div id="tr1_R" class="tr1_RDef"></div> 
				<div id="tr2_R" class="tr2_RDef"></div> 

				<div id="msgWrap">
					<div id="tr3_R" class="tr3_RDef"></div>
					<div id="dot2" class="dot2Def"></div>
					<div id="msg" class="msgDef">INSCRIVEZ-VOUS <br>pour recevoir <br class="hide"> les dernieres informations sur<br class="hide"> le jeu de <br>CYSTOPIA_</div>
				</div>

			</div>
		</div>

		<!-- <div class="reset">
			<a href="index.php" id="rez" onclick="reset();">reset</a>
		</div> -->

		<div id="fils"></div>

		<div id="popWrap">
			<div id="formPopUp">
				<a href="#sectionBas" id="fermer" onclick="hiddenPop();"><i class="fa fa-times" aria-hidden="true"></i></a>
				<form action="" method="POST" id="popForm">
					<p>
						<label for="mailPopUp" class="lab">EMAIL_</label>
						<input type="text" class="inPop" name="mailPopUp" pattern="^[_.0-9a-z-]+@([0-9a-z][0-9a-z_-]+.)+[a-z]{2,4}$" oninvalid="setCustomValidity('Entrez une vraie adresse mail !')" onchange="try{setCustomValidity('')}catch(e){}" required>
					</p>
					<p>
						<label for="nomPopUp" class="lab">NOM_</label>
						<input type="text" class="inPop" maxlength="30" name="nomPopUp" required>
					</p>
					<p>
						<label for="prenomPopUp" class="lab">PRENOM_</label>
						<input type="text" class="inPop" maxlength="30" name="prenomPopUp" required>
					</p>
						<label for="textArea">DONNEES_</label>
						<p><textarea maxlength="384" name="textArea" required></textarea></p>
						<button type="submit" class="envoyez" name="submitPop">ENVOYEZ_</button>
				</form>
			</div>
		</div>
		
		<footer id="footerSectionBas">
			<a id="contact" href="#sectionBas" onclick="displayPop()">Contactez-Nous</a>
			<div id="social">
				<a href=""><i class="fa fa-facebook" id="fcbk"></i></a>
				<a href="" id="twt"><i class="fa fa-twitter"></i></a>
				<a href=""><i class="fa fa-instagram" id="inst"></i></a>
			</div>
			<span id="mentions">Mentions Legales - <br class="show"> Cystopia Jeu de Cartes © Copyright 2017 <br class="show"> Team Doryphore O3W</span>
		</footer>

	</section>	

	<script src="js/myScript.js"></script>

	</body>
</html>