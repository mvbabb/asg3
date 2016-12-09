<?php
class Frame extends DomainObject{
	public $FrameID;
	public $Title;
	public $Price;
	public $Color;
	public $Syle;

    protected static function getFieldNames(){
        return array("FrameID", "Title", "Price", "Color", "Syle");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
