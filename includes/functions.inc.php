<?php
//------Basic functions-----
/////////////////////////////////////////////////////
function createIndividualFrameDropdownSelectList($paintingID){
    $frames = findAllOfType("Frames");
    return utf8_encode(createIndividualSelectList("frame", "FrameID", "ui search dropdown", $frames, "Title",'"'. $paintingID . 'FrameID"'));
}
function createIndividualGlassDropdownSelectList($paintingID){
    $glass = findAllOfType("Glass");
    return utf8_encode(createIndividualSelectList("glass", "GlassID", "ui search dropdown", $glass, "Title",'"'. $paintingID . 'FrameID"'));
}
function createIndividualMattDropdownSelectList($paintingID){
    $matts = findAllOfType("Matt");
    return utf8_encode(createIndividualSelectList("matt", "MattID", "ui search dropdown", $matts, "Title",'"'. $paintingID . 'FrameID"'));
}
function createIndividualSelectList($id, $itemID, $class, $listItems, $searchString, $name){
    $list = "<select name='".strtolower($name)."' id='".$id."' class='".$class."'>";

    foreach($listItems as $item){
        $list .= createOption($item[$itemID], $item[$searchString]);
    }
    $list .= "</select>";
    return $list;
}

//HEADER SESSION COUNTERS

function countFavorites(){
	$count = 0;
	if(isset($_SESSION['favorite_paintings'])&& !empty($_SESSION['favorite_paintings'])){
		$count += count($_SESSION['favorite_paintings']);
	}
	if(isset($_SESSION['favorite_artists'])&& !empty($_SESSION['favorite_artists'])){
		$count += count($_SESSION['favorite_artists']);
	}
   
	return $count;
}

function countCart(){
	if(isset($_SESSION['Painting'])&& !empty($_SESSION['Painting'])){
		return count($_SESSION['Painting']);
	}
	else{
		return 0;
	}
}



?>

























