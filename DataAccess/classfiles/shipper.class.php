<?php
class Shipper extends DomainObject{
	public $shipperID;
	public $shipperName;
	public $shipperDescription;
	public $shipperAvgTime;
    public $shipperClass;
    public $shipperBaseFee;
    public $shipperWeightFee;

    protected static function getFieldNames(){
        return array("shipperID", "shipperName", "shipperDescription", "shipperAvgTime", "shipperClass", "shipperBaseFee", "shipperWeightFee");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
