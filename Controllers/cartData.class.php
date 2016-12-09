<?php
include_once ("instance.class.php");
class CartData extends Instance {
	private $gateway;
	public $paintings;
	public function __construct() {
		parent::__construct ();
		$this->paintings = array ();
		$this->gateway = new PaintingsTableGateway ( $this->dbAdapter );
	}

}
class CartItem {
	public $painting;
	public $quantity;
	public $frame;
	public $glass;
	public $matt;
	public function __construct($painting, $quantity, $frame, $glass, $matt) {
		$this->painting = $painting;
		$this->quantity = $quantity;
		$this->frame = $frame;
		$this->glass = $glass;
		$this->matt = $matt;
	}
	public function createCartItem() {
		
	}
}

?>