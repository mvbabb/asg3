<?php
class Review extends DomainObject {
	public $RatingID;
	public $PaintingID;
	public $ReviewDate;
	public $Rating;
	public $Comment;
	protected static function getFieldNames() {
		return array (
				"RatingID",
				"PaintingID",
				"ReviewDate",
				"Rating",
				"Comment" 
		);
	}
	public function __construct($data) {
		parent::__construct ( $data );
	}
	public function createReview() {
		$outputString = "";
		$date = date_create ( $this->ReviewDate );
		$outputString .= "<div class='event'><div class='content'>";
		$outputString .= "<div class='date'>" . date_format ( $date, 'd-m-Y' ) . "</div>";
		$outputString .= "<div class='meta'><a class='like'>";
		$outputString .= $this->createStars();
		$outputString .= "</a></div>";
		$outputString .= "<div class='summary'>";
		$outputString .= $this->Comment;
		$outputString .= "</div></div></div>";
		$outputString .= '<div class="ui divider"></div>';
		
		return utf8_encode ( $outputString );
	}
	
	private function createStars(){
		$this->rating = intval($this->Rating);
		if($this->rating < 0) {$this->rating = 0;}
		if($this->rating > 5) {$this->rating = 5;}
		$emptyStars = 5 - $this->rating;
		$stars = "";
		for($i = 0; $i < $this->rating; $i++){
			$stars .= "<i class='star icon'></i>";
		}
		for($i = 0; $i < $emptyStars; $i++){
			$stars .= "<i class='empty star icon'></i>";
		}
		return utf8_encode($stars);
	}
}
?>
