<?php


class lobbyController extends coreController
{

    public function displayAction()
    {
        $deckId = $this->getData('iddeck');

        $numTeam = $this->getData('numTeam');

        $_SESSION['CY']['deckId'] = $deckId;
        $_SESSION['CY']['numTeam'] = $numTeam;

        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        include 'views' . DIRECTORY_SEPARATOR . 'lobby' . DIRECTORY_SEPARATOR . 'lobby.php';
    }

//    Appelé en ajax sur lobby.js
    public function addToWaitListAction()
    {
        if($this->getModel()->addToWaitList() === false)
        {
            echo 'false';
        }
        echo 'ok';
    }

//    Appelé en ajax sur lobby.js
    public function checkWaitListAction()
    {
        $res = $this->getModel()->countWaitingPlayers();
        $count = $res[0]['count'];

        if($count == 2)
        {
//            Création des héros_tmp
            $this->getModel()->newGame();
        }
        echo $count;
    }

//    Appelé en ajax sur plateau.js
    public function initGameAction()
    {
        $pModel = new plateauModel();

//        Compter les cartes_tmp du joueur en session
        $res = $this->getModel()->checkInit();

        if($res[0]['num'] == 0)
        {
            $userId = intval($_SESSION['CY']['id']);
            $deckId = $_SESSION['CY']['deckId'];

//            Création de la partie (table partie)
            $this->getModel()->updateGameTable();

//            Attribution de l'initiative
            $this->getModel()->giveInitiative();

//            Initialisation des cartes_tmp
            $this->getModel()->initTempCards($deckId);

//            Retirer les joueurs de la liste d'attente
            $this->getModel()->removeFromWaiting($userId);

//            Mettre 3 cartes random en position 1 (main)
            $pModel->updateRandomCard(3);
        }
    }
}



