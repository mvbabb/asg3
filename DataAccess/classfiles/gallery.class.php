<?php
include_once('domainObject.class.php');
class Gallery extends DomainObject {
	public $GalleryID;
	public $GalleryName;
	public $GalleryNativeName;
	public $GalleryCity;
	public $GalleryCountry;
	public $Latitude;
	public $Longitude;
	public $GalleryWebSite;
	protected static function getFieldNames() {
		return array (
				"GalleryID",
				"GalleryName",
				"GalleryNativeName",
				"GalleryCity",
				"GalleryCountry",
				"Latitude",
				"Longitude",
				"GalleryWebSite" 
		);
	}
	public function __construct($data) {
		parent::__construct ( $data );
	}
	public function getGalleryLocation(){
		return $this->GalleryCity.', '.$this->GalleryCountry;
	}
	public function getGallerySegment() {
		$output = '<div class="ui segment gallery">' . 
		'<a href="single-gallery.php?galleryid=' . $this->GalleryID . '">
				<h3 class="ui header">' . $this->GalleryName . '</h3><a>' . 
		'<div class="ui divider"></div>' . 
		'<p class="ui text content">' . $this->GalleryCity . ', ' . $this->GalleryCountry . '</p></div>';
		return $output;
	}
}

?>