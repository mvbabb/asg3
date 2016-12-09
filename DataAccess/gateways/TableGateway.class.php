<?php
abstract class TableDataGateway{
    protected $dbAdapter;
    public function __construct($dbAdapter){
        if(is_null($dbAdapter)){
            throw new Exception("Database adapter is null");
        }
        $this->dbAdapter = $dbAdapter;
    }
    abstract protected function getSelectStatement();
    abstract protected function getPrimaryKeyName();
    //Returns all records in table
    public function findAll(){
        $sql = $this->getSelectStatement();
        $result = $this->dbAdapter->fetchAsArray($sql);
        return $result;
    }
    public function findById($id){
        $sql = $this->getSelectStatement();
        $sql .= " WHERE " . $this->getPrimaryKeyName() . "= ?";
        $result =$this->dbAdapter->fetchRow($sql, array($id));
        return $result;
    }
    public function findByField($parameters=array()){
        //parameter is key value pair where key is field value is value to compare
        if(!is_array($parameters)){
            $parameters = array($parameters);
        }
        $sql = $this->getSelectStatement();
        $count = 0;
        if(!empty($parameters)){
        	foreach($parameters as $key=>$value){
        		if($count == 0){
        			$sql .= " WHERE " . $key ." = ".$value;
        		}
        		else{
        			$sql .= " && " . $key . " = ".$value;
        		}
        	}
        }

        $result = $this->dbAdapter->fetchAsArray($sql);
    }
    protected function closeConnection(){
        $dbAdapter->closeConnection();
        $dbadapter = null;
    }
    protected function createObject($data=array()){
        if(is_array($data)){
            $data = array($data);
        }
        $values = array();
        $class = getCassName();
        foreach($data as $value){
        	$values[] = new $class($value);
        }
        return $values;
    }
}
?>