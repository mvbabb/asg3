<?php 
include("Controllers/PaintingController.class.php");
include("Controllers/DropdownController.class.php");

$controller = new PaintingsController;
$dropdown = new DropdownController();
$painting = $controller->getPaintings();
$controller->setPaintingData($painting);
?>

<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
	<script src="js/misc.js"></script>
    <script src="browse-paintings-preview.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">   
</head>
<body >
    
<header>
    <?php include('includes/header.inc.php'); ?>
</header> 
    
<main >
    <!-- Main section about painting -->
    <section class="ui segment grey100">
        <div class="ui doubling stackable grid container">

            <div class="nine wide column">
                <?php
            echo $painting->mainImage();
            echo $painting->createPaintingModal();
                ?>


            </div>	<!-- END LEFT Picture Column -->

            <div class="seven wide column">

                <!-- Main Info -->
                <div class="item">
                    <?php echo $painting->createPaintingHeader(); ?>
                    <div class="meta">
                        <p>
                            <?php echo $painting->createSinglePaintingRating(); ?>
                        </p>
                        <?php echo utf8_encode($painting->Excerpt); ?>
                    </div>
                </div>

                <!-- Tabs For Details, Museum, Genre, Subjects -->
                <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                    <a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
                    <a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
                    <a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>
                </div>

                <div class="ui bottom attached active tab segment" data-tab="details">
                    <table class="ui definition very basic collapsing celled table">
                        <tbody>
                            <tr>
                                <td>
                                    Artist
                                </td>
                                <td>
                                    <?php echo $painting->getArtistLink(); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Year
                                </td>
                                <td>
                                    <?php echo $painting->YearOfWork; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Medium
                                </td>
                                <td>
                                    <?php echo $painting->Medium; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Dimensions
                                </td>
                                <td>
                                    <?php echo $painting->dimensions(); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="ui bottom attached tab segment" data-tab="museum">
                    <table class="ui definition very basic collapsing celled table">
                        <tbody>
                            <tr>
                                <td>
                                    Museum
                                </td>
                                <td>
                                    <?php echo '<a href="single-gallery.php?galleryid='.$painting->museum->GalleryID.'">'.utf8_encode($painting->museum->GalleryName).'</a>'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Assession #
                                </td>
                                <td>
                                    <?php echo $painting->AccessionNumber; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Copyright
                                </td>
                                <td>
                                    <?php echo utf8_encode($painting->CopyrightText); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    URL
                                </td>
                                <td>
                                    <a href=<?php echo $painting->MuseumLink ?>>View painting at museum site</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="ui bottom attached tab segment" data-tab="genres">
                	<?php echo utf8_encode($painting->getGenreList()); ?>
                	
                </div>
                <div class="ui bottom attached tab segment" data-tab="subjects">
                        <?php echo utf8_encode($painting->getSubjectList()); ?>
                </div>

                <!-- Cart and Price -->

                <div class="ui segment">
                    <form method='POST' action="view-cart.php">

                    <div class="ui form">
                        <div class="ui tiny statistic">
                            <div class="value">
                                <?php echo utf8_encode("$ ".number_format($painting->MSRP)); ?>
                            </div>
                        </div>
                        <div class="four fields">
													
                            <div class="three wide field">
																	
															
                                <label>Quantity</label>
                                <input  min=1 type="number" name="quantity">
                            </div>
                            <div class="four wide field">
                                <label>Frame</label>
                                <?php echo $dropdown->framesDropdown($painting->PaintingID); ?>
                            </div>
                            <div class="four wide field">
                                <label>Glass</label>
                                <?php echo $dropdown->glassDropdown($painting->PaintingID); ?>
                            </div>
                            <div class="four wide field">
                                <label>Matt</label>
                                <?php echo $dropdown->mattDropdown($painting->PaintingID); ?>
                            </div>
                        </div>
                    </div>
                    <div class="ui divider"></div>
                    <div class="ui two column grid">
                    <div class="ui column">
                        <button type="submit" name="addtocart" class="ui labeled icon orange button"  id="" value="<?php echo $painting->PaintingID;?>" >
                        <i class="add to cart icon"></i>
                        Add to Cart
                    </button>
                    </div>
                       
                
																										<div class="ui column">
                    <button type="submit" formaction="view-favorites.php" name="addfavp" class="ui right labeled icon button" value="<?php echo $painting->PaintingID;?>">
                        <i class="heart icon"></i>
                        Add to Favorites
                    </button>
                    </div>
                    </div>

 </form>

                </div>                    
                         
            </div> <p>
            <!-- END Cart -->
            </div>	<!-- END RIGHT data Column -->
        </div>		<!-- END Grid -->
    </section>		<!-- END Main Section --> 
    
    <!-- Tabs for Description, On the Web, Reviews -->
    <section class="ui doubling stackable grid container">
        <div class="sixteen wide column">

            <div class="ui top attached tabular menu ">
                <a class="active item" data-tab="first">Description</a>
                <a class="item" data-tab="second">On the Web</a>
                <a class="item" data-tab="third">Reviews</a>
            </div>

            <div class="ui bottom attached active tab segment" data-tab="first">
                <?php echo utf8_encode($painting->Description); ?>
            </div>	<!-- END DescriptionTab -->

            <div class="ui bottom attached tab segment" data-tab="second">
                <table class="ui definition very basic collapsing celled table">
                    <tbody>
                        <tr >
                            <td class="three wide column">
                                Wikipedia Link
                            </td>
                            <td>
                                <a href=<?php echo $painting->WikiLink; ?>>View painting on Wikipedia</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="three wide column">
                                Google Link
                            </td>
                            <td>
                                <a href="<?php echo $painting->GoogleLink; ?>">View painting on Google Art Project</a>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <?php echo utf8_encode($painting->GoogleDescription); ?>
                            </td>
                        </tr>



                    </tbody>
                </table>
            </div>   <!-- END On the Web Tab -->

            <div class="ui bottom attached tab segment" data-tab="third">
                <div class="ui feed">

                    <?php echo $painting->createReviewSection(); ?>

                </div>
            </div>   <!-- END Reviews Tab -->

        </div>
    </section> <!-- END Description, On the Web, Reviews Tabs --> 
    
    <!-- Related Images ... will implement this in assignment 2 -->    
    <section class="ui container">
    <h3 class="ui dividing header">Related Works</h3>        
	</section>  
	
</main>    
    

    
    <footer>
        <br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>