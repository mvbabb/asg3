<?php
class Order extends DomainObject{
	public $OrderID;
	public $ShipperID;
	public $CustomerID;
	public $DateStarted;
	public $Quantity;

    protected static function getFieldNames(){
        return array("OrderID", "ShipperID", "CustomerID", "DateStarted", "Quantity");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
