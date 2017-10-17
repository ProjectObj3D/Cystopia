<?php


	spl_autoload_register(function($class){
	require 'classes/'.$class.'.class.php';
	});
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Plateau</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div id="plateau">
			<div id="bouton"></div>
	
				<?php

				spl_autoload_register(function($class){
				require 'classes/'.$class.'.class.php';
				});

				$cManager = new CardsManager();
				$deckUtil1 = $cManager->getCardByTeam(1);
				$deckUtil2 = $cManager->getCardByTeam(2);

				//var_dump($deckUtil1);

				$tailleMain = 490;
				$tailleCarte = 140;
				$nbCartes = 3;			

				if ($tailleCarte*$nbCartes < $tailleMain) {

					echo '<div id="mainAdversaire" style="text-align:center">';
					$reste=$tailleMain/$nbCartes;
					$decal=($tailleMain-$reste)/$nbCartes;

					//for ($i=0; $i < $nbCartes; $i++) { 
					$i=0;
					foreach ($deckUtil1 as $carte) {
						
						$lft=$decal*$i;
						//print_r($carte);

					 	echo '<div class="carte" style="position:relative;background-image:url(images/creatures/1_'.$carte->getNom().'.png);"></div>';
					 	$i++;
					 	// if ()
					 }
					 echo "</div>";
				}
				else{
					echo '<div id="mainAdversaire">';
					$reste=$tailleMain/$nbCartes;
					$decal=($tailleMain-($tailleCarte-$reste))/$nbCartes;

					//for ($i=0; $i < $nbCartes; $i++) { 
					$i=0;
						foreach ($deckUtil1 as $carte) {

						$lft=$decal*$i;

					 	// echo '<div class="carte_dos" style="transform: translate('.$lft.'px,0); margin: 0 auto;"></div>';
					 	echo '<div class="carte" style="transform: translate('.$lft.'px,0); margin: 0 auto;;background-image:url(images/creatures/1_'.$carte->getNom().'.png);"></div>';
					 	$i++;
					 }
					  echo "</div>";
				}
					
				?>
			</div>
			

		</div>
	




	</body>
</html>
<?php
// spl_autoload_register(function($class){
// 	require 'classes/'.$class.'.class.php';
// });




// $cManager = new CardsManager();

// $deckUtil1 = $cManager->getCardByTeam(1);
// $deckUtil2 = $cManager->getCardByTeam(2);

// var_dump($deckUtil1);
