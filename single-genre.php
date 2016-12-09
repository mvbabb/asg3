<?php
 include("Controllers/GenresController.class.php");
 
 $controller = new GenresController;
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

    <link href="css/semantic.css" rel="stylesheet" />
    <link href="css/icon.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />



</head>

<body>

    <header>
        <?php include('includes/header.inc.php'); ?>
    </header>
    <div class="hero-container genre-container">
        <div class="ui container items">
           <?php echo $controller->singleGenreHeader(); ?>
        </div>
    </div>


    <main>
        <br />
        <div class="ui container">
            <div class="ui horizontal divider">
                <h2 class="ui">Paintings</h2>
            </div>
            <div class="ui six column stackable grid">
                <?php echo $controller->createSingleGenrePictureGrid(); ?>
            </div>
        </div>

    </main>
    <footer>
        <br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>