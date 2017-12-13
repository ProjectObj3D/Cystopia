<?php

class plateauController extends coreController
{

    public function displayAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php?control=login&action=display');
        }
        include 'views' . DIRECTORY_SEPARATOR . 'plateau' . DIRECTORY_SEPARATOR . 'plateau.php';
    }

    public function fintourAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php?control=login&action=display');
        }
        // echo json_encode(value)
        $idJoueur = intval($_SESSION['CY']['id']);
        $dataHeroJoueur = $this->getModel()->getHeroTmpInfo($idJoueur);
        $data="";
        if ( $dataHeroJoueur[0]['h_tmp_initiative'] == "1"){

                $data= array ("initiative" => 1);
                $this->getModel()->toggleInitiative();
                $this->getModel()->updateRandomCard(1);
        }
        else{
            $data = array ("initiative" => 0);
        }
        //var_dump($dataHeroJoueur);
        echo json_encode($data);
    }


    public function getHerosDataAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $idJoueur = intval($_SESSION['CY']['id']);

        $dataHeroJoueur = $this->getModel()->getHeroTmpInfo($idJoueur);

        $idPartie = intval($dataHeroJoueur[0]['h_tmp_partie_fk']);

        $res = $this->getModel()->getOpponentId($idPartie, $idJoueur);

        $idAdversaire = intval($res[0]['h_tmp_user_fk']);

        $dataHeroAdversaire = $this->getModel()->getHeroTmpInfo($idAdversaire);

        $herosData['joueur'] = $dataHeroJoueur[0];
        $herosData['adversaire'] = $dataHeroAdversaire[0];

        header('content-type: application/json');
        echo json_encode($herosData);
    }



    public function updateCardsPosAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $limit = $this->getParams('limit');

        $this->getModel()->updateRandomCard($limit);
    }



    public function getCardsAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $dataCards = $this->getModel()->getCardsPlayer();
        header('content-type: application/json');
        echo json_encode($dataCards);
    }

    public function displaceCardAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $cardId = $this->getParams('cardId');
        $id = intval(substr($cardId, 8));
        $this->getModel()->displaceCard($id);
    }


    public function checkAllowPlateauAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $cardId = intval(substr($this->getData('cardId'), 8));

        $res = $this->getModel()->compareMana($cardId);
        $checkSort = $this->getModel()->checkCardSort($cardId);

        if($res[0]['c_mana'] <= $res[0]['h_tmp_mana'] && $checkSort == 0)
        {
            echo 'true';
        }
        else echo 'false';
    }

    public function checkInitiativeAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        echo $this->getModel()->checkInitiative();
    }

    public function checkBouclierAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $heroid =  intval($this->getData('heroid'));
        $targetid = intval(substr($this->getData('targetid'),8));
        $type=intval($this->getModel()->getTypeCard($targetid));
        
        $res = intval($this->getModel()->checkBouclier($heroid));

        if(($res > 0 && $type == 3) || ($res == 0)) echo 'true';
        else echo 'false';
    }

    public function playerHasBouclierAction() {
         $heroid =  intval($this->getData('heroid'));
         $res = intval($this->getModel()->checkBouclier($heroid));
         if($res > 0) echo 'true';
         else echo 'false';

    }

    public function attackCardAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $idJoueur = intval($_SESSION['CY']['id']);
        $attackId = intval(substr($this->getData('attackId'),8));
        $targetId = intval(substr($this->getData('targetId'),8));

        $action = $this->getModel()->checkCardAction($attackId);
        $checkSort = $this->getModel()->checkCardSort($attackId);
        $res1 = $this->getModel()->getCardTurn($attackId);
        $res2 = $this->getModel()->getHeroTmpInfo($idJoueur);

        $tourCarte = $res1[0]['c_tmp_tour'];
        $tourHero = $res2[0]['h_tmp_tour'];


        if(( (($tourHero > $tourCarte) && $tourCarte != 0) || $checkSort == 1) && $action == 0)
        {
            $res = $this->getModel()->attackCard($attackId, $targetId);
            echo json_encode('true');
        }
        else echo json_encode('false');
    }

     public function attackHeroAction() {
        $idJoueur = intval($_SESSION['CY']['id']);
        $heroid =  intval($this->getData('heroid'));
        $attackId = intval(substr($this->getData('attackId'),8));
        
        $action = $this->getModel()->checkCardAction($attackId);
        $checkSort = $this->getModel()->checkCardSort($attackId);
        $res1 = $this->getModel()->getCardTurn($attackId);
        $res2 = $this->getModel()->getHeroTmpInfo($idJoueur);
        
        $tourCarte = $res1[0]['c_tmp_tour'];
        $tourHero = $res2[0]['h_tmp_tour'];

        if(((($tourHero > $tourCarte) && $tourCarte != 0) || $checkSort == 1) && $action == 0) {
            $this->getModel()->attackHero($heroid, $attackId);
            echo 'true';
        }
        else echo 'false';
    }

    public function updateTourAction()
    {
        if(!isset($_SESSION['CY']))
        {
            header('location:index.php');
        }

        $tour = $this->getParams('tour');

        echo 'tour : ' . $tour;
    }




}










