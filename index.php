<?php
include_once('header.php');

//Funkcija prebere oglase iz baze in vrne polje objektov
function get_ads(){
	global $conn;
	$query = "SELECT * FROM ads WHERE TRUE";

	if(isset($_POST["category"])){
		$temporaryQuery = "SELECT categories.* FROM categories WHERE (";

		foreach($_POST["category"] as $i){
			$temporaryQuery = $temporaryQuery . "name='$i' OR ";
		}
		$temporaryQuery = $temporaryQuery . "0)";
		$result = $conn->query($temporaryQuery);
		$categories = array();

		while($cat = $result->fetch_object()){
			array_push($categories,$cat);
		}

	}
	if(isset($_POST["search"])){
		$like = "%".$_POST["search"]."%";
		$query = $query . " AND (title LIKE '$like' OR description LIKE '$like')";
	}

	//echo "Searching with query:<br/> . $query";
	$result = $conn->query($query);
	$ads = array();

	while($ad = $result->fetch_object()){
		if(strtotime($ad->expiration) > time()){
			array_push($ads, $ad);
		}
	}
	return $ads;
}

//Preberi oglase iz baze
$ads = get_ads();
// sortiranje oglasov po datumu
usort($ads, function($a, $b){
	return strtotime($b->date) - strtotime($a->date);
});

//delete
?>


<?php
// read more
foreach($ads as $ad){
	?>
	<div class="ad col-md-6 offset-md-3 text-center bg-light">
		<h4><?php echo $ad->title;?></h4>
		<p><?php echo $ad->description;?></p>
		<a href="ad.php?id=<?php echo $ad->id;?>"><button class="btn btn-primary">Read more</button></a>
	</div>
	<hr/>
	<?php
	global $conn;

	$query = $conn->query("SELECT * FROM images WHERE adid='$ad->id' ORDER BY id ASC LIMIT 1");
	
	if(1 > 0){
		while($rowNum = $query->fetch_assoc()){
			$imgUrl = 'images/'.$rowNum["file"];
		}
	
	?>
	<img style="display: block; margin: 0 auto;" class="border border-primary border-3" src="<?php echo $imgUrl; ?>" alt="" width="350"/>
	<?php
	}else{ ?>
		<p>No images.</p>
	<?php } ?>
	<br/>
	<p style="text-align: center">Views: <?php echo $ad->views;?>
	<br/>
	</div>
	<hr/>

	<?php
}


include_once('footer.php');
?>