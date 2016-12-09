<?php
class Shape extends DomainObject{
	public $ShapeID;
	public $ShapeName;

    protected static function getFieldNames(){
        return array("ShapeID", "ShapeName");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
