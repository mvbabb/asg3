<?php
include_once('DataAccess/classfiles/frame.class.php');
include_once('DataAccess/classfiles/glass.class.php');
include_once('DataAccess/classfiles/matt.class.php');
include_once('DataAccess/classfiles/gallery.class.php');
include_once('DataAccess/classfiles/artist.class.php');
include_once('DataAccess/classfiles/shapes.class.php');

include_once("instance.class.php");

class DropdownController extends Instance{
	public $frames;
	public $glass;
	public $matts;
	public $artists;
	public $museums;
	public $shapes;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function createListItem($class, $content){
		return utf8_encode("<li class='".$class."'>".$content."</li>");
	}
	public function createSelectList(){
		$list = '<select name="FrameID" id="frame" class="ui search dropdown">';
			foreach($this->frames as $item){
				$list .= $item;
			}

		$list .= '</select>';
		return $list;
	}
	public function createSelectListWithPlaceholder($id, $itemID, $class, $listItems, $searchString){
		$list = "<select name='".strtolower($itemID)."' id='".$id."' class='".$class."'>";
		$list .= "<option value=''>".$id."</option>";
	
		foreach($listItems as $item){
			$list .= $this->createOption($item->$itemID, $item->$searchString);
		}
		$list .= "</select>";
		return $list;
	}
	public function createArtistSelectList($id, $class, $listItems){
		$list = "<select name='artistid' id='".$id."' class='".$class."'>";
		$list .= "<option value=''>".$id."</option>";
		foreach($listItems as $item){
			$list .= $this->createOptionWithName($item->ArtistID,$item->FirstName, $item->LastName);
		}
		$list .= "</select>";
		return $list;
	}
	public function createOptionWithName($id, $first, $last){
		$option =  "<option value='".$id."'>".$first. " " . $last. "</option>";
		return $option;
	}
	public function createOption($id, $text){
		$option =  "<option value='".$id."'>".$text."</option>";
		if(!strcmp($text, "[None]")){
			$option = "<option selected='true'>None</option>";
		}
		return $option;
	}
    
   // value="{'num_sequence':[0,1,2,3]}"
        
    public function createOptionWithPrice($id, $text, $price){
		$option =  "<option value='".$id."' price='".$price."'>".$text."</option>";
		if(!strcmp($text, "[None]")){
			$option = "<option selected='true'>None</option>";
		}
		return $option;
	}
	

	//-------------
	//-DROPDOWN----
	//-------------
	public function framesDropdown($id){
		$sql = "SELECT FrameID, Title, Price FROM TypesFrames ORDER BY Title";
		
		$frames = $this->dbAdapter->fetchAsArray($sql);
		$list = '<select name="'. $id .'frameid" id="frame" class="ui search dropdown">';
		foreach($frames as $data){
			$list .= $this->createOptionWithPrice($data[0],$data[1],$data[2]);
		}
		$list .= '</select>';
		return utf8_encode($list);
		}
	public function glassDropdown($id){
		$sql = "SELECT GlassID, Title, Price FROM TypesGlass ORDER BY Title";
		
		$statement = $this->dbAdapter->fetchAsArray($sql);
		$list = '<select name="'. $id .'glassid" id="glass" class="ui search dropdown">';
		foreach($statement as $data){
			$list .= $this->createOptionWithPrice($data[0],$data[1],$data[2]);
		}
		$list .= '</select>';
		return utf8_encode($list);
		}	
	public function mattDropdown($id){
		$sql = "SELECT MattID, Title FROM TypesMatt ORDER BY Title";
		
		$statement = $this->dbAdapter->fetchAsArray($sql);
		$list = '<select name="'. $id .'mattid" id="matt" class="ui search dropdown">';
		foreach($statement as $data){
			$list .= $this->createOption($data[0],$data[1]);
		}
		$list .= '</select>';
		return utf8_encode($list);
		}

	public function artistDropdown(){
		$sql = "SELECT ArtistID, FirstName, LastName FROM Artists ORDER BY LastName";
		
		$statement = $this->dbAdapter->fetchAsArray($sql);
		$list = '<select name="artistid" id="artist" class="ui fluid search dropdown">';
		$list .= "<option value=''>Artist</option>";
		
		foreach($statement as $data){
			$list .= $this->createOptionWithName($data[0], $data[1], $data[2]);
		}
		$list .= '</select>';
		return utf8_encode($list);
		}
	public function museumDropdown(){
		$sql = "SELECT GalleryID, GalleryName FROM Galleries ORDER BY GalleryName";
		
		$statement = $this->dbAdapter->fetchAsArray($sql);
		$list = '<select name="galleryid" id="gallery" class="ui fluid search dropdown">';
		$list .= "<option value=''>Museum</option>";
		
		foreach($statement as $data){
			$list .= $this->createOption($data[0], $data[1]);
		}
		$list .= '</select>';
		return utf8_encode($list);
		}
	public function shapeDropdown(){
		$sql = "SELECT ShapeID, ShapeName FROM Shapes ORDER BY ShapeName";
		
		$statement = $this->dbAdapter->fetchAsArray($sql);
		$list = '<select name="shapeid" id="shape" class="ui fluid search dropdown">';
		$list .= "<option value=''>Shape</option>";
		
		foreach($statement as $data){
			$list .= $this->createOption($data[0],$data[1]);
		}
		$list .= '</select>';
		return utf8_encode($list);
	}
	public function createFrameDropdownSelectList(){
		return utf8_encode($this->createSelectList("frame", "FrameID", "ui search dropdown", $this->frames, "Title"));
	}
	public function createGlassDropdownSelectList(){
		return utf8_encode($this->createSelectList("glass", "GlassID", "ui search dropdown", $this->glass, "Title"));
	}
	public function createMattDropdownSelectList(){
		return utf8_encode($this->createSelectList("matt", "MattID", "ui search dropdown", $this->matts, "Title"));
	}
	public function createArtistDropdownSelectList(){
		return utf8_encode($this->createArtistSelectList("Artist", "ui fluid search dropdown", $this->artists));
	}
	public function createMuseumDropdownSelectList(){
		return utf8_encode($this->createSelectListWithPlaceHolder("Museum", "GalleryID", "ui fluid search dropdown", $this->museums, "GalleryName"));
	}
	public function createShapeDropdownSelectList(){
		return utf8_encode($this->createSelectListWithPlaceHolder("Shape", "ShapeID", "ui fluid search dropdown", $this->shapes, "ShapeName"));
	}
	
}

?>