<?php
class StatusCode extends DomainObject{
    private $StatusID;
    private $Status;

    protected static function getFieldNames(){
        return array("StatusID", "Status");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
