<?php 
include_once('header.php');

//Funkcija izbere oglas s podanim ID-jem. Doda tudi uporabnika, ki je objavil oglas.
function get_ad($id){
	global $conn;
	$id = mysqli_real_escape_string($conn, $id);
	$query = "SELECT ads.*, users.username, users.email FROM ads LEFT JOIN users ON users.id = ads.user_id WHERE ads.id = $id;";
	$result = $conn->query($query);

	if($obj = $result->fetch_object()){
		if(!isset($_COOKIE["viewed" . $id])){
			setcookie("viewed" . $id, time()+604800);	
			$newviews = $obj->views + 1;
			$query = "UPDATE ads SET views='$newviews' WHERE id='$id'";
			$conn->query($query);			
		}	

		//return $obj;
	}		
	return $obj;
}

if(!isset($_GET["id"])){
	echo "Missing parameters.";
	die();
}

$id = $_GET["id"];
$ad = get_ad($id);

if($ad == null){
	echo "Ad does not exist.";
	die();
}

?>
<div class="ad col-md-6 offset-md-3 text-center bg-light">
	<h4><?php echo $ad->title;?></h4>
	<p><?php echo $ad->description;?></p>
	<?php
	global $conn;
		$query = $conn->query("SELECT * FROM images WHERE adid='$ad->id' ORDER BY id ASC");
		if(1 > 0){
			while($rowNum = $query->fetch_assoc()){
				$imgURL = 'images/'.$rowNum["file"];
		?>
			<img style="display: block; margin: 0 auto;" class="border border-primary border-3" src="<?php echo $imgURL; ?>" alt="" width="300" />
		<?php }
		}else{ ?>
			<p>No images.</p>
		<?php } ?> 
		<p>Catergories: <br/>
			<?php
		catsOutput($ad->id);
	?>
		<p>Uploaded by: <?php echo $ad->username;?></br>E-Mail: 
		<?php echo $ad->email;?></br>Ad displayed: <?php echo $ad->views;?> times.
		<br/>Uploaded: <?php echo $ad->date;?><br/>Date of expiration: 
		<?php echo $ad->expiration;?></p>
		<a href="index.php"><button class="btn btn-primary">Back</button></a>
	</div>
	<hr/>
</div>

<?php

function categoriesGet($id){
	global $conn;
	$id = mysqli_real_escape_string($conn, $id);
	$query = "SELECT categories.* FROM categories LEFT JOIN ad_category ON categories.id = ad_category.fk_categories LEFT JOIN ads ON ad_category.fk_ads = ads.id WHERE ads.id = $id;";
	$result = $conn->query($query);
	$categories = array();
	while($cat = $result->fetch_object()){
		array_push($categories,$cat);
	}
	return $categories;
}

function catsMultilevel(&$categories, $id){
	global $conn;
	$query = "SELECT categories.* FROM categories WHERE id='$id'";
	$result = $conn->query($query);
	while($cat = $result->fetch_object()){
		if($cat->parentid != null){
			catsMultilevel($categories,$cat->parentid);
		}
		$categories[]=$cat;
	}
}

function catsOutput($id){
	$category = array();
	$category = categoriesGet($id);
	$i = count($category);

	foreach($category as $cat){
		echo $cat->name . " ";
		catsMultilevel($category, $cat->id);
	}

	echo "<br/>";

	for($j=0; $j<$i; $j++){
		unset($category[$j]);
	}

	$i = count($category);
	$j = 0;

	foreach($category as $cat){
		//echo $cat->name;
		$temporary = next($category);
		
	}

}

include_once('footer.php');
?>