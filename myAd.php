<?php
include_once('header.php');

// branje oglasov iz baze
if(isset($_POST["deleteID"])){
    global $conn;
    $adID = $_POST["deleteID"];
    $id = $_SESSION["USER_ID"];
    $query = "DELETE FROM ads WHERE id='$adID'";
    $conn->query($query);
}


$ads = getAds();
usort($ads, function($a, $b){
	return strtotime($b->date) - strtotime($a->date);
});

// branje oglasov in pisanje v polje
function getAds(){
    global $conn;
    $id = $_SESSION["USER_ID"];
    $query = "SELECT * FROM ads WHERE user_id='$id'";
 
    $result = $conn->query($query);

    $ads = array();

    while($ad = $result->fetch_object()){
        if(!isset($_POST["expired"])){
            if(strtotime($ad->expiration) > time()){
                array_push($ads, $ad);
            }
        }else{
            array_push($ads,$ad);
        }
    }
    return $ads;
}

foreach($ads as $ad){
    ?>
    <div class="ad container w-50 bg-light col-md-6 offset-md-3 text-center">
        <h4><?php echo $ad->title;?></h4>
        <?php
        echo $ad->description;?><br/><?php
        global $conn;
        $query = $conn->query("SELECT * FROM images WHERE adid='$ad->id' ORDER BY id ASC LIMIT 1");
        if(1 > 0){
            while($rowNum = $query->fetch_assoc()){
                $imgUrl = 'images/'.$rowNum["file"];
            }
        
        ?>
        <img src="<?php echo $imgUrl; ?>" alt="" width="250"/>
        <?php
        }else{ ?>
            <p>No images.</p>
        <?php } ?>
        <p>Ad ID: <?php echo $ad->id;?><br/>
        Date of posting: <?php echo $ad->date;?>
        Date of expiration: <?php echo $ad->expiration;?></p>
    </div>
    <hr/>
    <?php
}

?>
<div class="container w-25 bg-light">
    <h2>Functions:</h2>
    <form action="editAd.php" method="POST">
        <label>Edit ad with ID: </label><input class="form-control" type="text" name="editID">
		<input class="form-control w-25 mx-auto" type="submit" name="edit" value="Edit" /> <br/>
	</form>
    <form action="myAd.php" method="POST">
        <label>Delete ad with ID: </label><input class="form-control" type="text" name="deleteID">
		<input class="form-control w-25 mx-auto" type="submit" name="delete" value="Delete" /> <br/>
	</form>
    <hr/>
</div>
<?php

include_once("footer.php");
?>