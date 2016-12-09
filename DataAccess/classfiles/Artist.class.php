<?php
include_once('domainObject.class.php');

class Artist extends DomainObject{
    public $ArtistID;
    public $FirstName;
    public $LastName;
    public $Nationality;
    public $Gender;
    public $YearOfBirth;
    public $YearOfDeath;
    public $Details;
    public $ArtistLink;
    public $works;
   protected static function getFieldNames(){
       return array("ArtistID", "FirstName", "LastName", "Nationality", "Gender", "YearOfBirth",
           "YearOfDeath", "Details", "ArtistLink");
   }
   public function __construct($data){
       parent::__construct($data);
   }
    public function getFullName($commaDelimited = false){
        $name = "";
    	if($commaDelimited){
    		$name = ''.$this->LastName . ', ' . $this->FirstName;
        }
        else{
        	$name = ''.$this->FirstName . ' ' . $this->LastName;
        }
        return $name;
    }

    public function getLifeSpan(){
        return $this->YearOfDeath - $this->YearOfBirth;
    }
    
   
    
    public function mediumImage(){
    	$name = $this->getFullName(false);
    	return '<img src="images/art/artists/medium/'.$this->ArtistID.'.jpg" title="'.$name.'" alt="'.$name.'">';
    	 return $image;
    }
    public function getHref(){
    	return 'images/art/artists/square-medium/'.$this->ArtistID.'.jpg';
    }
    public function squareMediumImage(){
    	$name = $this->getFullName(false);
    	return '<img src="images/art/artists/square-medium/'.$this->ArtistID.'.jpg" title="'.$name.'" alt="'.$name.'">';
    }
    public function getThumbnail(){
    	$name = $this->getFullName(false);
    	return '<img src="images/art/artists/square-thumb/'.$this->ArtistID.'.jpg" title="'.$name.'" alt="'.$name.'">';
    }
    
    public function createArtistCard(){
    	$card = '<div class="ui card artist">';
    	$card .= '<div class="image">'.$this->squareMediumImage().'</div>';
    	$card .= '<a class="ui text content" href="single-artist.php?artistid='.$this->ArtistID.'"><div class="extra header">'.$this->getFullName(false)."</div></a>";
    	$card .= "</div>";
    
    	return $card;
    }
    
    public function createItem(){
    	$item = "<div class='item'>";
    	$item .= "<div class='ui image'>" . $this->mediumImage() . "</div>";
    	$item .= createArtistItemContent($artist);
    	$item .= "</div>";
    
    	return $item;
    }
    public function viewWorksButton(){
    	$button = "<a href='browse-paintings.php?artistid=".$this->ArtistID."'>";
    	$button .= "<div class='ui right floated primary animated button'><div class='visible content'>View Works</div><div class='hidden content'><i class='right chevron icon'></i></div></div>";
    	$button .= "</a>";
    	return $button;
    }
    public function favoriteButton(){
    	$button = "<form action='view-favorites.php' method='post'><button value='$this->ArtistID' class='ui right floated animated button' name='addfava'>";
    	$button .= "<div class='visible content'>Add To Favourites</div><div class='hidden content'><i class='heart icon'></i></div>";
    	$button .= "</button></form>";
    
    	return $button;
    }
    public function createArtistWorks(){
    	$works = "";
    	foreach($this->works as $painting){
    		$works .= "<div class='ui column'><div class='ui image'>" . $painting->createThumbnail() . "</div></div>";
    	}
    	return $works;
    
    }
}
?>