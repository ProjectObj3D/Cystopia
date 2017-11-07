<!--
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title> create </title>
	</head>
	<body>
	-->
       <!-- <form id="choix_deck_form" action="?control=deck&action=createTeam" method="post" role="form" > -->
       	<div class="container_deck">
       		<div class="centrer">
		<?php

		
			foreach ($heros as $hero) {
				
			 	$Hero = ($hero->getId()=='1') ? 'seiya.png' : 'sonny.jpg';
			 	
			 	echo "
			 		<div class='choixHero'>
			 			<div class='carte_hero' style='background-image: url(./assets/heros/".$Hero.");'>
				 			<a href='?control=deck&action=createTeam&choix_hero=".$hero->getId()."''>".' '."
				 				<div class='nomCarteHero'>".$hero->getNom()."</div>
				 			</a>
				 		</div>
			 		</div>";
			 	//<input class='nomHero' type='radio' name='choix_hero' value=".$hero->getId().">" .$hero->getNom(). "<br></div>";
			 	echo "";
			 } 
		?>
			</div>
        </div>   
        <div class="new_deck">
			<!-- <input type="submit" name="choix_deck_submit" id="choixsubmit"  class="" value="Valider"> -->
		</div>
            
        </form>
        <!--
	</body>
</html>
-->



