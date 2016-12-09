<?php
include('DataAccess/classfiles/genre.class.php');
include('DataAccess/classfiles/painting.class.php');

include_once("instance.class.php");

class GenresController extends Instance{
	private $gateway;
	private $genres;
	
	public function __construct(){
		parent::__construct();
		$this->gateway = new GenresTableGateway($this->dbAdapter);
	}
	
	public function setBrowseGenreData(){
		$sql = $this->gateway->getSelectStatement();
		$statement = $this->dbAdapter->fetchAsArray($sql);
		foreach($statement as $data){
			$genre = new Genre($data);
			$this->genres[] = $genre;
		}
	}
	
	public function getGenre(){
		if($this->genres == null){
			$id = $this->DEFAULT_GENRE_ID;
			if($this->isValid("genreid")){
				$id = $_GET["genreid"];
			}
			$data = $this->gateway->findById($id);
			if($data == null){
				$data = $this->gateway->findById($this->DEFAULT_GENRE_ID);
			}
			
			$this->genres = new Genre($data);
		}

		return $this->genres;
		
	}
	
	public function createBrowseGenreCards(){
	
		usort($this->genres, array($this, "cmp"));
		$output = "";
		foreach ($this->genres as $genre){
				$output .= $genre->createCard();
			}
		return utf8_encode($output);
	}
	
	public function singleGenreHeader(){
			$genre = $this->getGenre();
			$header = "<div class='item'><div class='image'>";
			$header .= $genre->createImage() . "</div>";
			$header .= '<div class="content"><h2 class="ui header">'.$genre->GenreName.'</h2>';
			$header .= '<div class="ui divider"></div>';
			$header .= '<div class="description"><p>'.$genre->Description.'</p>';
			$header .= '</div></div></div>';
		
			return utf8_encode($header);
		
	}
	
	function createSingleGenrePictureGrid(){
		$genre = $this->getGenre();
		$cards = "";
		$sql = $this->gateway->getPaintings($genre->GenreID);
		$data = $this->dbAdapter->fetchAsArray($sql);
		foreach($data as $painting){
			$painting = new Painting($painting);
			$cards .= "<div class='ui column link'>";
			$cards .= $painting->createThumbnail();
			$cards .= "</div>";
		}
	
		return utf8_encode($cards);
	}
	
	
	private function cmp($a, $b){
		return strcmp($a->EraID, $b->EraID);
	}
}

?>