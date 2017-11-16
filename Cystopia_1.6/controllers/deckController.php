<?php



class deckController extends coreController
{


    private function renderView($viewName, array $viewData = array())
    {
        //On importe le contenu du tableau dans des variables locales
        extract($viewData, EXTR_SKIP);

        //On rend la vue dans une variable et pas directement sur l'écran utilisateur
        ob_start();

        include('views'.DIRECTORY_SEPARATOR.'deck'.DIRECTORY_SEPARATOR. $viewName . '.php');

        $view = ob_get_contents();

        ob_end_clean();

        //Le layout utilisera $view
        include('views'.DIRECTORY_SEPARATOR.'deck'.DIRECTORY_SEPARATOR.'layoutDeck.php');
    }


	public function displayDeckAction()
    {

		$id = $_SESSION['CY']['id'];
		// On peut créer un objet user au lieu d'appeler directement l'id.

 		$tabdecks = $this->getModel()->listDeck($id);


 		$message = "";
 		if ($tabdecks != false && $tabdecks > 0)
 		{
 			// on affiche les decks du tableau 
 			$message = " on a plusieurs decks ";
 			// var_dump($tabdecks);
            $titre = " Mes Decks";
            $this->renderView('deck', array('id'=>$id,'tabdecks' => $tabdecks, "titre" => $titre));
 		}
 		else
        {
 			//pas de decks en bdd on affiche juste creation deck 
 			//$message = " Crée ton Deck  ";
            $this->createAction();
 		}

		//include 'views'.DIRECTORY_SEPARATOR.'deck'.DIRECTORY_SEPARATOR.'deck.php';
        
	 }

    public function createAction()
    {

        $heros = $this->getModel()->getHeroList();


        //include 'views'.DIRECTORY_SEPARATOR.'deck'.DIRECTORY_SEPARATOR.'create.php';
        $this->renderView('create', array('heros'=>$heros,"titre" => "Choix Du Héros : "));
    }


    public function createTeamAction()
    {

	    // test pour renvoyer la liste choisi en checkbox
	     if(isset($_SESSION['choix_hero']))
        {
            $idChoixHero = intval($_SESSION['choix_hero']);
        }

        if (isset( $_SESSION['choix_cartes_team']) )
        {
            foreach ( $_SESSION['choix_cartes_team'] as $key => $value)
            {
                $cartes[] = $this->getModel()->getCarte($value);
            }
        }
        // fin test
        else
        {
            $cartes = $this->getModel()->listCarteTeam($idChoixHero);
        }

        if ( $idChoixHero == 1 ){$titre = " Team Manga";}
        elseif ( $idChoixHero == 2 ){$titre = " Team Cyber";}


        //include 'views'.DIRECTORY_SEPARATOR.'deck'.DIRECTORY_SEPARATOR.'createListeCarte.php';
        $this->renderView('createListeCarte', array('cartes'=>$cartes,'titre' => $titre));

    }

    public function addDeckAction()
    {
        $deck = $this->getModel()->addDeck(array('hero'=>$_SESSION['choix_hero'],'userFk'=>$_SESSION['CY']['id']));

        if (isset ( $_SESSION['choix_cartes_team']))
        {
            foreach ( $_SESSION['choix_cartes_team'] as $val => $key)
            {
                $deckCarte = $this->getModel()->addRelDeck(array('deckId'=> $_SESSION['last_deck_creater'], 'carteID'=>intval($key)));
            }
        }
       // $deckCarte = $this->getModel()->addRelDeck(array('deckId'  carteID));

        header('location:?control=deck&action=displayDeck');
        exit;
    }



  
    public function displayCardOfDeckByIdAction()
    { //listCardOfDeckById

        $idDeck = intval($_SESSION['idDeckDisplay']);
        $tabdecks = $this->getModel()->listCardOfDeckById($idDeck);

        $message = "";
        $titre = " Deck : ";
        if ( isset($_SESSION['deckNom']))
        {
            $titre .= $_SESSION['deckNom'];
        }

        if ( isset($_SESSION['deckHero']) )
        {
            if ($_SESSION['deckHero'] == 1)
            {
                $titre .= " - Team Manga ";
            }
            elseif ($_SESSION['deckHero'] == 2)
            {
                $titre .= " - Team Cyber ";
            }
        }
        if ($tabdecks != false && $tabdecks > 0)
        {
            // on affiche les decks du tableau 
            $message = " on a plusieurs cartes ";
            // var_dump($tabdecks);
            $this->renderView('carteDeck', array('tabdecks' => $tabdecks,"titre" => $titre));
        }
        else
        {
            //pas de decks en bdd on affiche juste creation deck 
            //$message = " Crée ton Deck  ";
            //$this->createAction();

            $this->renderView('carteDeck', array('cartes' => "Pas de Cartes dans ce Deck", "titre" => $titre));
        }

        //include 'views'.DIRECTORY_SEPARATOR.'deck'.DIRECTORY_SEPARATOR.'deck.php';
        
     }


}




















