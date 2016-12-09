 <?php 
 require("Controllers/singleGallery.class.php");
 
 $galleryController = new SingleGalleryController;
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

<style>
       #map {
    height: 350px;
    width: 100%;
       }

    </style>

</head>

<body>
    <header>
        <?php include('includes/header.inc.php'); ?>
    </header>

    <main>
        <br />
        <div class="ui wide container">
                    <div class="ui stackable grid">
            	<div class="ui eight wide column">
            		<h2 class="ui header"><?php echo utf8_encode($galleryController->getGallery()->GalleryName);?></h2>
            		<p><?php echo $galleryController->gallery->getGalleryLocation(); ?></p>
            		<div class='ui divider'></div>
					<div class="animated fluid ui button">
					<?php $website = $galleryController->gallery->GalleryWebSite; ?>
                    <a href="<?php echo $website; ?>">
                        <div class="visible content">Visit website</div>
                        <div class="hidden content">
                            <i class='right arrow icon'></i>
                        </div>
                    </a>                    
                	</div>
                	<div class='ui hidden divider'></div>
                	
            		<?php echo $galleryController->createMuseumMap(); ?>
            	</div>
            	<div class="ui eight wide column">
            		<iframe src="<?php echo $website; ?>" height="550" width="100%"></iframe>
				</div>
            
            </div>
        
            <div class="ui horizontal divider">
                <h2 class="ui">Paintings</h2>
            </div>

            <div class="ui six column stackable grid">
                <?php
                echo $galleryController->createSingleGalleryPictureGrid();
?>
            </div>
            

            
            
        </div>


    </main>
    <footer>
        <br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>