<?php



class deckController extends coreController
{

    /*
    * On utilise un layout pour mutualiser des vues
    *
    */
    private function renderView($viewName, array $viewData = array())
    {
        //On importe le contenu du tableau dans des variables locales
        extract($viewData, EXTR_SKIP);

        //On rend la vue dans une variable et pas directement sur l'écran utilisateur
        ob_start();

        include('views'.DIRECTORY_SEPARATOR.'deck'.DIRECTORY_SEPARATOR. $viewName . '.php');

        $view = ob_get_contents();

        ob_end_clean();

        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        //Le layout utilisera $view
        include('views'.DIRECTORY_SEPARATOR.'deck'.DIRECTORY_SEPARATOR.'layoutDeck.php');
    }



    /*
    * On vérifie le nom du deck qu'on va rentrer en base de données
    * retourne un json de validation
    */
    public function displayDeckAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $id = $_SESSION['CY']['id'];
        $tabdecks = $this->getModel()->listDeck($id);

        $message = "";
        if ($tabdecks != false && $tabdecks > 0)
        {
            // on affiche les decks du tableau

            // var_dump($tabdecks);
            $titre = " Mes Decks";
            $this->renderView('deck', array('id'=>$id,'tabdecks' => $tabdecks, "titre" => $titre));
        }
        else
        {
            //pas de decks en bdd on va créer un deck
            //$message = " Crée ton Deck  ";
            $this->createAction();
        }

    }



    /*
    * on choisit son héros pour la création d'un nouveau deck
    *
    */
    public function createAction()
    {

        $heros = $this->getModel()->getHeroList();
        $retour = "displayDeck";
        $this->renderView('create', array('heros'=>$heros,"titre" => "Choix Du Héros : ", "retour"=>$retour));
    }



    /*
    * on choisit les cartes de son deck
    *
    */
    public function createTeamAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $choix_hero = $this->getParams('choix_hero');

        if(isset($choix_hero))
        {
            $idChoixHero = intval($choix_hero);
        }
        $cartes = $this->getModel()->listCarteTeam($idChoixHero);


        if ( $idChoixHero == 1 ){$titre = " Team Manga";}
        elseif ( $idChoixHero == 2 ){$titre = " Team Cyber";}

        $retour = "create";
        $this->renderView('createListeCarte', array('cartes'=>$cartes,'titre' => $titre, "retour"=>$retour, "choix_hero"=>$choix_hero ));

    }


    /*
    * On vérifie que le deck est bien composé
    *
    */
    public function verifCreateTeamAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        //print_r($this->getData());
        $temp = $this->getData();
        $cartes_new_deck =array_splice($temp, 0,20);

        foreach ($cartes_new_deck as $carte)
        {
            $cartes[] = $this->getModel()->getCarte($carte);
        }
        //print_r($cartes);
        $cptCreature = 0;
        $cptBoucliers = 0;
        $cptSorts = 0;

        if (isset($cartes))
        {
            foreach ($cartes as $carte)
            {
                switch ($carte->getType())
                {
                    case 1:
                        $cptCreature++;
                        break;
                    case 2:
                        $cptSorts++;
                        break;
                    case 3:
                        $cptBoucliers++;
                        break;
                }

            }

            $txtCreatures = "";
            $txtBoucliers = "";
            $txtSorts = "";
            if ($cptCreature !== 12) {
                $txtCreatures = $cptCreature . " Vous devez choisir 12 creatures ";
            }
            if ($cptBoucliers !== 4) {
                $txtBoucliers = $cptBoucliers . " Vous devez choisir 4 boucliers ";
            }
            if ($cptSorts !== 3) {
                $txtSorts =  $cptSorts . " Vous devez choisir 3 sorts ";
            }
            if ( $cptCreature == 12 && $cptBoucliers == 4 && $cptSorts == 3) {

                $js = array('validateTeam' => 1);
                $jsEnc = json_encode($js);
                echo $jsEnc;
            }
            else{
                $js = array('validateTeam' => 0,'txtCreatures' => $txtCreatures, 'txtBoucliers' => $txtBoucliers, 'txtSorts' => $txtSorts , 'cartes_new_deck'=>$cartes_new_deck);
                $jsEnc = json_encode($js);
                echo $jsEnc;
            }
        }
    }


    /*
    * On vérifie le nom du deck qu'on va rentrer en base de données
    * retourne un json de validation
    */

    public function verifNomDeckAction(){
        //print_r($this->getData());
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $nomSetDeck = $this->getData()['choixNomDeck'];
        //print_r($nomSetDeck);
        $trouver = "notFound";

        $nomDecks = $this->getModel()->listeDeck($_SESSION['CY']['id']);
        //print_r($nomDecks);
        if ($nomDecks !== false) {
            foreach ($nomDecks as $item) {
                $nomItem = $item->getNom();

                if ($nomItem === $nomSetDeck) {

                    $trouver = "found";
                    break;
                }
            }
        }

        if ($trouver == "found") {

            $js = array('validateNomTeam' => 1, 'nomDeck' => $nomSetDeck);
            $jsEnc = json_encode($js);
            echo $jsEnc;
        } else {

            if ($taille = strlen($nomSetDeck) >= 3) {
                $js = array('validateNomTeam' => 2, 'nomDeck' => $nomSetDeck, 'taille' => $taille, "test" => $nomDecks);
                $jsEnc = json_encode($js);
                echo $jsEnc;
            } else {
                $js = array('validateNomTeam' => 3, 'nomDeck' => $nomSetDeck, 'taille' => $taille);
                $jsEnc = json_encode($js);
                echo $jsEnc;
            }
        }

    }



    /*
    * on rentre un deck en base de données
    *
    */
    public function addDeckAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $temp = $this->getData();
        $cartes_new_deck =array_splice($temp, 0,20);

        //echo "<pre>";
        // print_r($this->getData());

        //print_r($cartes_new_deck);
        //echo "</pre>";


        $temp = $this->getData();
        $cartes_new_deck =array_splice($temp, 0,20);
        $cpt = 0; $i = 1;
        foreach ($cartes_new_deck as $key => $value1) {
            $cpt = 1 ;
            foreach ($cartes_new_deck as $key => $value2) {

                if($value1 == $value2){
                    $nombresCartes[$value2] =$cpt++ ;

                }
                $i++;

            }
        }
        //print_r($nombresCartes);


        $deck = $this->getModel()->addDeck(array('nom'=> $this->getData()['choixNomDeck'] , 'hero'=>$this->getParams()['choix_hero'],'userFk'=>$_SESSION['CY']['id']));

        if (isset ( $nombresCartes ))
        {
            foreach ( $nombresCartes  as $val => $key)
            {
                if ( $key == 2)
                    $deckCarte = $this->getModel()->addRelDeck(array('deckId'=> $_SESSION['last_deck_creater'], 'carteID'=>intval($val), 'nbreCartes'=>intval(1)));
                $deckCarte = $this->getModel()->addRelDeck(array('deckId'=> $_SESSION['last_deck_creater'], 'carteID'=>intval($val), 'nbreCartes'=>intval($key)));
            }
        }
        //$this->displayDeckAction();
        header('location:index.php?control=deck&action=displayDeck');
    }


    /*
    * on efface un deck de la base
    *
    */
    public function deleteDeckAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $idDeck = $this->getParams('idDeck');
        $deck = $this->getModel()->deleteDeck(array('idDeck'=> $idDeck ));

        //$retour = "displayDeck";
        //$this->renderView('create', array('heros'=>$heros,"titre" => "Choix Du Héros : ", "retour"=>$retour));
        //$this->displayDeckAction();

        header('location:index.php?control=deck&action=displayDeck');
    }


    /*
    * on afiche un deck au complet
    *
    */
    public function displayCardOfDeckByIdAction()
    { //listCardOfDeckById
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $decknom = $this->getParams('deckNom');
        $idDeckDisplay = $this->getParams('idDeckDisplay');


        $idDeck = intval($idDeckDisplay);
        $tabdecks = $this->getModel()->listCardOfDeckById($idDeck);

        $message = "";
        $titre = " Deck : ";
        if ( isset($decknom))
        {
            $titre .= $decknom;
        }

        $deckHero = $this->getParams('deckHero');

        if ( isset($deckHero) )
        {
            if ($deckHero == 1)
            {
                $titre .= " - Team Manga ";
            }
            elseif ($deckHero == 2)
            {
                $titre .= " - Team Cyber ";
            }
        }

        if ($tabdecks != false && $tabdecks > 0)
        {
            // on affiche les decks du tableau
            $message = " on a plusieurs cartes ";
            // var_dump($tabdecks);
            $modifier = "modifier";
            $retour = "displayDeck";
            $this->renderView('carteDeck', array('tabdecks' => $tabdecks,"titre" => $titre, 'modifier'=>$modifier, 'retour'=>$retour , 'idDeck'=>$idDeck));
        }
        else
        {
            //pas de decks en bdd on affiche juste creation deck
            //$message = " Crée ton Deck  ";
            //$this->createAction();
            $modifier = "modifier";
            $retour = "displayDeck";
            $this->renderView('carteDeck', array('cartes' => "Pas de Cartes dans ce Deck", "titre" => $titre."    (pas de carte) ",'modifier'=>$modifier, 'retour'=>$retour , 'idDeck'=>$idDeck));
        }

    }


    /*
   * on fait une mise à jour d'un deck
   *
   */
    public function updateDeckAction()
    {

        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $idDeck = $this->getParams('idDeck');


        $cartes = $this->getModel()->listCardOfDeckById($idDeck);
        $idChoixHero = $cartes[0]->getTeam();

        $cartesDeck = $this->getModel()->listCarteTeam($idChoixHero);
        //var_dump($cartesDeck);
        foreach ($cartes as $key => $value) {
            //echo "<pre>";
            //var_dump($value);
            //echo "</pre>";
            foreach ($cartesDeck as $keyDeck => $valueDeck) {
                //echo "<pre>";
                //echo($idCartesDeck = $valueDeck->getId());
                //echo($idCartesDeck = substr($idCartesDeck,))
                //echo "</pre>";

                if ( $valueDeck->getSrc() === $value->getSrc())
                {
                    $notDeck [] = $valueDeck;
                }
            }
        }

        $cartes = array_merge($cartes, $cartesDeck);

        //var_dump($notDeck);

        if ( $idChoixHero == 1 ){$titre = " Team Manga";}
        elseif ( $idChoixHero == 2 ){$titre = " Team Cyber";}

        $retour = "create";
        $update = "update";
        $this->renderView('createListeCarte', array('cartes'=>$cartes, 'cartesDeck'=> $cartesDeck , 'notDeck'=>$notDeck , 'titre' => $titre, "retour"=>$retour, "choix_hero"=>$idDeck ,'update'=>$update));

    }


}




















