<?php
class Visit extends DomainObject{
    private $VisitID;
    private $PaintingID;
    private $DateViewed;
    private $IpAddress;
    private $CountryCode;

    protected static function getFieldNames(){
        return array("VisitID", "PaintingID", "DateViewed", "IpAddress", "CountryCode");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
