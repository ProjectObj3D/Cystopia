 <form id="choix_deck_form" action="?control=plateau&action=display" method="post" role="form" >
    <br>
    

<?php
   // /*
        //var_dump($_SESSION);
        if (isset($tabdecks)) {
            echo '<div class="container_deck">';
            $decal = 140;
            foreach ($tabdecks as $val) {
                $idCreature = $val->getId(); 
                $type = $val->getType();
                switch ($type) {
                                case 1:
                                    $type = 'creatures';
                                    break;
                                case 2:
                                    $type = 'sorts';
                                    break;
                                case 3:
                                    $type = 'boucliers';
                                    break;
                                case 4:
                                    $type = 'creatures';
                                    break;
                                }


                $creature = "";
                switch ($idCreature) {
                                case 1:
                                    $creature = '1_naruto.png';
                                    break;
                                case 2:
                                    $creature = '1_luffy.png';
                                    break;
                                case 3:
                                    $creature = '1_mononoke.png';
                                    break;
                                case 4:
                                    $creature = '1_eva.png';
                                    break;
                                case 5:
                                    $creature = '1_kaneda.png';
                                    break;
                                case 6:
                                    $creature = '1_motoko.png';
                                    break;
                                case 7:
                                    $creature = '1_deathnote.png';
                                    break;
                                case 8:
                                    $creature = '1_eclair.png';
                                    break;
                                case 9:
                                    $creature = '1_marteau.png';
                                    break;
                                case 10:
                                    $creature = '1_goldorak.png';
                                    break;
                                case 11:
                                    $creature = '1_alphonse.png';
                                    break;
                                case 12:
                                    $creature = '1_son-goku.png';
                                    break;
                                case 13:
                                    $creature = '2_sentinelle.png';
                                    break;
                                case 14:
                                    $creature = '2_chappie.png';
                                    break;
                                case 15:
                                    $creature = '2_quorra.png';
                                    break;
                                case 16:
                                    $creature = '2_adam.png';
                                    break;
                                case 17:
                                    $creature = '2_roy.png';
                                    break;
                                case 18:
                                    $creature = '2_major.png';
                                    break;
                                case 19:
                                    $creature = '2_zf-creatures.png';
                                    break;
                                case 20:
                                    $creature = '2_virus.png';
                                    break;
                                case 21:
                                    $creature = '2_sentence.png';
                                    break;
                                case 22:
                                    $creature = '2_t800.png';
                                    break;
                                case 23:
                                    $creature = '2_daddy.png';
                                    break;
                                case 24:
                                    $creature = '2_robocop.png';
                                    break;
                            }

                //$Hero = ($val->getNom()=='creatures') ? 'seiya.png' : 'sonny.jpg';

                $nomDeck = $val->getNom();
                if (strlen($nomDeck) > 12)
                {
                    $nomDeck = substr($nomDeck, 0, 10)."...";
                }
                $nomDeck = $nomDeck == "" ? " ... " : $nomDeck;
                echo "
                <div class='carte_dos' style='    background-image: url(./assets/images/".$type."/".$creature.");'>
                    <a href='?id=".$val->getId()."''>".' '."
                        <p class='nomCarteDeck'>".$nomDeck."<input class='input_choix' type='checkbox' name='choix_cartes_team". $val->getId() ."' value=".$val->getId().">
                        </p>
                    </a>
                </div>";
                //echo '<li><a href="?id='.$val->getId().'">'.$val->getNom().'</a></li>';
                 //echo "<input type='checkbox' name='choix_cartes_team". $val->getId() ."' value=".$val->getId().">" .$val->getNom(). "<br>";
            }
            echo '</div>';
        }
        else{
                        echo '<div class="container_deck">';
                        echo "$cartes";
                        echo "</div>";
        }
        // */
    ?>
    <div class="new_deck">
       <!-- <a class="white" href="?control=deck&action=create">Valider</a> -->
        <input type="submit" name="choix_deck_submit" id="choixsubmit"  class="" value="Valider">
        
    </div>
    
    </form>
    