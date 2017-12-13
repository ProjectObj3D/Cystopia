<?php


class lobbyModel extends coreModel
{

    public function countWaitingPlayers()
    {
        if($count = $this->MakeSelect('SELECT COUNT(*) as count FROM liste_attente'))
        {
            return $count;
        }
        return false;
    }


    public function addToWaitList()
    {
        $userId = intval($_SESSION['CY']['id']);
        // Si le joueur n'est pas sur la liste d'attente on l'ajoute
        if ($this->makeStatement('INSERT IGNORE INTO liste_attente(l_user, l_time) VALUES(:id, NOW())', [':id' => $userId])) {
            return true;
        }
        return false;
    }


    public function getLatestGameId()
    {
        if($lastID = $this->MakeSelect('SELECT p_id FROM partie ORDER BY p_id DESC LIMIT 1'))
        {
            return $lastID;
        }
        return false;
    }


    public function getCurrentGameId()
    {
        $userId = intval($_SESSION['CY']['id']);

        if($gameId = $this->MakeSelect('SELECT h_tmp_partie_fk as gameId FROM hero_tmp WHERE h_tmp_user_fk = :id ORDER BY h_tmp_id DESC LIMIT 1', [':id' => $userId]))
        {
            return $gameId;
        }
        return false;
    }


    public function removeFromWaiting($id)
    {
        if ($this->makeStatement('DELETE FROM liste_attente WHERE l_user = :id', [':id' => $id])) {
            return true;
        }
        return false;
    }


    public function updateGameTable()
    {
        $res = $this->getCurrentGameId();
        $gameId = intval($res[0]['gameId']);

        if ($this->makeStatement('INSERT IGNORE INTO partie(p_id, p_date) VALUES(:gameId, NOW())', [':gameId' => $gameId]))
        {
            return true;
        }
        return false;
    }

    public function initTempCards($deckId)
    {
        $sql =  'INSERT INTO carte_tmp(c_tmp_nom, c_tmp_attaque, c_tmp_defense, c_tmp_carte_model_fk, c_tmp_hero_tmp_fk)
                 SELECT c.c_nom c_tmp_nom, 
                        c.c_attaque c_tmp_attaque, 
                        c.c_defense c_tmp_defense, 
                        c.c_id c_tmp_carte_model_fk, 
                        h.h_tmp_id c_tmp_hero_tmp_fk 
                 FROM deck d 
                 INNER JOIN rel_deck_carte r ON d.d_id = r.d_id  
                 INNER JOIN carte_modele c ON r.c_id = c.c_id  
                 INNER JOIN hero_tmp h ON d.d_user_fk = h.h_tmp_user_fk 
                 WHERE d.d_id = :deckId';

        if ($this->makeStatement($sql, [':deckId' => $deckId]))
        {
            return true;
        }
        return false;
    }


    public function newGame()
    {
        $res = $this->getLatestGameId();
        $lastId = intval($res[0]['p_id']);
        $gameId = $lastId  + 1;
        $userId = intval($_SESSION['CY']['id']);
        $numTeam = intval($_SESSION['CY']['numTeam']);

        $sql = 'INSERT INTO hero_tmp (h_tmp_user_fk, h_tmp_partie_fk, h_tmp_team) VALUES (:userId, :gameId, :numTeam) ON DUPLICATE KEY UPDATE h_tmp_partie_fk = :gameId ';

        if ($this->makeStatement($sql, [':userId' => $userId, ':gameId' => $gameId, ':numTeam' => $numTeam]))
        {
                return true;
        }
        return false;
    }


    public function getUsersId()
    {
        $res = $this->getCurrentGameId();
        $gameId = intval($res[0]['gameId']);

        $sql1 = 'SELECT h_tmp_initiative ini, h_tmp_user_fk userid FROM hero_tmp WHERE h_tmp_partie_fk = :id';

        if($usersIds = $this->MakeSelect($sql1, [':id' => $gameId]))
        {
            return $usersIds;
        }
        return false;
    }


    public function giveInitiative()
    {
        $usersIds = $this->getUsersId();
        $randKey = array_rand($usersIds);
        $randId = intval($usersIds[$randKey]['userid']);

        if($usersIds[0]['ini'] != '1' && $usersIds[1]['ini'] != '1')
        {
            $sql = 'UPDATE hero_tmp SET h_tmp_initiative = 1 WHERE h_tmp_user_fk = :id';

            if ($this->makeStatement($sql, [':id' => $randId])) {
                return true;
            }
        }
        return false;
    }

    public function checkInit()
    {
        $userId = intval($_SESSION['CY']['id']);

        $sql = 'SELECT COUNT(*) num FROM carte_tmp INNER JOIN hero_tmp ON c_tmp_hero_tmp_fk = h_tmp_id WHERE h_tmp_user_fk = :id';

        if($usersIds = $this->MakeSelect($sql, [':id' => $userId]))
        {
            return $usersIds;
        }
        return false;
    }

}




















































