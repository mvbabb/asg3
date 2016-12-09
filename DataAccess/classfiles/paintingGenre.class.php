<?php
class PaintingGenre extends DomainObject{
	public $PaintingGenreID;
	public $PaintingID;
	public $GenreID;

    protected static function getFieldNames(){
        return array("PaintingGenreID", "PaintingID", "GenreID");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
