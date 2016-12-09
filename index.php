<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=utf-8 />
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    <script src="js/misc.js"></script>

    <link href="css/semantic.css" rel="stylesheet" />
    <link href="css/icon.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />



</head>

<body>

    <header>
        <?php include('includes/header.inc.php'); ?>
        
        <?php
        //DATA USED FOR TESTING THE PAGE, SKIPS HAVING TO ADD TO CART FOR TESTING
/*$_SESSION['Painting'] = array(
    ["name" => "Madonna Enthroned","quantity" => 2, "frame" => "1", "glass" => "1", "matt" => "1", "id" => 441, "imgExt" => 114020],
    ["name" => "Mona Lisa","quantity" => 3, "frame" => "4", "glass" => "2", "matt" => "34", "id" => 389, "imgExt" => "097050"]);*/

        
       
        
        
        
        
        
?> 
    </header>
    <div class="hero-container">
        <div class="ui text container">
            <h1 class="ui huge header">Decorate your world</h1>
            <a class="ui huge orange button" href="browse-paintings.php">Shop Now</a>
        </div>
    </div>
    <h2 class="ui horizontal divider">
        <i class="tag icon"></i>Deals
    </h2>

    <main>
        <div class="ui container link cards center ">
            <div class="card">
                <div class="image">
                    <img src="images/art/works/medium/107050.jpg" />
                </div>
                <div class="content">
                    <h4 class="description">Experience the sensuous pleasures of the French Rococo</h4>
                </div>
                <div class="bottom attached animated fluid ui button" tabindex="0">
                    <a href="single-genre.php?genreid=83">
                        <div class="visible content">See More</div>
                        <div class="hidden content">
                            Rococo
                        </div>
                    </a>

                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="images/art/works/medium/126010.jpg" />
                </div>
                <div class="content">
                    <h4 class="description">Appeciate the quiet beauty of the Dutch Golden Age</h4>
                </div>
                <div class="animated fluid ui button">
                    <a href="single-genre.php?genreid=87">
                        <div class="visible content">See More</div>
                        <div class="hidden content">
                            Dutch Golden Age
                        </div>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="images/art/works/medium/100030.jpg" />
                </div>
                <div class="content">
                    <h4 class="description">Discover the glorious color of the Renaissance</h4>
                </div>
                <div class="bottom attached animated fluid ui button" tabindex="0">
                    <a href="single-genre.php?genreid=78">

                        <div class="visible content">See More</div>
                        <div class="hidden content">
                            Renaissance
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>