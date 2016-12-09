<?php
class Matt extends DomainObject{
	public $MattID;
	public $Title;
	public $ColorCode;

    protected static function getFieldNames(){
        return array("MattID", "Title", "ColorCode");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
