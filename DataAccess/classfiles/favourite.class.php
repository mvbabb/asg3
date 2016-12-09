<?php
include("DataAccess/classfiles/domainObject.class.php");
class favorite extends DomainObject{
	private $image;
	private $name;
	private $id;
	private $destination;
	
	public function __construct($id, $imagePath, $name, $destination){
		$this->id = $id;
		$this->name = $name;
		$this->image = $imagePath;
		$this->destination = $destination;
	}
		
	public function getFieldNames(){
		return array("image, name, id, destination");
	}
	
	public function createFavoriteCard(){
		$output = "<div class='ui card'>
		<div class='image'>
		<img src='".$this->image."'>
		</div>
		<div class='content'>
		<a class='text' href='".$this->destination."'>".$this->name."</a>
		</div>
		<div class='extra content'>
		<button id='".$this->id."' class='ui right floated mini button'>
		<i class='trash icon'></i>remove
		</button>
		</div></div>";
		
		return $output;
	}
	
	
}



?>