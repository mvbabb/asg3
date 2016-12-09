<?php
include("DataAccess/dataconnection/DatabaseAdapterFactory.class.php");
include('DataAccess/gateways/gateways.class.php');

class Instance{
	protected $DBCONN = 'mysql:host=localhost;dbname=art';
	protected $DBUSER = 'testuser';
	protected $DBPASS = 'mypassword';
	protected $ADAPTERTYPE = "PDO";
	protected $dbAdapter;
	
	protected $DEFAULT_PAINTING_ID = 105;
	protected $DEFAULT_ARTIST_ID = 1;
	protected $DEFAULT_GENRE_ID = 1;
	protected $DEFAULT_GALLERY_ID = 2;
	protected $DEFAULT_SUBJECT_ID = 11;
	protected $BROWSE_PAINTING_LIMIT = 20;
	
	
	public function __construct(){
		$connectionValues = array($this->DBCONN, $this->DBUSER, $this->DBPASS);
		$this->dbAdapter = DataBaseAdapterFactory::create($this->ADAPTERTYPE, $connectionValues);
		
	}
	
	public function closeConnection(){
		$this->dbAdapter->closeConnection();
		
	}
	
	protected function truncateString($string, $length){
		return utf8_encode(substr($string, 0, strpos(wordwrap($string, $length), "\n")));
	}
	
	public function isValid($key){
		$key = strtolower($key);
		if(isset($_GET[$key]) && !empty($_GET[$key]) && is_numeric($_GET[$key])){
			return true;
		}
		return false;
	}

	public function createImage($src, $alt, $title, $class, $id){
		return utf8_encode('<img class="'.$class.'" id="'.$id.'" src="'.$src.'" alt="'.$alt.'" title="'.$title.'"/>');
	}
}

?>