<?php
include_once ("Controllers/ArtistController.class.php");

$controller = new ArtistsController ();
$artist = $controller->getArtists ();
?>

<html lang=en>

<head>
<meta charset=utf-8 />
<link href='http://fonts.googleapis.com/css?family=Merriweather'
	rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
	rel='stylesheet' type='text/css' />

<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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

	<main>
        <br />
	<div class="ui container">
		<div class="ui horizontal divider">
			<h2 class="ui"><?php echo utf8_encode($artist->getFullName()); ?></h2>
		</div>
		<div class='ui divided items'>
			<div class='item'>
				<div class='ui image'> <?php echo utf8_encode($artist->mediumImage()); ?></div>
				<div class='content'>
					<strong>Nationality: </strong> <?php  echo utf8_encode($artist->Nationality); ?><br />
					<strong>Gender: </strong><?php echo utf8_encode($artist->Gender); ?> <br /> <strong>
					Year of birth: </strong><?php  echo utf8_encode($artist->YearOfBirth); ?><br /> <strong>
					Year of death: </strong><?php echo utf8_encode($artist->YearOfDeath);
						echo utf8_encode(" (age " . $artist->getLifeSpan() . " )");
						?>
   <div class='ui bottom attached'>
   <?php 
   echo $artist->viewWorksButton();
   
   	echo $artist->favoriteButton();
   ?>
						<!--  View works button 
   createArtistViewWorksButton($artist["ArtistID"]);
    createArtistFavoriteButton($artist["ArtistID"]);-->
						<!--  add to favorites button -->
						<a href="<?php echo $artist->ArtistLink; ?>">Wikipedia</a>

					</div>
					<br />
					<div class='ui horizontal divider'>
						<div class='ui header'>Details</div>
					</div>
					<p><?php  echo utf8_encode($artist->Details); ?></p>
				</div>


			</div>
		</div>
		<div class="ui horizontal divider">
			<div class="header">Artist's Works</div>
		</div>
		<div class="ui six column stackable grid">
                <?php echo $controller->createArtistWorks($artist); ?>
        </div>
	
	</main>
	<footer>
		<br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>