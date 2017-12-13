<link rel="stylesheet" type="text/css" href="assets/css/login.css">
<link rel="stylesheet" href="assets/css/font-awesome-4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="./assets/js/nomDeck.js"></script>

<form id="idNommDeckform" action="./index.php?control=deck&action=addDeck" method="post" role="form" style="display: block;">';
<style>


.form-group{
	width: 100%;
}
.inputDeck {
	display: inline-block;
	width: 80%;
}

input{

	margin:15px;
}

.fauxinput {
  display: none;
}
</style>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-12">
            <p id='idErreurNomDeck' class='rouge' ></p>
            <div class="form-group">
                <input type="text" name="choixNomDeck" id="idNomDeck"  class=" inputDeck" placeholder="Nom de votre deck"><input type="button" name="choix_deck_submit" id="choixsubmit"  class="" value="Valider"  >
                 <input type="text" name="fauxinput" class="fauxinput inputDeck" value="">

            </div>


        </div>
    </div>
</div>
</form>
