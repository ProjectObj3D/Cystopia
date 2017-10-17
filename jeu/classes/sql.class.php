<?php
require 'config.php';

class SQL {
 

    private static $_pdo=null;
    private static $_instance = null;


    private function __construct() {  

        try{
            self::$_pdo = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_NAME.';charset=utf8', MYSQL_USER, MYSQL_PASS, 
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        } 

        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }


    public static function getInst() {

        if(is_null(self::$_instance)) {
            self::$_instance = new self();  
        }
        return self::$_instance;
    }


    public function makeStatement($sql, $params=array()) {
        if(count($params) == 0) {
            try {
                $sth = self::$_pdo->query($sql);
                return $sth;
            }
            catch(Exception $e) {
                return false;
            }
        }
        else {
            if(($sth = self::$_pdo->prepare($sql)) !== false) {
                foreach ($params as $key => $value) {
                    $sth->bindValue($key, $value);
                }
                try {
                    $sth->execute();
                    return $sth;
                }
                catch(Exception $e) {
                    return false;
                }       
            }
        }
        return false;
    }
    

    public function makeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC, $fetchArg = NULL) {

        $query = self::makeStatement($sql, $params);

        if($query === false) return false;

        $data = !is_null($fetchArg) ? $query->fetchAll($fetchStyle, $fetchArg) : $query->fetchAll($fetchStyle);
        $query->closeCursor();

        return $data;
    }

    public function makeInsert($sql, $params = array()){

        $statement = $this->MakeStatement($sql, $params);
        if($statement === false)
        {
            return false;
        }
        $statement->closeCursor();

        return true;
    }

}
 
?>