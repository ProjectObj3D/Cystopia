<?php 
// var_dump($tabdecks);
/*
echo "get > <br>";
var_dump($_GET);

echo "POST > <br>";
var_dump($_POST);


echo "Session > <br>";
if (isset($_SESSION))
    var_dump($_SESSION);
*/
?>
<!-- 
<html>
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="assets/css/deck.css">
	<title>Document</title>
</head>
<body>
	<p> <?= $message ?></p><br> -->
	
	
	
	<?php
		if ($tabdecks) {
			echo '<div class="container_deck">';
			$decal = 140;
			foreach ($tabdecks as $val) {
				$nomHero = $val->getHero(); 
				$Hero = "";
				$Hero = ($val->getHero()=='1') ? 'seiya.png' : 'sonny.jpg';

				$nomDeck = $val->getNom();
				if (strlen($nomDeck) > 12)
				{
					$nomDeck = substr($nomDeck, 0, 10)."...";
				}
				$nomDeck = $nomDeck == "" ? " ... " : $nomDeck;
				echo "
					<div class='carte_dos' style='left:".$decal."px;    background-image: url(./assets/images/heros/".$Hero.");'>
						<a href='?control=deck&action=displayCardOfDeckById&idDeckDisplay=".$val->getId()."''>".' '."
							<p class='nomCarteDeck'>".$nomDeck."</p>
						</a>
					</div>";

				$decal += 140;
				//echo '<li><a href="?id='.$val->getId().'">'.$val->getNom().'</a></li>';
			}
			echo '</div>';
		}
	?>
	
	
	<div class="new_deck">
		<a class="white" href="?control=deck&action=create">Nouveau Deck</a>
	</div>
<!-- 	
</body>
</html> 
-->