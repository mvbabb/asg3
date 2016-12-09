<?php
include_once ("DataAccess/classfiles/domainObject.class.php");
include_once ("DataAccess/classfiles/Artist.class.php");
include_once ("DataAccess/classfiles/painting.class.php");

include ("instance.class.php");

class favorite extends DomainObject {
	public $image;
	public $name;
	public $id;
	public $destination;
	public $formName;
	public function __construct($id, $imagePath, $name, $destination, $formName) {
		$this->id = $id;
		$this->name = $name;
		$this->image = $imagePath;
		$this->destination = $destination;
		$this->formName = $formName;
	}
	public static function getFieldNames() {
		return array (
				"image, name, id, destination" 
		);
	}
	public function createFavoriteCard() {
		$output = "<div class='ui card'>
		<div class='image'>
		<img src='" . $this->image . "'>
		</div>
		<div class='content'>
		<a class='text' href='" . $this->destination . "'>" . $this->name . "</a>
		</div>
		<div class='extra content'>
		<form action='view-favorites.php' method='post'>
		<button name='".$this->formName."' value ='" . $this->id . "' class='ui right floated mini button'>
		<i class='trash icon'></i>remove
		</button>
				</form>
		</div></div>";
		
		return $output;
	}
}
class FavoriteHelpers extends Instance{
	public function __construct(){
		parent::__construct();
	}
	public function updateFavorites(){
		if(isset($_POST['addfava'])){
			$this->addArtist($_POST['addfava']);
		}
		if(isset($_POST['addfavp'])){
			$this->addPainting($_POST['addfavp']);
		}
		if(isset($_POST['remfavp'])){
			$this->removeFavoritePainting($_POST['remfavp']);
		}		
		if(isset($_POST['remfava'])){
			$this->removeFavoriteArtist($_POST['remfava']);
		}
		if(isset($_POST['remallfav'])){
			$this->emptyFavorites();
		}
		if(isset($_POST['remalla'])){
			$this->emptyFavoriteArtists();
		}
		if(isset($_POST['remallp'])){
			$this->emptyFavoritePaintings();
		}
	}
	public function emptyFavorites() {
		$this->emptyFavoriteArtists ();
		$this->emptyFavoritePaintings ();
	}
	public function emptyFavoriteArtists() {
		unset ( $_SESSION ['favorite_artists'] );
		$_SESSION ['favorite_artists'] = array ();
	}
	public function emptyFavoritePaintings() {
		unset ( $_SESSION ['favorite_paintings'] );
		$_SESSION ['favorite_paintings'] = array ();
	}
	public function removeFavoriteArtist($id) {
		if (null != $_SESSION["favorite_artists"]  && count($_SESSION['favorite_artists'] > 0)) {
			for($i = 0; $i < count ( $_SESSION ["favorite_artists"] ); $i ++) {
				if ($_SESSION ["favorite_artists"] [$i]->id == $id) {
					unset ( $_SESSION ["favorite_artists"] [$i] );
                    $_SESSION ['favorite_artists'] = array_values ( $_SESSION ['favorite_artists'] );
				}
			}
		}
	}
	public function removeFavoritePainting($id) {
		if (null != $_SESSION["favorite_paintings"] && count($_SESSION['favorite_paintings'] > 0)) {
			for($i = 0; $i < count ( $_SESSION ["favorite_paintings"] ); $i ++) {
				if($_SESSION ["favorite_paintings"] [$i] != null){
					if ($_SESSION ["favorite_paintings"] [$i]->id == $id) {
						unset ( $_SESSION ["favorite_paintings"] [$i] );
                        $_SESSION ['favorite_paintings'] = array_values ( $_SESSION ['favorite_paintings'] );
					}
				}

			}
		}
	}

	

	public function exists($id, $list = array()) {
		for($i = 0; $i < count($list) ; $i ++) {
			if ($list[$i]->id == $id) {
				return true;
			}
		}
		return false;
	}
	
	public function addPainting($id){
		$success = false;
		$this->gateway = new PaintingsTableGateway($this->dbAdapter);
		if(!isset ($_SESSION['favorite_paintings'])){
			$_SESSION['favorite_paintings'] = array();
		}
		if(!$this->exists($id, $_SESSION['favorite_paintings'])){
			$data = $this->gateway->findByID($id);
			$painting = new Painting($data);
			if($painting != null){
				$favoritePainting = new favorite(
						$painting->PaintingID,
						$painting->squareMediumImageFilePath(),
						$painting->Title,
						"single-painting.php?paintingid=".$painting->PaintingID,
						"remfavp"
						);
				array_push($_SESSION['favorite_paintings'], $favoritePainting);
				$success = true;
			}
		}
	
		$this->closeConnection();
		return $success;
	}
	public function addArtist($id){

		$success = false;
		$this->gateway = new ArtistTableGateway($this->dbAdapter);
        if(!isset($_SESSION['favorite_artists'])){
            $_SESSION['favorite_artists'] = array();
        }
		if(!$this->exists($id, $_SESSION['favorite_artists'])){
			$data = $this->gateway->findByID($id);
			$artist = new Artist($data);
			if($artist != null){
				$favoriteArtist = new favorite(
						$artist->ArtistID,
						$artist->getHref(),
						$artist->getFullName(false),
						"single-artist.php?artistid=".$artist->ArtistID,
						"remfava"
						);
				//array_push($_SESSION['favorite_artists'], $favoriteArtist);
                
                
        if(!empty($_SESSION['favorite_artists'])){
				    array_push($_SESSION['favorite_artists'], $favoriteArtist);
			}
			     else{
				    $_SESSION['favorite_artists'] = array($favoriteArtist);
			     }
                
                
                
                
				$success = true;
			}
		}
	
		$this->closeConnection();
		return $success;
	}
}
?>