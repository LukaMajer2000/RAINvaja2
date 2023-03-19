<?php
include_once('header.php');

function publish($title, $desc){ //$img
	global $conn;

	$title = mysqli_real_escape_string($conn, $title);
	$desc = mysqli_real_escape_string($conn, $desc);
	//$img_file = file_get_contents($img["tmp_name"]);
	//$img_file = mysqli_real_escape_string($conn, $img_file);
    $date = date('Y-m-d H:i:s');
	$expiration = date('Y-m-d H:i:s',strtotime('+1 month',strtotime($date)));
    $id = $_SESSION['editID'];

    $query = "UPDATE ads SET title='$title', description='$desc', expiration='$expiration' WHERE id='$id'";
	
    $conn->query($query);
}

$error = "";
if(isset($_POST["send"])){
	publish($_POST["title"], $_POST["description"]); //$_FILES["image"]
    $_SESSION['editID']=null;
    header("Location: myAd.php");
	die();
}

if(isset($_POST["editID"])){
    $_SESSION['editID'] = $_POST["editID"];
    global $conn;
    $adID = $_SESSION['editID'];
    $id = $_SESSION["USER_ID"];
	$query = "SELECT * FROM ads WHERE id='$adID'";
	$res = $conn->query($query);
	$oglas = $res->fetch_object();
}

?>
<div class="col-md-6 offset-md-3 text-center bg-light">
	<h2>Edit ad</h2>
	<form action="editAd.php" method="POST" enctype="multipart/form-data">
		<label>Title</label><input class="form-control" type="text" name="title" /> <br/>
		<label>Content</label><textarea class="form-control" name="description" rows="10" cols="50"></textarea> <br/>
		<!--<label>Image</label><input class="form-control" type="file" name="image" /> <br/>-->
		<input class="btn btn-primary" type="submit" name="send" value="Upload" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
</div>
<?php

include_once('footer.php');
?>