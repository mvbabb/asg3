<?php
include_once('DataAccess/classfiles/Artist.class.php');
include('DataAccess/classfiles/painting.class.php');

include_once("instance.class.php");

class ArtistsController extends Instance{
		private $gateway;
		private $artists;
	
		public function __construct(){
			parent::__construct();
			$this->gateway = new ArtistTableGateway($this->dbAdapter);
		}
		public function setArtist($id){
			$artist = $this->gateway->findById($id);
			$this->artists = new Artist($artist);
		}
		public function setAllArtists(){
			$artists = $this->gateway->findAll();
			foreach($artists as $data){
				$this->artists[] = new Artist($data);
			}
		}
		public function getArtists(){
			if($this->artists == null){
				$id = $this->DEFAULT_ARTIST_ID;
				if($this->isValid("artistid")){
					$id = $_GET["artistid"];
				}
				$data = $this->gateway->findById($id);
				if($data == null){
					$data = $this->gateway->findById($this->DEFAULT_SUBJECT_ID);
				}
					
				$this->artists = new Artist($data);
			}
				
			return $this->artists;
		}
		public function createBrowseArtistCards(){
			/*$output = "";
			if($this->artists != null){
				foreach($this->artists as $artist){
					$output .= $artist->createArtistCard();
				}
			}

			return utf8_encode($output);*/
        usort($this->artists, array($this, "cmp"));
		$output = "";
		foreach ($this->artists as $artist){
				$output .= $artist->createArtistCard();
			}
		return utf8_encode($output);
		}
		
		public function createArtistWorks($artist){
			$this->setWorks($artist);
			return $artist->createArtistWorks();
		}
		
		public function setWorks($artist){	
			$sql = $this->gateway->getArtistWorks($artist->ArtistID);
			$works = $this->dbAdapter->fetchAsArray($sql);
			foreach($works as $painting){
				$artist->works[] = new Painting($painting);
			}
		}
    	private function cmp($a, $b){
		return strcmp($a->LastName, $b->LastName);
	}
		

}

?>