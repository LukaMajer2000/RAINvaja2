<?php
include_once('header.php');

// Funkcija vstavi nov oglas v bazo. Preveri tudi, ali so podatki pravilno izpolnjeni. 
// Vrne false, če je prišlo do napake oz. true, če je oglas bil uspešno vstavljen.
function publish($cat, $title, $desc, $image){
	global $conn;
	$title = mysqli_real_escape_string($conn, $title);
	$desc = mysqli_real_escape_string($conn, $desc);
	$user_id = $_SESSION["USER_ID"];

	$date = date('Y-m-d H:i:s');
	$expiration = date('Y-m-d H:i:s',strtotime('+1 month',strtotime($date)));
	
	$query = "INSERT INTO ads (title, description, user_id, date, views, expiration)
				VALUES('$title', '$desc', '$user_id', '$date', 0, '$expiration');";
	$conn->query($query);
	$idad = $conn->insert_id;

	echo $idad;
	?> <br/> <?php

	foreach ($cat as $i){
		$query = "SELECT id FROM categories WHERE name='$i'";
		$res = $conn->query($query);
		$obj = $res->fetch_object();
		$idcat = $obj->id;
		?> <br/> <?php
		echo $idcat;
		$query = "INSERT INTO ad_category (fk_ads, fk_categories) VALUES('$idad','$idcat')";
		$conn->query($query);
	}

	$uploadFolder = 'images/'; //uploads
    foreach ($_FILES['image']['tmp_name'] as $key => $image) {
        $imageTmpName = $_FILES['image']['tmp_name'][$key];
        $imageName = $_FILES['image']['name'][$key];
        $result = move_uploaded_file($imageTmpName,$uploadFolder.$imageName);

        $query = "INSERT INTO images (file,adid) VALUES ('$imageName','$idad')";
        $run = $conn->query($query);
    }


	return true;
}

$error = "";
if(isset($_POST["submit"])){ 
	if(publish( $_POST["category"], $_POST["title"], $_POST["description"], $_FILES["image"])){
		header("Location: index.php");
		die();
	}
	else{
		$error = "Error with uploading ad!";
	}
}

function categoriesOutput($id, $level){
	global $conn;
	$query = "SELECT id, name, parentid FROM categories where parentid='$id'";
	$result = $conn->query($query);
	foreach($result as $i){
		$margin = ($level*10) . "px";
		echo "<option style='margin-left:$margin;' value='$i[name]'>$i[name]</option>";
		categoriesOutput($i['id'],$level+1);
	}
}

?>
<div class="container w-75 bg-light">
	<h2>Upload ad:</h2>
	<form action="upload.php" method="POST" enctype="multipart/form-data">
		<label>Title</label><input class="form-control" type="text" name="title" /> <br/>
		<label>Category</label> 
		<select class="form-control" style="width:200px;height:100px;" name="category[]" multiple>
			<?php
				global $conn;
				$query = "SELECT id, name, parentid FROM categories WHERE parentid='0' ORDER BY id ASC";
				$result = $conn->query($query);
				foreach ($result as $i) {
					echo "<option style='font-weight: bold;' value='$i[name]'>$i[name]</option>";
					categoriesOutput($i['id'],1);
				}
			?>
		</select><br/>
		<label>Content</label><br/><textarea class="form-control" name="description" rows="10" cols="50"></textarea> <br/>
		<label>Image</label><input class="form-control" type="file" name="image[]" multiple/> <br/>
		<label>Date to </label><?php echo date("Y-d-m h:i:s a")?> <br/>
		<input type="submit" name="submit" value="Send" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
			</div>
<?php



include_once('footer.php');
?>