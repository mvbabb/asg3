<?php
include_once('domainObject.class.php');

class Painting extends DomainObject{
    public $PaintingID;
    public $ArtistID;
    public $GalleryID;
    public $ImageFileName;
    public $Title;
    public $ShapeID;
    public $MuseumLink;
    public $AccessionNumber;
    public $CopyrightText;
    public $Description;
    public $Excerpt;
    public $YearOfWork;
    public $Width;
    public $Height;
    public $Medium;
    public $Cost;
    public $MSRP;
    public $GoogleLink;
    public $GoogleDescription;
    public $WikiLink;
    public $creator;
    public $museum;
    public $genres;
    public $subjects;
    public $reviews;

    protected static function getFieldNames(){
        return array("PaintingID", "ArtistID", "GalleryID", "ImageFileName", "Title", "ShapeID", "MuseumLink", "AccessionNumber",
            "CopyrightText", "Description", "Excerpt", "YearOfWork", "Width", "Height", "Medium", "Cost", "MSRP", "GoogleLink", 
            "GoogleDescription", "WikiLink");
    }

    public function __construct($data){
        parent::__construct($data);
    }
    
    public function dimensions(){
    	return $this->Height." x ".$this->Width;
    }
    public function createThumbnail(){
    	return '<div class="painting-thumbnail paintingPreview"><a href="single-painting.php?paintingid='.$this->PaintingID.'"><img src="'.$this->squareMediumImageFilePath().'" alt="'.$this->Title.'" title="'.$this->title.'"></a></div>';
    }
    
    public function mediumImage(){
    	return '<img src="images/art/works/medium/'.$this->ImageFileName.'.jpg" class="image" title="'.$this->Title.'" alt="'.$this->title.'">';
    	     	
    }
    public function mainImage(){
    	return '<img src="images/art/works/medium/'.$this->ImageFileName.'.jpg" class="ui big image" id="artwork" title="'.$this->Title.'" alt="'.$this->title.'">';
    	 
    }
    public function squareMediumImageFilePath(){
    	return "images/art/works/square-medium/".$this->ImageFileName.".jpg";
    }
    public function createLargeImage(){
    	return '<img src="images/art/works/large/'.$this->ImageFileName.'.jpg" class="image" title="'.$this->Title.'" alt="'.$this->title.'">';
    }
    public function getLink(){
    	return 'single-painting.php?paintingid='.$this->PaintingID;
    }
    public function museumLink(){
    	return '<a href="'.$this->MuseumLink.'">Museum</a>';
    }
    public function getGenreList(){
    	$list = '<ul class="ui list">';
    	foreach($this->genres as $genre){
    		$list .='<li class="item"><a href="'.$genre->getHref().'">'.$genre->GenreName.'</a></li>';
    	}
    	$list .= '</ul>';
    	return utf8_encode($list);
    }
    public function getSubjectList(){
    	$list = '<ul class="ui list">';
    	foreach($this->subjects as $subject){
    		$list .='<li class="item"><a href="'.$subject->getHref().'">'.$subject->SubjectName.'</a></li>';
    	}
    	$list .= '</ul>';
    	return utf8_encode($list);
    }
    public function createPaintingModal(){
    	$modal = "<div class='ui fullscreen modal'>";
    	$modal .= "<div class='header'>".$this->Title."</div>";
    	$modal .= '<div class="image content">'. $this->createLargeImage();
    	$modal .= '<div class="ui text content">'.$this->Description.'</div>';
    	$modal .= "</div></div>";
    
    
    	return utf8_encode($modal);
    }
    public function getArtistLink(){
    	$anchor = '<a href="single-artist.php?artistid='.$this->ArtistID.'">'. $this->creator->LastName.'</a>';
    	return utf8_encode($anchor);
    }
    
    public function createPaintingHeader(){
    	$header = "<h2 class='header'>" .$this->Title. "</h2>";
    	$header .= "<h3>" . $this->creator->LastName. "</h3>";
    
    	return utf8_encode($header);
    }
    public function createSinglePaintingRating(){
    	$avgRating = $this->findAverageRating();
    	$stars= $this->createStars($avgRating);
    	 
    	return utf8_encode($stars);
    }
    private function findAverageRating(){
    	$rating = 0;
    	$sum = 0;
    	foreach($this->reviews as $review){
    		$sum += intval($review->Rating);
    	}
    	$rating = ceil($sum / count($this->reviews));
    	
    	return $rating;
    }
    
    private function createStars($rating){
    	$rating = intval($rating);
    	if($rating < 0) {$rating = 0;}
    	if($rating > 5) {$rating = 5;}
    	$emptyStars = 5 - $rating;
    	$stars = "";
    	for($i = 0; $i < $rating; $i++){
    		$stars .= "<i class='star icon'></i>";
    	}
    	for($i = 0; $i < $emptyStars; $i++){
    		$stars .= "<i class='empty star icon'></i>";
    	}
    	return utf8_encode($stars);
    }
    
    public function createReviewSection(){
    	$reviews = "";
    	foreach($this->reviews as $review){
    		$reviews .= $review->createReview();
    	}
    	return utf8_encode($reviews);
    }
    
}
?>
