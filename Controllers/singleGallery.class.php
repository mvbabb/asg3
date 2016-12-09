<?php
include('DataAccess/classfiles/gallery.class.php');
include('DataAccess/classfiles/painting.class.php');
include("instance.class.php");
class SingleGalleryController extends Instance {
	private $gateway;
	public $gallery;
	public $paintings;
	public function __construct() {
		parent::__construct ();
		$this->gateway = new GalleriesTableGateway ( $this->dbAdapter );
		$this->getGallery();
		$this->getPaintings();
	}
	public function getGallery() {
		$galleryID = $this->DEFAULT_GALLERY_ID;
		if ($this->isValid ( 'galleryid' )) {
			$galleryID = $_GET ['galleryid'];
		}
		
		$data = $this->gateway->findById( $galleryID );
		if(empty($data)){
			$data = $this->gateway->findById ( $this->DEFAULT_GALLERY_ID );	
		}
		$g = new Gallery($data);
		$this->gallery = $g;
		return $this->gallery;
	}
	
	public function getPaintings() {
		$paintings = array ();
		$data = $this->dbAdapter->fetchAsArray ( $this->gateway->getPaintings ( $this->gallery->GalleryID ) );
		
		foreach ( $data as $painting ) {
			$this->paintings[] = new Painting ( $painting );
		}
	}
	public function createMuseumMap() {
		if ($this->gallery != null) {
			$output = '<div id="map"></div><script> function createMap() {
        var uluru = {lat:' . $this->gallery->Latitude . ', lng:' . $this->gallery->Longitude . '};
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      };</script>
      <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABLWIe4bJ_hsZvhr1DfJ8GDTnme_0BDiY&callback=createMap">
    </script>';
			return $output;
		} else {
			return '<div class="ui text">gallery map unavailable</div>';
		}
	}
	public function createGalleryHeader() {
		if ($this->gallery != null) {
			print_r($this->gallery->GalleryName);
			$header = "<div class='item'>";
			$header .= '<div class="content"><h2 class="ui header">' . $this->gallery->GalleryName . '</h2>';
			$header .= '<div class="meta"><span>' . $gallery ["GalleryCity"] . ', ' . $this->gallery->GalleryCountry . '</span></div>';
			$header .= '<div class="ui divider"></div>';
			$header .= '<div class="description"><h4>Website: </h4><a href="' . $this->gallery->GalleryWebSite . '">' . $this->gallery->GalleryWebSite . '
    </a></div>';
			$header .= '<h4>Location:</h4>';
			$header .= '</div></div>';
			
			return utf8_encode ( $header );
		}
	}
	public function createSingleGalleryPictureGrid() {
		$cards = "";
		if (! empty ( $this->paintings )) {
			foreach ( $this->paintings as $painting ) {
				$cards .= "<div class='ui column'>";
				$cards .= $painting->createThumbnail();
				$cards .= "</div>";
			}
		}
		
		return utf8_encode ( $cards );
	}
}
?>
