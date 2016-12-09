<?php
class OrderDetail extends DomainObject{
	public $OrderDetailID;
	public $OrderID;
	public $PaintingID;
	public $FrameID;
	public $GlassID;
	public $MattID;

    protected static function getFieldNames(){
        return array("OrderDetailID", "OrderID", "PaintingID", "FrameID", "GlassID", "MattID");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
