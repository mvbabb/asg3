<?php
class PaintingSubject extends DomainObject{
	public $PaintingSubjectID;
	public $PaintingID;
	public $SubjectID;

    protected static function getFieldNames(){
        return array("PaintingSubjectID", "PaintingID", "SubjectID");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
