<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>layout</title>
        <link rel="stylesheet" type="text/css" href="assets/css/deck.css">
        <link rel="stylesheet" href="assets/css/bootstrap-3.3.6/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="assets/js/tooltipster-master/dist/css/tooltipster.bundle.min.css" />
        <link rel="stylesheet" type="text/css" href="assets/js/tooltipster-master/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css" />
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/css/bootstrap-3.3.6/js/bootstrap.js"></script>
        <script type="text/javascript" src="assets/js/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>
        <script>
            $(document).ready(function() {

                 $('.carte_dos').each(function(){
                    }).click(function(){
                        var attaque = $(this).find('.carteAttaque').data('attaque');
                        if($(this).find('.carteVie').attr('data-vie'))
                        {
                           var defense = $(this).find('.carteVie').data('vie'); 
                        }
                        else
                        {
                            var defense = '';
                        }
                        var description = $(this).find('.carteText').data('description');
                        var mana = $(this).find('.carteMana').data('mana');
                        var name_card = $(this).find('.carteNom').data('name');
                        var img = $(this).css('background-image');

                        // console.log('attaque = '+ attaque +' ; defense = '+defense+'; description='+description+'; Mana = '+mana+' ; nom carte = '+name_card+' ; lien img =' + img );
                        $('.img_dialog').css('background-image',img); 
                        if($('.dialog_card_description').length)
                        {
                            $('.dialog_card_description').html(description);
                        }
                        else
                        {
                           $('.dialog_content .cardData').last().append($("<div class='dialog_card_description'>"+description+"</div>"));
                        }

                        $('h5[name=nom_carte]').html(name_card);
                        if(mana !== undefined) {
                            $('div[name=mana]').html('<span>'+mana+'</span><p>INVOCATION</p>');
                        }
                        if(attaque !== undefined) {
                            $('div[name=attaque]').html('<span>'+attaque+'</span><p>ATTAQUE</p>');      
                        }
                        if(defense !== undefined)
                        {
                            $('div[name=defense]').html('<span>'+defense+'</span><p>DEFENSE</p>');         
                        }
                        else
                        {
                            $('div[name=defense] span').replaceWith(" ");
                            $('div[name=defense] p').replaceWith(" ");
                        }

                          // $('#textCardDataA1').html('<span>'+mana+'</span><p>INVOCATION</p>');
                          // $('#textCardDataB2').html('<span>'+attaque+'</span><p>ATTAQUE</p>');
                          // $('#textCardDataC2').html('<span>'+defense+'</span><p>DEFENSE</p>');
                          
                          $('#dial').css("display", "block").dialog({
                        //        autoOpen: false,  
                                // modal: true,
                                width : 800,
                                height : 557,  
                                closeText: 'X', 
                                draggable: false,
                                dialogClass : 'fixed-dialog',
                                position : {my : "center" , at: "center"}

                            });  
                            return false;
                    });
                    // $( "#dial" ).dialog( "option", "closeText", "hide" );
                    // $( "#dial" ).dialog( "option", "position", { my: "left top", at: "left bottom", of: button } );

                $('.tooltipstered').tooltipster({
                    theme: 'tooltipster-borderless'
                });
            });





        </script>
    </head>
    <body class='body'>
        <nav class="navbar tailleLayout">


            <?= $titre ?>


            <div class="droite">
            <?php
            if ( isset($modifier))
                {
                    echo '<a class="btn btn-primary tooltipstered" title="Modifier ce deck" href ="index.php?control=deck&action=updateDeck&idDeck='.$idDeck.'" aria - label = "Delete" >
                            <i class="fa fa-pencil fa-fw" ></i >
                          </a >';
                }
                if ( isset( $idDeck))
                {
                    echo '<a class=" btn btn-danger tooltipstered" title="Supprimer le deck" href = "index.php?control=deck&action=deleteDeck&idDeck='.$idDeck.'" aria - label = "Delete" >
                            <i class="fa fa-trash-o" ></i >
                          </a >';
                }
            if ( isset($retour)) {
                echo '

                <a class="btn btn-primary btn-sm tooltipstered" href ="?control=deck&action='.$retour.'"  title="Retour" name = "deconectMenu" alt="retour">
                    <i class="fa fa-reply" ></i >
                </a >';
            }
                ?>
                <a class="btn btn-primary tooltipstered" href="?control=user&action=display" title="Mon compte" name="mon_compte">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>
                <a class="btn  btn-sm btn-primary tooltipstered" title="Se déconnecter" href="?logout=1" name="deconectMenu" >
                    <i class="fa fa-sign-out"></i>
                </a>

            </div>
        </nav>
        <?=$view?>
    </body>
</html>
