<?php
include('DataAccess/classfiles/gallery.class.php');
include("instance.class.php");
class GalleriesController extends Instance{
	private $gateway;
	private $galleries;
	public function __construct(){
		parent::__construct();
		$this->gateway = new GalleriesTableGateway($this->dbAdapter);
	}
	
	public function setBrowseGalleryData(){
		$sql = $this->gateway->getSelectStatement();
		$statement = $this->dbAdapter->fetchAsArray($sql, "GalleryName");
		foreach($statement as $data){
			$gallery = new Gallery($data);
			$this->galleries[] = $gallery;
		}
	}
	
	public function createBrowseGalleryColumnSegment(){

		usort($this->galleries, array($this, "cmp"));
		$output = "";
		foreach ($this->galleries as $gallery){
			$output .= '<div class="ui column">';
			$output .= $gallery->getGallerySegment($gallery);
			$output .= '</div>';		
		}

		return utf8_encode($output);
	}
	
	
	
	private function cmp($a, $b){
		return strcmp($a->GalleryName, $b->GalleryName);
	}
	
}


?>