<?php
include_once("Controllers/favourite.class.php");
$favorite = new FavoriteHelpers;
?>

<!DOCTYPE html>
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

<link href="css/semantic.css" rel="stylesheet" />
<link href="css/icon.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />

</head>

<body>

	<header>
        <?php include('includes/header.inc.php'); ?>
    </header>

	<h2 class="ui horizontal divider">
		<i class="heart icon"></i> Favorites
	</h2>

	<main> <br />
	<div class="ui container">
		<div class="ui content"></div>

		<div class="ui top attached tabular menu">
			<a class="active item" id="menu_painting">Paintings</a> <a class="item"
				id="menu_artist">Artists</a> <a class="right item"> <a class="ui compact button" id="rem_artist"><form action='view-favorites.php' method='post'><button class="ui button" name="remalla" type="submit" value="1"><i class="trash icon"></i>Remove
					Artists</button></form></a>
			<a class="ui compact button" id="rem_painting"><form action='view-favorites.php' method='post'><button class="ui button" name="remallp" type="submit" value="1"><i class="trash icon"></i>Remove
					Paintings</button></form></a>
			<a class="ui compact negative button" id="rem_all"><form action='view-favorites.php' method='post'><button class="ui red button" name="remallfav" type="submit" value="1"><i class="trash icon"></i>Remove
					Favorites</button></form></a>
			</a>


		</div>
		
		<div class="ui bottom attached segment">
					<div class="ui six column grid fav-paintings">
		</div>
			<div class="ui six column grid fav-paintings">
			<?php
			$favorite->updateFavorites();
				
			if (! empty ( $_SESSION ['favorite_paintings'] )) {
				$paintings = $_SESSION ['favorite_paintings'];
				
				for($i = 0; $i < count ( $paintings ); $i ++) {
					if(!empty($paintings[$i])){
						echo "<div class='ui column'>";
						echo $paintings[$i]->createFavoriteCard ();
						echo "</div>";
					}

				}
			}
			?>
			</div>
			<div class="ui six column grid fav-artists">
			<?php
			
			if (! empty ( $_SESSION ['favorite_artists'] )) {
				$paintings = $_SESSION ['favorite_artists'];
				
				for($i = 0; $i < count ( $paintings ); $i ++) {
					echo "<div class='ui column artist'>";
					echo $paintings [$i]->createFavoriteCard ();
					echo "</div>";
				}
			}
			?>
			</div>


		</div>
	</div>

	<br />

	</main>
	<footer>
		<br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
<script>
	var artists = document.querySelectorAll(".fav-artists .card");
	var paintings = document.querySelectorAll(".fav-paintings .card");
	var remPainting = document.getElementById("rem_painting");
	var remArtist = document.getElementById("rem_artist");
	var remFavorites = document.getElementById("rem_all");
	
	var show = function(list){
		for(var i = 0; i < list.length; i++){
			list[i].classList.remove("hide");
		}
	};

	var hide = function(list){
		for(var i = 0; i < list.length; i++){
			list[i].classList.add("hide");
		}
	};
	

	var toggleDisplay = function(e){
		if(e.target.text === "Artists"){
			hide(paintings);
			show(artists);
			remPainting.style.display = "none";
			remArtist.style.display ="";
			}
		else{
			hide(artists);
			show(paintings);
			remArtist.style.display = "none";
			remPainting.style.display ="";
			
		}
	};
	hide(artists);
	remArtist.style.display = "none";
	
	var paintingMenuButton = document.getElementById("menu_painting");
	paintingMenuButton.addEventListener("click", toggleDisplay);

	var paintingMenuButton = document.getElementById("menu_artist");
	paintingMenuButton.addEventListener("click", toggleDisplay);

	remArtist.addEventListener("click", removeArtistFromFavorites);
	remPainting.addEventListener("click", removePaintingFromFavorites);
	remFavorites.addEventListener('click', removeAllFavorites);

	
	
</script>
</html>