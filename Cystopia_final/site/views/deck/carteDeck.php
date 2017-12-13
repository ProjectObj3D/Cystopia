
   <form id="choix_deck_form" action="?control=lobby&action=display" method="post" role="form" >
       <?php
    if (isset($tabdecks))
    {$cartes = $tabdecks;


    //intiatilisation des différents type de cartes
    $superTitre = " <div class='nomType ' id='idNomSup'> Super Heros </div>";
    $creatures = " <div class='nomType '> Creatures </div>";$cptCreatures = 0;
    $sorts =     " <div class='nomType '> Sorts </div>";$cptSorts = 0;
    $boucliers = " <div class='nomType '> Boucliers </div>";$cptBoucliers =0;
    $super = "";
    $team = -1;



    if ($cartes) {

        $team = $cartes[0]->getTeam();
        $assets = "assets";
        $ValideBorder ="";
        //echo "<pre>";
        //var_dump($cartes);
        //echo "</pre>";
        $decal = 140;
        foreach ($cartes as $i => $val) {

            $idCreature = $val->getId();
            $type = $val->getType();





            $creature = "";

            $nomDeck = $val->getNom();
            if (strlen($nomDeck) > 12)
            {
                $nomDeck = substr($nomDeck, 0, 10)."...";
            }
            $nomDeck = $nomDeck == "" ? " ... " : $nomDeck;

            
            switch ($type) {
                case 1:
                    $type = 'creatures';
                    $creatures .= "
                        
                            <div class='carte_dos clickChoix ".$ValideBorder."' for='id_". $val->getId()."_".$i."' style='    background-image: url(./assets/".$val->getSrc().");'>
                                <div class='labelSpanChoix'>" . $nomDeck . "</div>
                                <div data-mana=".$val->getMana()." class=\"carteNum carteMana\">".$val->getMana()."</div>
                                <div data-attaque=".$val->getAttaque()." class=\"carteNum carteAttaque\">".$val->getAttaque()."</div>
                                <div data-vie=".$val->getDefense()." class=\"carteNum carteVie\">".$val->getDefense()."</div>
                                <div data-name=".$val->getNom()." class=\"carteData carteNom\">".$val->getNom()."</div>
                                <div data-description=\"".$val->getDescription()."\" class=\"carteData carteText\">".$val->getDescription()."</div>
                                <label class='' id='idLabel_".$val->getId()."_". $i."'> </label>
                                <input class='input_choix' data-type='1' type='checkbox' id='id_". $val->getId()."_".$i."'  name='choix_cartes_team_" . $val->getId() . "_".$i."' value=" . $val->getId() . ">


                                
                                
                           
                            </div>
                       
                        ";
                    $cptCreatures++;
                    break;
                case 2:
                    $type = 'sorts';
                    $sorts .= "
                        <div class='carte_dos clickChoix ".$ValideBorder."'  for='id_". $val->getId()."_".$i."' style='    background-image: url(./assets/".$val->getSrc().");'>
                                <div class='labelSpanChoix'>" . $nomDeck . "</div>
                                <div data-mana=".$val->getMana()." class=\"carteNum carteMana\">".$val->getMana()."</div>
                                <div data-attaque=".$val->getAttaque()." class=\"carteNum carteAttaque\">".$val->getAttaque()."</div>
                                <div data-name=".$val->getNom()." class=\"carteData carteNom\">".$val->getNom()."</div>
                                <div data-description=\"".$val->getDescription()."\" class=\"carteData carteText\">".$val->getDescription()."</div>
                                <label class='' id='idLabel_".$val->getId()."_". $i."'> </label>
                                <input class='input_choix' data-type='2' type='checkbox' id='id_". $val->getId()."_".$i."'  name='choix_cartes_team_" . $val->getId() . "_".$i."' value=" . $val->getId() . ">
                                
                                
                           
                            </div>
                        ";
                    $cptSorts++;
                    break;
                case 3:
                    $type = 'boucliers';
                    $boucliers .= "
                        <div class='carte_dos clickChoix " .$ValideBorder."'  for='id_". $val->getId()."_".$i."' style='    background-image: url(./assets/".$val->getSrc().");'>
                                <div class='labelSpanChoix'>" . $nomDeck . "</div>
                                 <div data-mana=".$val->getMana()." class=\"carteNum carteMana\">".$val->getMana()."</div>
                                <div data-attaque=".$val->getAttaque()." class=\"carteNum carteAttaque\">".$val->getAttaque()."</div>
                                <div data-vie=".$val->getDefense()." class=\"carteNum carteVie\">".$val->getDefense()."</div>
                                <div data-name=".$val->getNom()." class=\"carteData carteNom\">".$val->getNom()."</div>
                                <div data-description=\"".$val->getDescription()."\" class=\"carteData carteText\">".$val->getDescription()."</div>
                                <label class='' id='idLabel_".$val->getId()."_". $i."'> </label>
                                <input class='input_choix' data-type='3' type='checkbox' id='id_". $val->getId()."_".$i."'  name='choix_cartes_team_" . $val->getId() . "_".$i."' value=" . $val->getId() . ">
                                
                                
                           
                            </div>
                        ";
                    $cptBoucliers++;
                    break;
                 case 4:
                    $type = 'SuperHeros';
                    $super    ="
                       <div class='carte_dos borderValide ".$ValideBorder."'  for='id_". $val->getId()."_".$i."' style='    background-image: url(./assets/".$val->getSrc().");'>
                                <div class='labelSpanChoix'>" . $nomDeck . "</div>
                                <label class='' id='idLabel_".$val->getId()."_". $i."'> </label>
                                <input cheked class='superHeros' data-type='4' type='checkbox' id='id_". $val->getId()."_".$i."'  name='choix_cartes_team_" . $val->getId() . "_".$i."' value=" . $val->getId() . ">
                                
                                
                           
                            </div>
                        ";
                    break;
            }
        }
        //echo '</div>';
        echo '<div class="container_deck">';
        echo $superTitre;
        echo $super;
        if ( $cptCreatures != 0) echo $creatures ."";
        //echo "<hr>";

        if ($cptBoucliers != 0) echo $boucliers."";
        //echo "<hr>";


        if ($cptSorts != 0) echo $sorts."";
        echo "</div>
            <div class='new_deck'>
        <input type='submit' name='choix_deck_submit' id='choixsubmit'  value='Jouer'>
        <input type='hidden' value='".$idDeck."' name='iddeck'>
        <input type='hidden' value='".$team."' name='numTeam'>
           
    </div>


           ";
        }
        else{
            echo '<div class="container_deck">';
            echo $cartes;
            echo "</div>";
        }
    }
    ?>


    </form>


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
