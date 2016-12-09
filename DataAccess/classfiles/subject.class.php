<?php
include_once('domainObject.class.php');
class Subject extends DomainObject{
    public $SubjectID;
    public $SubjectName;

    protected static function getFieldNames(){
        return array("SubjectID", "SubjectName");
    }

    public function __construct($data){
        parent::__construct($data);
    }
        
    public function createSubjectCard(){
    	$card = '<div class="ui column"><div class="ui segment subject">';
    	$card .= '<a href="single-subject.php?subjectid='.$this->SubjectID.'"><h3 class="ui header">'.$this->SubjectName.'</h3></a>';
    	$card .= '</div></div>';
    
    	return $card;
    }
    
    public function getHref(){
    	return 'single-subject.php?subjectid='.$this->SubjectID;
    }
    
}
?>
