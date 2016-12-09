<?php

class Customer extends DomainObject{
    private $CustomerID;
    private $FirstName;
    private $LastName;
    private $Address;
    private $City;
    private $Region;
    private $Country;
    private $Postal;
    private $Phone;
    private $Email;
    private $Privacy;

    protected static function getFieldNames(){
        return array("CustomerID", "FirstName", "Address", "City", "Region", "Country", "Postal", "Phone", "Email", "Privacy");
    }
    public function __construct($data){
        parent::__construct($data);
    }
    public function getFullName($commaDelimited=bool){
        if($commaDelimited){
            return $this->lastName . ", " . $this->firstName;
        }
        else{
            return $this->firstName . " " . $this->lastName;
        }
    }


}



?>