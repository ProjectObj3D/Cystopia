<?php

class plateauModel extends coreModel
{


    //    @params = $id du joueur ou de l'adversaire'
    //    retourne = héros tmp (id, pv, mana encore dispo, initiative, id partie, tour partie)
    public function getHeroTmpInfo($id)
    {
        $sql = 'SELECT h.* FROM hero_tmp h WHERE h_tmp_user_fk = :id';

        if($heroInfo = $this->MakeSelect($sql, [':id' => $id]))
        {
            return $heroInfo;
        }
        return false;
    }



    public function getOpponentId($gameId, $idJoueur)
    {
        $sql = 'SELECT h_tmp_user_fk FROM hero_tmp WHERE h_tmp_partie_fk = :gameId AND h_tmp_user_fk != :idJoueur';

        if($heroInfo = $this->MakeSelect($sql, [':gameId' => $gameId,':idJoueur' => $idJoueur]))
        {
            return $heroInfo;
        }
        return false;
    }

    public function toggleInitiative()
    {


        $usersIdsModel = new lobbyModel();
        $usersIds = $usersIdsModel->getUsersId();
        $userId = intval($_SESSION['CY']['id']);

       if ( $userId == intval($usersIds[0]['userid']))
       {
           $userAdv = intval($usersIds[1]['userid']);
           $ini = intval($usersIds[0]['ini']);
       }
       else{
           $userAdv = intval($usersIds[0]['userid']);
           $ini = intval($usersIds[1]['ini']);
       }



        if($ini == 1 )
        {
             $sql = 'UPDATE hero_tmp SET h_tmp_initiative = 0 , h_tmp_tour = h_tmp_tour+1 WHERE h_tmp_user_fk = :id ;
                     UPDATE hero_tmp SET h_tmp_mana = (CASE WHEN h_tmp_tour > 10 THEN 10 ELSE h_tmp_tour END) WHERE h_tmp_user_fk = :id;
                     UPDATE hero_tmp SET h_tmp_initiative = 1 WHERE h_tmp_user_fk = :id2;
                     UPDATE carte_tmp SET c_tmp_action=0 WHERE c_tmp_hero_tmp_fk=(SELECT h_tmp_id FROM hero_tmp WHERE h_tmp_user_fk=:id) OR c_tmp_hero_tmp_fk=(SELECT h_tmp_id FROM hero_tmp WHERE h_tmp_user_fk=:id2);
                     ';

            if ($this->makeStatement($sql, [':id' => $userId, ':id2' => $userAdv])) {
                return true;
            }
        }

        return false;
    }

    public function getCardsPlayer() {
        $idJoueur = intval($_SESSION['CY']['id']);

        $dataHeroJoueur = $this->getHeroTmpInfo($idJoueur);

        $idPartie = intval($dataHeroJoueur[0]['h_tmp_partie_fk']);

        $res = $this->getOpponentId($idPartie, $idJoueur);

        $idAdversaire = intval($res[0]['h_tmp_user_fk']);

        $dataHeroAdversaire = $this->getHeroTmpInfo($idAdversaire);

        $herosData['joueur'] = $dataHeroJoueur[0];
        $herosData['adversaire'] = $dataHeroAdversaire[0];
        // $dataCards = $this->makeSelect('SELECT * FROM carte_tmp');
        $dataCards = $this->makeSelect('SELECT * FROM carte_tmp 
                                            INNER JOIN carte_modele ON c_tmp_carte_model_fk=c_id 
                                            WHERE c_tmp_hero_tmp_fk=:joueur OR c_tmp_hero_tmp_fk=:adversaire', array('joueur'=>$herosData['joueur']['h_tmp_id'], 'adversaire'=>$herosData['adversaire']['h_tmp_id']));
        $dataCards[] = $herosData['adversaire'];
        $dataCards[] = $herosData['joueur'];
        return $dataCards;
    }


    public function updateRandomCard($limit)
    {
        $idJoueur = intval($_SESSION['CY']['id']);
        $res = $this->getHeroTmpInfo($idJoueur);
        $idHero = $res[0]['h_tmp_id'];
        $lim = intval($limit);

        $sql = 'UPDATE carte_tmp SET c_tmp_position = 1 WHERE c_tmp_position = 0 AND c_tmp_hero_tmp_fk = :idHero ORDER BY RAND() LIMIT :lim';

        if ($this->makeStatement($sql, [':idHero' => $idHero, ':lim' => (int)$lim], PDO::PARAM_INT))
        {
            return true;
        }
        return false;
    }


    public function displaceCard($id)
    {
        $sql = 'UPDATE carte_tmp, hero_tmp 
                SET c_tmp_position = 2, 
                c_tmp_tour = h_tmp_tour,
                h_tmp_mana = h_tmp_mana - (SELECT c_mana FROM `carte_modele` WHERE carte_modele.c_id = carte_tmp.c_tmp_carte_model_fk)
                WHERE c_tmp_id = :id AND h_tmp_id = c_tmp_hero_tmp_fk';

        if ($this->makeStatement($sql, [':id' => $id], PDO::PARAM_INT))
        {
            return true;
        }
        return false;
    }


    public function compareMana($cardId)
    {
        $sql = 'SELECT * FROM carte_tmp 
                 INNER JOIN hero_tmp ON c_tmp_hero_tmp_fk = h_tmp_id 
                 INNER JOIN carte_modele ON c_tmp_carte_model_fk = carte_modele.c_id 
                 WHERE c_tmp_id = :cardId';

        if ($res = $this->makeSelect($sql, [':cardId' => $cardId]))
        {
            return $res;
        }
        return false;

    }

    public function checkInitiative() {
        $usersIdsModel = new lobbyModel();
        $usersIds = $usersIdsModel->getUsersId();
        $userId = intval($_SESSION['CY']['id']);

        $data = $this->makeSelect('SELECT h_tmp_initiative FROM hero_tmp WHERE h_tmp_user_fk=:userid', array(':userid'=>$userId));
        if(count($data)) {
            return $data[0]['h_tmp_initiative'];
        }
        return false;
    }

    public function checkCardAction($cardid) {
        $res = $this->makeSelect('SELECT c_tmp_action FROM carte_tmp WHERE c_tmp_id=:cardid LIMIT 1', array(':cardid'=>$cardid));
        if($res !== false) {
            return $res[0]['c_tmp_action'];
        }
        return false;
    }

    public function getCardTurn($attackId)
    {
        $sql = 'SELECT c_tmp_tour FROM carte_tmp WHERE c_tmp_id = :attackId';

        if($res = $this->makeSelect($sql, [':attackId' => $attackId]))
        {
            return $res;
        }
        return false;
    }


    public function attackCard($attackId, $targetId)
    {
        //If target (c_tmp_defense - c_tmp_attaque) <= 0 -> set position to 3;
        //if attack n'a pas déjà attaqué dans ce tour;

        $checkSort = $this->checkCardSort($attackId);
        if($checkSort != 1) {

            $sql = 'UPDATE  carte_tmp a
                    CROSS JOIN carte_tmp b
                    SET     a.c_tmp_defense = (a.c_tmp_defense - b.c_tmp_attaque), b.c_tmp_defense = (b.c_tmp_defense - a.c_tmp_attaque), b.c_tmp_action=1
                    WHERE   a.c_tmp_id = :targetId 
                    AND		b.c_tmp_id = :attackId';

        }
        else {
            $sql = 'UPDATE carte_tmp a 
                    CROSS JOIN carte_tmp b 
                    SET a.c_tmp_defense = (a.c_tmp_defense - b.c_tmp_attaque), b.c_tmp_position=3 
                    WHERE   a.c_tmp_id = :targetId 
                    AND     b.c_tmp_id = :attackId';
        }
        $res = $this->makeStatement($sql, [':targetId' => $targetId, ':attackId' => $attackId]);

        // On vire les carte morte
        $this->makeStatement('UPDATE carte_tmp SET c_tmp_position=3 WHERE c_tmp_defense<=0');
        return $res;
    }

    public function attackHero($heroid, $cardid) {
         $checkSort = $this->checkCardSort($cardid);
         if($checkSort != 1) {
             $sql = 'UPDATE hero_tmp h 
                     CROSS JOIN carte_tmp c 
                     SET h.h_tmp_pv = (h.h_tmp_pv-c.c_tmp_attaque), c.c_tmp_action=1
                     WHERE h.h_tmp_id = :heroid
                     AND c.c_tmp_id = :cardid
             ';
         }
         else {
             $sql = 'UPDATE hero_tmp h 
                     CROSS JOIN carte_tmp c 
                     SET h.h_tmp_pv = (h.h_tmp_pv-c.c_tmp_attaque), c.c_tmp_position=3
                     WHERE h.h_tmp_id = :heroid
                     AND c.c_tmp_id = :cardid
             ';
         }
         $res = $this->makeStatement($sql, array(":heroid"=>$heroid, ":cardid"=>$cardid));
         return $res;
    }

    public function checkCardSort($cardid) {
        $res = $this->makeSelect('SELECT (CASE WHEN c_tmp_defense IS NULL THEN 1 ELSE 0 END) AS result FROM carte_tmp WHERE c_tmp_id=:cardid', array(':cardid'=>$cardid));
        if($res !== false) {
            return $res[0]['result'];
        }
        return false;
    }

    public function checkBouclier($heroid) { // Check si le hero a un bouclier sur le plateau 
        $res = $this->makeSelect('SELECT COUNT(c_tmp_id) AS result FROM carte_tmp WHERE (SELECT c_type FROM carte_modele WHERE c_id=c_tmp_carte_model_fk) = 3 AND c_tmp_hero_tmp_fk=:heroid AND c_tmp_position=2', array(':heroid'=>$heroid));
        if($res !== false) {
            return $res[0]['result'];
        }
        return false;
    }

    public function getTypeCard($cardid) {
        $res = $this->makeSelect('SELECT m.c_type FROM carte_tmp t INNER JOIN carte_modele m ON m.c_id=t.c_tmp_carte_model_fk WHERE t.c_tmp_id=:cardid', array(':cardid'=>$cardid));
        if($res !== false) {
            return $res[0]['c_type'];
        }
        return false;
    }

    public function getHeroByCardId($cardid) {
        $res = $this->makeSelect('SELECT c_tmp_hero_tmp_fk FROM carte_tmp WHERE c_tmp_id=:cardid', array(':cardid'=>$cardid));
        if($res !== false) {
            return $res[0]['c_tmp_hero_tmp_fk'];
        }
        return false;
    }






}