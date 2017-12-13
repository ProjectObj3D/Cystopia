<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Cystopia</title>
    <link rel="stylesheet" href="assets/css/plateau.css">
    <script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>

    <script src="assets/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/ajax.js"></script>
    <script type="text/javascript" src="assets/js/game.js"></script>
    <script type="text/javascript" src="assets/js/plateau.js"></script>

</head>
	<body>
		<table id="plateau">
			<tr class="row1">
				<td id="col1" rowspan="6">
                    <div id="imgHero1"></div>
                    <div id="turnDisplay"> 
                        <span id="tourText">TOUR</span>
                        <span id="tourNum"></span>
                    </div>
                    <div id="imgHero2"></div>
                </td>
				<td id="col2">
					<div class="heroData" id="dataHero1">
						<h5 class="heroName" id="heroName1">SEIYA</h5>
						<p class="heroNamePV">PV<span class="heroNameNum" id="PvHero1"></span></p>
					</div>
				</td>
				<td id="col3">
                    <div id="hand1">

                    </div>

                </td>

				<td id="col4" colspan="2">
                    <div class="cardData" id="cardData1">
                        <h5></h5>
                        <div  id="textCardDataA1"><span></span><p>INVOCATION</p></div>
                        <div id="textCardDataB1"><span></span><p>ATTAQUE</p></div>
                        <div id="textCardDataC1"><span></span><p>DEFENSE</p></div>
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
                        <span class="heroMana" id="hero1ManaNum"></span>
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

                    </div>
                </td>
			</tr>

			<tr class="row3">
				<td colspan="3" align="center" id="dropperAdversaire"></td>
			</tr>

			<tr class="row3">
				<td colspan="3" id="dropper" align="center"></td>
			</tr>

			<tr class="row2">
				<td></td>
				<td class="mana">
                    <div class="heroManaData" id="heroManaData2">
                        <span class="manaText">MANA</span>
                        <div  class="manaChevWrap" id="manaChevWrap2">
                        </div>
                        <span class="heroMana" id="hero2ManaNum"></span>
                    </div>
                </td>
				<td></td>
			</tr>

			<tr class="row1">
				<td>
                    <div class="heroData" id="dataHero2">
                        <h5 class="heroName" id="heroName2"></h5>
                        <p class="heroNamePV">PV <span class="heroNameNum" id="PvHero2"></span></p>
                    </div>
                </td>
				<td>
                    <div id="hand2">

                    </div>
                </td>
				<td colspan="2">
                    <div class="cardData" id="cardData2">
                        <h5></h5>
                        <div  id="textCardDataA2"><span></span><p>INVOCATION</p></div>
                        <div id="textCardDataB2"><span></span><p>ATTAQUE</p></div>
                        <div id="textCardDataC2"><span></span><p>DEFENSE</p></div>
                    </div>
                </td>
			</tr>
		</table>
           <div id="dial" style='display: none'>
            <div class="dialog_carte">
                <img class="img_dialog" style="background-size: contain;">
                <div class="dialog_content">
                    <img style="">
                   <div class="cardData" id="cardData1" style="position: relative !important;">
                        <h5 name="nom_carte" id="name_cardData"></h5>
                        <div name="mana" id="textCardDataA1"></div>
                        <div name="attaque" id="textCardDataB1"></div>
                        <div name="defense" id="textCardDataC1"></div>
                    </div>
                </div>
            </div>
        </div>
    <div class="menu_echap fond_menu"></div>
    <div class="menu menu_echap">
        <a href="" class="btn-deco hvr-shutter-out-horizontal">Abandonner</a> 
    </div>

	</body>
</html>
<?php
// var_dump($_SESSION);
?>