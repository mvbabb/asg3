<?php
include("Controllers/instance.class.php");


class cartLogic extends instance{
	private $gateway;
    
	public function __construct(){
		parent::__construct();
		$this->gateway = new PaintingsTableGateway($this->dbAdapter);
	}
	/*public function checkForUpdates(){
		$this->remove();
	}*/
    
	public function addToCart(){
		if(isset($_POST["addtocart"])){
            
            
			$data = $this->gateway->findById($_POST["addtocart"]);
			$painting = new Painting($data);
			$quantity=1;
			if(isset($_POST['quantity'])){$quantity = $_POST['quantity'];}
			$frame='18';
			if(isset($_POST['frameid']) && $_POST['frameid'] != 'None' ){$frame = $_POST['frameid'];}
            if($frame == 'None'){$frame = 18;}
			$glass='5';
			if(isset($_POST['glassid']) && $_POST['glassid'] != 'None' ){$glass = $_POST['glassid'];}
            if($glass == 'None'){$glass = 5;}
			$matt='35';
			if(isset($_POST['mattid']) && $_POST['mattid'] != 'None' ){$matt = $_POST['mattid'];}
            if($matt == 'None'){$mat = 35;}
			
			$order = array("id"=>$_POST['addtocart'], "quantity"=>$quantity, "frame"=>$frame, "glass"=>$glass, "matt"=>$matt);
			
            $stopAdd = 'no';
            $foundPainting = '';
            if(isset($_SESSION['Painting'])){
                for($n=0; $n < count($_SESSION['Painting']); $n++){
                    if($_POST['addtocart'] == $_SESSION['Painting'][$n]['id']){
                        $stopAdd = 'yes';
                        $foundPainting = $n;
                }
                }
    
    
}
            if($stopAdd == 'no'){
			     if(!empty($_SESSION['Painting'])){
				    array_push($_SESSION['Painting'], $order);
			}
			     else{
				    $_SESSION['Painting'] = array($order);
			     }
            }
            else{
                
                $_SESSION['Painting'][$foundPainting] = $order;
                echo '<script> alert("This painting was already in the cart, it has now been overwritten");</script>';
                
                
                
            }
	}


	}
	
	public function remove(){
		if(isset($_POST['remove'])){
			$id = isset($_POST['remove']);
			for($i = 0; $i < count($_SESSION['Painting']); $i++){
				if($_SESSION['Painting'][$i]['PaintingID'] == $id){
					$_SESSION['Painting'][$i] = null;
				}
			}
		}
	}
	
	public function getGlassByID($id){
		return $this->dbAdapter->fetchRow("SELECT Description, GlassID, Price, Title FROM TypesGlass WHERE GlassID=" .$id);
	}
	public function getMattByID($id){
		return $this->dbAdapter->fetchRow("SELECT ColorCode, MattID, Title FROM TypesMatt WHERE MattID=". $id);
	}
	public function getFrameByID($id){
		return $this->dbAdapter->fetchRow("SELECT Color, FrameID, Price, Syle, Title FROM TypesFrames WHERE FrameID=". $id);
	}
	// ADD CURRENT SELECTIONS TO THE CART DISPLAY
	// ADD CURRENT SELECTIONS TO THE CART DISPLAY
	function instantiateCartLogic() {
		if (! empty ( $_SESSION ['Painting'] )) {
			$painting = $_SESSION ['Painting'];
            //if (isset ( $_POST ['cartOptions'] ) && $_POST ['cartOptions'] == "Continue Shopping") {
			for($paintIndex = 0; $paintIndex < count ( $painting ); $paintIndex ++) {
			
				$singlePainting = $painting[$paintIndex]['id'];
				if (isset ( $_POST[$singlePainting . 'Quantity'] ) && !empty( $_POST [$singlePainting . 'Quantity'] )) {
					$_SESSION ['Painting'] [$paintIndex] ['quantity'] = $_POST [$singlePainting . 'Quantity'];
                    
				}
				
				if (isset ( $_POST[$singlePainting . 'frameid'] ) && !empty( $_POST [$singlePainting . 'frameid'] )) {
					if ($_POST [$singlePainting .'frameid'] == 'None') {
						$_SESSION ['Painting'] [$paintIndex] ['frame'] = 18;
                        
					} else {
						$_SESSION ['Painting'] [$paintIndex] ['frame'] = $_POST [$singlePainting .'frameid'];
					}
				}
				
				if (isset ( $_POST[$singlePainting . 'glassid'] ) && !empty( $_POST [$singlePainting . 'glassid'] )) {
					if ($_POST [$singlePainting .'glassid'] == 'None') {
						$_SESSION ['Painting'] [$paintIndex] ['glass'] = 5;
					} else {
						$_SESSION ['Painting'] [$paintIndex] ['glass'] = $_POST [$singlePainting .'glassid'];
					}
				}
				
				if (isset ( $_POST[$singlePainting . 'mattid'] ) && !empty( $_POST [$singlePainting . 'mattid'] )) {
					if ($_POST [$singlePainting .'mattid'] == 'None') {
						$_SESSION ['Painting'] [$paintIndex] ['matt'] = 35;
					} else {
						$_SESSION ['Painting'] [$paintIndex] ['matt'] = $_POST [$singlePainting .'mattid'];
					}
				}
          //  }
				
				if (isset ( $_POST [$singlePainting . 'remove'] ) && !empty($_POST [$singlePainting . 'remove'])) {
					for($i = 0; $i < count ( $painting ); $i ++) {
						if ($singlePainting == $_SESSION ['Painting'] [$i] ['id']) {
							break;
						}
					}
					unset ( $_SESSION ['Painting'] [$i] );
                   // unset($_SESSION['Painting'][count($painting)]);
                    $_SESSION ['Painting'] = array_values( $_SESSION ['Painting'] );
                    }
                    //$_SESSION['valueHolder']['standard'] == '';
					$_SESSION ['Painting'] = array_values( $_SESSION ['Painting'] );
                    
                    
            }
				
				
				if (isset ( $_POST ['cartOptions'] ) && $_POST ['cartOptions'] == "Empty Cart") {
					unset ( $_SESSION ['Painting'] );
                   // $_SESSION['valueHolder']['standard'] == '';
				}
				
			
		
        
        
        //CHECKS FOR SET SESSION VARIABLES
		if (! isset ( $_SESSION ['totalValues'] )) {
			
			$_SESSION ['totalValues'] = array (
					"standard" => '',
					"express" => '',
					"totalSubtotal" => '' 
			);
		};
		
		/*if (! isset ( $_SESSION ['valueHolder'] )) {
			
			$_SESSION ['valueHolder'] = array (
					"standard" => '',
					"express" => '',
					"totalSubtotal" => '' 
			);
		};
		
		if (! isset ( $_SESSION ['stopVariable'] )) {
			$_SESSION ['stopVariable'] = 0;
		}*/
	}
}
}
?>
