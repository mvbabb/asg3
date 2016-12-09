<?php
class Glass extends DomainObject{
	public $GlassID;
	public $Title;
	public $Description;
	public $Price;

    protected static function getFieldNames(){
        return array("GlassID", "Title", "Description", "Price");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
    
?>
