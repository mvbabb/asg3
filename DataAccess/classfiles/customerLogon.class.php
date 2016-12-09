<?php
class CustomerLogon extends DomainObject{
    private $CustomerID;
    private $UserName;
    private $Pass;
    private $Sale;
    private $State;
    private $DateJoined;
    private $DateLastModified;

   protected static function getFieldNames(){
       return array("CustomerID", "UserName", "Pass", "Salt", "State", "DateJoined",
           "DateLastModified");
   }
   public function __construct($data){
       parent::__construct($data);
   }
    public function setDateLastModified($value){
        //logic to update last modified
    }
}
?>