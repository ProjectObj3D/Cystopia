<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Cystopia</title>
    <link rel="stylesheet" href="assets/css/plateau.css">
    <script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>

        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="assets/js/plateau.js"></script>
</head>
	<body>
		<table id="plateau">
			<tr class="row1">
				<td id="col1" rowspan="6">
                    <div id="imgHero1"></div>
                    <div id="turnDisplay"> 
                        <span id="tourText">TOUR</span>
                        <span id="tourNum">7</span>
                    </div>
                    <div id="imgHero2"></div>
                </td>
				<td id="col2">
					<div class="heroData" id="dataHero1">
						<h5 class="heroName" id="heroName1">SEIYA</h5>
						<p class="heroNamePV">PV<span class="heroNameNum" id="PvHero1">18</span></p>
					</div>
				</td>
				<td id="col3">
                    <div id="hand1">
                        <?php
                            for ($i = 0; $i < 4; $i++)
                            {
                                echo '<div class="carte" id="hero1carte'.$i.'"></div>';
                            }
                        ?>
                    </div>

                </td>

				<td id="col4" colspan="2">
                    <div class="cardData" id="cardData1">
                        <h5>MOTOKO</h5>
                        <div  id="textCardDataA1"><span>3</span><p>INVOCATION</p></div>
                        <div id="textCardDataB1"><span>5</span><p>ATTAQUE</p></div>
                        <div id="textCardDataC1"><span>3</span><p>DEFENSE</p></div>
                    </div>
                </td>
			</tr>

			<tr class="row2">
				<td></td>
				<td class="mana">
                    <div class="heroManaData" id="heroManaData1">
                        <span class="manaText">MANA</span>
                        <div class="manaChevWrap" id="manaChevWrap1">
                        </div>
                        <span class="heroMana" id="hero1ManaNum">7</span>
                    </div>
                </td>
				<td id="col5"></td>
				<td rowspan="4">
                    <div id="deck1" class="pioche"></div>
                    <div id="turnButton">
                        <span id="buttonText1">FIN DU</span>
                        <div id="innerButton"></div>
                        <span id="buttonText2">TOUR</span>
                    </div>
                    <div id="deck2" class="pioche">

                       <?php createPioche($pioche);?>

                    </div>
                </td>
			</tr>

			<tr class="row3">
				<td colspan="3" id="dropper" align="center"></td>
			</tr>

			<tr class="row3">
				<td colspan="3"></td>
			</tr>

			<tr class="row2">
				<td></td>
				<td class="mana">
                    <div class="heroManaData" id="heroManaData2">
                        <span class="manaText">MANA</span>
                        <div  class="manaChevWrap" id="manaChevWrap2">
                        </div>
                        <span class="heroMana" id="hero2ManaNum">4</span>
                    </div>
                </td>
				<td></td>
			</tr>

			<tr class="row1">
				<td>
                    <div class="heroData" id="dataHero2">
                        <h5 class="heroName" id="heroName2">NSS SONNY</h5>
                        <p class="heroNamePV">PV <span class="heroNameNum" id="PvHero2">8</span></p>
                    </div>
                </td>
				<td>
                    <div id="hand2">

                    </div>
                </td>
				<td colspan="2">
                    <div class="cardData" id="cardData2">
                        <h5>BIG DADDY</h5>
                        <div  id="textCardDataA2"><span>5</span><p>INVOCATION</p></div>
                        <div id="textCardDataB2"><span>2</span><p>ATTAQUE</p></div>
                        <div id="textCardDataC2"><span>8</span><p>DEFENSE</p></div>
                    </div>
                </td>
			</tr>
		</table>

	</body>
</html>
