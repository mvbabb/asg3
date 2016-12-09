<?php
include_once('DataAccess/classfiles/subject.class.php');
include_once('DataAccess/classfiles/painting.class.php');

include_once("instance.class.php");
class SubjectController extends Instance {
	private $gateway;
	private $subjects;
	public function __construct() {
		parent::__construct ();
		$this->gateway = new SubjectsTableGateway($this->dbAdapter);
	}
	public function getSubject(){
		if($this->subjects == null){
			$id = $this->DEFAULT_SUBJECT_ID;
			if($this->isValid("subjectid")){
				$id = $_GET["subjectid"];
			}
			$data = $this->gateway->findById($id);
			if($data == null){
				$data = $this->gateway->findById($this->DEFAULT_SUBJECT_ID);
			}
				
			$this->subjects = new Subject($data);
		}
	
		return $this->subjects;
	
	}
	
	public function getAllSubjects(){
		if(!is_array($this->subjects)){
			$this->subjects = array($this->subjects);
		}
		return $this->subjects;
	}
	public function SetAllSubjects(){
		$subjects = $this->gateway->findAll();
		foreach($subjects as $data){
			$this->subjects[] = new Subject($data);
		}
	}
	
	public function createBrowseSubjectsCards(){
		$sql = $this->gateway->getSelectStatement();
		$subjects = $this->dbAdapter->fetchAsArray($sql);
		foreach($subjects as $data){
			$this->subjects[] = new Subject($data);
		}
        
        
        
        
        usort($this->subjects, array($this, "cmp"));
		$output = "";
		foreach ($this->subjects as $subject){
				$output .= $subject->createSubjectCard();
			}
		return utf8_encode($output);
        
        
      /*  
		$output = "";
		if($this->subjects != null){
			foreach($this->subjects as $subject){
				$output .= $subject->createSubjectCard();
			}
		}

		return utf8_encode($output);*/
	}
	public function createSingleSubjectPictureGrid(){
		$subject = $this->getSubject();
		$sql = $this->gateway->getPaintingsSelectStatement($subject->SubjectID);
		$allPaintings = $this->dbAdapter->fetchAsArray($sql);
		$cards = "";
		foreach($allPaintings as $data){
			$painting = new Painting($data);
			$cards .= "<div class='ui column link'>";
			$cards .= $painting->createThumbnail();
			$cards .= "</div>";
		}
		return utf8_encode($cards);
	}
    private function cmp($a, $b){
		return strcmp($a->SubjectName, $b->SubjectName);
	}
	
}

?>