<?php 
//session_start();
include("Controllers/PaintingController.class.php");



// possibyl add functionality for name search
if(isset($_GET["artistid"]) && !empty($_GET['artistid'])){
    $id = $_GET["artistid"];
    $searchBy = "artistid";
    
}
elseif(isset($_GET["shapeid"]) && !empty($_GET['shapeid'])){
    $id = $_GET["shapeid"];
    $searchBy = "shapeid";
}
elseif(isset($_GET["galleryid"]) && !empty($_GET['galleryid'])){
    $id = $_GET["galleryid"];
    $searchBy = "galleryid";
    
}





function displayPaintings($searchBy, $id){
    $paintingController = new PaintingsController;
    $output = "";
    $output .= "";
    $output .= $searchBy;
    
    $paintingController->createCurrentFilterString();
    $paintingController->setBrowsePaintingData();
    return $paintingController->createBrowsePaintingsList(); 
    
    
    
    
    
}
header('Content-type: application/json');
$x = displayPaintings($searchBy, $id);

echo json_encode(array($x));

?>


