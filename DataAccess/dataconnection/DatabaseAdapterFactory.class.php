<?php
include_once('DatabaseAdapterPDO.class.php');
class DatabaseAdapterFactory{
	
    public static function create($type, $connectionValues){
        $adapter = "DatabaseAdapter".$type;
        if(class_exists($adapter)){
            return new $adapter($connectionValues);
        }
        else{
            throw new Exception("Data type does not exist");
        }
    }
}



?>