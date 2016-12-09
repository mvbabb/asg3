<?php
include_once('domainObject.class.php');

class Genre extends DomainObject{
    public $GenreID;
    public $GenreName;
    public $EraID;
    public $Description;
    public $Link;

    protected static function getFieldNames(){
        return array("GenreID", "GenreName", "EraID", "Description", "Link");
    }

    public function __construct($data){
        parent::__construct($data);
    }
    
    public function createImage(){ 
      return "<img src='images/art/genres/square-medium/".$this->GenreID.".jpg' title='".$this->GenreName."' alt='".$this->GenreName."'>";

    }
    
    public function getHref(){
    	return 'single-genre.php?genreid='.$this->GenreID;
    }
    
    public function getImage(){
    	return "images/art/genres/square-medium/".$this->GenreID.".jpg";
    }
    public function createCard()
    {
    		$card = "<div class='ui card genre'>";
    		$card .= "<div class='image'>".$this->createImage()."</div>";
    		$card .= "<a class='ui text content' href='single-genre.php?genreid=".$this->GenreID."'><div class='extra header'>".$this->GenreName."</div></a></div>";
    		return $card;
    }

}
?>