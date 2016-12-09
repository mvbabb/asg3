<?php
class DBHelper{    
    public static function CreateConnection($values=array()){
        try{
            $pdo = new PDO($values[0], $values[1], $values[2]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch(PDOException $e){
            die( $e->getmessage() );
        }
    }

    public static function runQuery($pdo, $sql, $parameters=array()){
        if(!is_array($parameters)){
            $parameters = array($parameters);
        }
        try{
            $statement = null;
            if(count($parameters > 0)){
                $statement = $pdo->prepare($sql);
                $statement->execute($parameters);
            }
            else{
                $statement = $pdo->query($sql);
            }
            return $statement;
        }
        catch(PDOException $e){
            throw $e;
        }
    }









}

?>
