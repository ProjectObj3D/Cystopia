<script type="text/javascript" src="assets/js/deck.js"></script>
<form  id="choix_deck_form" action="./index.php?control=deck&action=addDeck&choix_hero=<?=$choix_hero?>" method="post" role="form" >

<?php

// action="./index.php?control=deck&action=nomDeckDisplay&choix_hero= <?=$choix_hero
//    var_dump($cartes); ?control=deck&action=addDeck


        //intiatilisation des différents type de cartes
        $superTitre = " <div class='nomType' id='idNomSup'> Super Heros </div>";
        $creaturesTitre = " <div class='nomType' id='idNomCre'> Creatures </div><p id='idCrea' class='rouge' ></p>";
        $sortsTitre =     " <div class='nomType' id='idNomSor'> Sorts </div><p id='idSor' class='rouge' ></p>";
        $boucliersTitre = " <div class='nomType' id='idNomBou'> Boucliers </div><p id='idBou' class='rouge' '></p>";
        
        $creatures = "";
        $sorts =     "";
        $boucliers = "";
        $superHeros = "";
        $ValideBorder ="";

        if ($cartes) 
        {

            $decal = 140;
            $fin = 3 ;

            if ( isset ($update) )
                {
                    $fin = 2;
                    $ValideBorder = "ValideBorderGreen";
                }

            for ( $i = 1; $i < $fin ; $i++) 
            {
                

                foreach ($cartes as $val) 
                {   
                    if( isset ($notDeck)){


                        foreach ($notDeck as $keyNotDeck => $valueNotDeck) {
                            if ($val === $valueNotDeck)
                            {
                                $ValideBorder = "";
                            }
                        }
                    } 
                    $idCreature = $val->getId();
                    $type = $val->getType();


                    $creature = "";
                   
                    $nomDeck = $val->getNom();
                    if (strlen($nomDeck) > 12) 
                    {
                        $nomDeck = substr($nomDeck, 0, 10) . "...";
                    }
                    $nomDeck = $nomDeck == "" ? " ... " : $nomDeck;


                    switch ($type) {
                        case 1:
                            $type = 'creatures';
                            $creatures .= "
                        
                            <div class='carte_dos clickChoix ".$ValideBorder."' for='id_". $val->getId()."_".$i."' style='    background-image: url(./assets/".$val->getSrc().");'>
                                <div class='labelSpanChoix'>" . $nomDeck . "</div>
                                <label class='' id='idLabel_".$val->getId()."_". $i."'> </label>
                                <input class='input_choix' data-type='1' type='checkbox' id='id_". $val->getId()."_".$i."'  name='choix_cartes_team_" . $val->getId() . "_".$i."' value=" . $val->getId() . ">
                                
                                
                           
                            </div>
                       
                        ";

                            break;
                        case 2:
                            $type = 'sorts';
                            $sorts .= "
                        <div class='carte_dos clickChoix ".$ValideBorder."'  for='id_". $val->getId()."_".$i."' style='    background-image: url(./assets/".$val->getSrc().");'>
                                <div class='labelSpanChoix'>" . $nomDeck . "</div>
                                <label class='' id='idLabel_".$val->getId()."_". $i."'> </label>
                                <input class='input_choix' data-type='2' type='checkbox' id='id_". $val->getId()."_".$i."'  name='choix_cartes_team_" . $val->getId() . "_".$i."' value=" . $val->getId() . ">
                                
                                
                           
                            </div>
                        ";
                            break;
                        case 3:
                            $type = 'boucliers';
                            $boucliers .= "
                        <div class='carte_dos clickChoix " .$ValideBorder."'  for='id_". $val->getId()."_".$i."' style='    background-image: url(./assets/".$val->getSrc().");'>
                                <div class='labelSpanChoix'>" . $nomDeck . "</div>
                                <label class='' id='idLabel_".$val->getId()."_". $i."'> </label>
                                <input class='input_choix' data-type='3' type='checkbox' id='id_". $val->getId()."_".$i."'  name='choix_cartes_team_" . $val->getId() . "_".$i."' value=" . $val->getId() . ">
                                
                                
                           
                            </div>
                        ";

                            break;
                         case 4:
                            $type = 'SuperHeros';
                            $superHeros    ="
                       <div class='carte_dos borderValide ".$ValideBorder."'  for='id_". $val->getId()."_".$i."' style='    background-image: url(./assets/".$val->getSrc().");'>
                                <div class='labelSpanChoix'>" . $nomDeck . "</div>
                                <label class='' id='idLabel_".$val->getId()."_". $i."'> </label>
                                <input cheked class='superHeros' data-type='4' type='checkbox' id='id_". $val->getId()."_".$i."'  name='choix_cartes_team_" . $val->getId() . "_".$i."' value=" . $val->getId() . ">
                                
                                
                           
                            </div>
                        ";
                            break;
                    }

                }
            }
            //echo '</div>';
            echo '<div class="container_deck">';
            echo $superTitre;
            echo $superHeros;
            echo $creaturesTitre;

                echo $creatures ."";
           // echo $creatures ."";
            echo "<hr>";
            echo $boucliersTitre;

            echo $boucliers."";
            //echo $boucliers."";
            echo "<hr>";
            echo $sortsTitre;
            echo $sorts."";
            //echo $sorts."";
            echo "</div>";
        }
    ?>
    <div class="new_deck nomDeckClass">
            <p id='idErreurNomDeck' class='rouge' ></p>
            <input type="text" name="choixNomDeck" id="idNomDeck"  class=" inputDeck" placeholder="Nom de votre deck">
            <input type="text" name="fauxinput" class="fauxinput inputDeck" value="">
        
    </div>

    <div class="new_deck">
       <!-- <a class="white" href="?control=deck&action=create">Valider</a> -->
        <input type="button" name="choix_deck_submit" id="choixsubmit"  class="" value="Valider" >
        
    </div>
    
</form>
