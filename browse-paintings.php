<?php 
include("Controllers/PaintingController.class.php");
include("Controllers/DropdownController.class.php");

$paintingController = new PaintingsController;
$dropdown = new DropdownController();

?>
<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=utf-8 />
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    <script src="js/misc.js"></script>
     <script src="browse-paintings-preview.js"></script>
    <script src="browse-painting-service.js"></script>
    

    <link href="css/semantic.css" rel="stylesheet" />
    <link href="css/icon.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />



</head>

<body>

    <header>
        <?php include('includes/header.inc.php'); ?>
    </header>


    <main>
        <h2 class="ui horizontal divider">
            <i class="tag icon"></i>Browse Paintings
        </h2>
        <br />
        <div class="ui fluid stackable grid">
            <div class="one wide column"></div>
                <div class="three wide column">
                    <div class="ui secondary vertical menu">
                        <div class="ui segment" id="painting-filters">
                        <form class="ui large form" action="browse-paintings.php" method="get">
                            <h3 class="ui grey dividing header">
                                Filters
                            </h3>
                            <div class="field">
                                <label class="ui grey header">
                                    Artist
                                </label>
                                <?php 
                                echo $dropdown->artistDropdown() 
                                ?>
                            </div>
                            <div class="field">
                                <label class="ui grey header">
                                    Museum
                                </label>
                                <?php 
                                echo $dropdown->museumDropdown(); 
                                ?>
                            </div>
                            <div class="field">
                                <label class="ui grey header">
                                    Shape
                                </label>
                                <?php 
                                echo $dropdown->shapeDropdown(); 
                                ?>


                            </div>


                        </form>

                    </div>
                </div>
            </div>
                
                <div class="ten wide column">
                    <div class="row">
                        <h2 class="ui header">
                            Paintings
                            <div class="sub header filterTitle">
                                <?php 
                                echo $paintingController->createCurrentFilterString(); ?>
                            </div>
                        </h2>
                    </div>
                    <div class="ui divider"></div>
                      <div class="ui dimmer dim">
    <div class="ui loader"></div>
  </div>
                    <div class="paintingSection">
                    <?php 
                    $paintingController->setBrowsePaintingData();
                    echo $paintingController->createBrowsePaintingItems(); ?>
                        </div>
                </div>
        <div class="two wide column"></div>
     <!-- <script>
          console.log("test2");
          
                
          $.get("service-painting.php?artistid=135", function (data) {
              data = JSON.parse(data);
                //alert("Data Loaded" + data[0].Title);
          $("<br><br><select id='citiesDropDown'></select>").insertAfter("#countriesDropDown");
                $(data).each(function (index) {
                    $("<option value='" + data[index]['paintingID'] + "'>" + data[index]['imagePath'] + "</option>").appendTo("#citiesDropDown");
    console.log("test");
                });
            }); 
            </script>-->
        </div>

    </main>
    <footer>
        <br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
   
</html>