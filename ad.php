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

<div class="comment col-md-6 offset-md-3 text-center bg-light">	

<?php if (isset($_SESSION["USER_ID"])): ?>
	<h4>Add a comment:</h4>
	<input type="text" name="content" id="commentContent"/>
	<button id="createComment">Add comment!</button>
<?php endif; ?>

<h5>Comments:</h5>
<table class="table table-bordered text-center">
	<thead>
		<tr>
			<th>Contents:</th>
			<th>Delete:</th>
			<th>IP Address:</th>
		</tr>
	</thead>
	<tbody id="commentsBody">
	</tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
	
	$(document).ready(async function (){
		console.log("Prepare the createComment and commentsBody");
		await load();
		$("#createComment").click(createsComment);
		$("#commentsBody").on("click",".deleteComment", deleteCLick);
	});


	async function load(){
		console.log("Load the comments.");
		await $.get("/api.php/comments?id=<?php echo $id; ?>", printComments);
		console.log("Load the comments.");
	}

	function getIP(ip){
		return new Promise((resolve) => {
			if(ip === "::1"){
				resolve("localhost");
			}else{
				$.getJSON(`http://ip-api.com/json/${ip}`, function (data) {
					if(data.status === "success"){
						resolve(data.country);
					}else{
						resolve("Unknown");
					}
				});
			}
		});
		console.log("Get the IPs.");
	}

	function createsComment(){
		const content = $("#commentContent").val();
		if (!content) {
			alert("Please enter a comment.");
			return;
		}
		var data = {
			content: $("#commentContent").val(),
			adid: '<?php echo $id; ?>',
			user_id: '<?php if(isset($_SESSION["USER_ID"])){ echo $_SESSION["USER_ID"];} else {echo "";}?>'
		}
		$("#commentContent").val("");
		$.post("api.php/comments/<?php echo $id; ?>", data, function(data){
			var row = document.createElement("tr");
			row.id = data.id;
			row.innerHTML = "<td>" + data.content + "</td>";
			row.innerHTML += "<td><button class='deleteComment'>Delete</button></td>";
			$(".deleteComment",row).click(deleteCLick);
			$("#commentsBody").append(row);
		});
		console.log("Comment created!");
	}

	function printComments(comments){
		var adID = '<?php echo $ad->user_id; ?>';
		var userID = '<?php if(isset($_SESSION["USER_ID"])){ echo $_SESSION["USER_ID"];} else {echo "";}?>';

		comments.forEach(function (comment){
			var row = document.createElement("tr");
			row.id = comment.id;
			row.innerHTML = "<td>" + comment.content + "</td>";

			getIP(comment.ip).then(function (country){
				row.innerHTML += "<td>" + country + "</td>";
			});

			if(comment.user_id === userID || adID === userID){
				row.innerHTML += "<td><button class='deleteComment'>Delete</button></td>";
			}else{
				row.innerHTML += "<td></td>";
			}
			$("#commentsBody").append(row);
		});
		console.log("Comments printed.");
	}

	function commentDelete(row){
		const commentId = $(this).closest("tr").attr("id");
  		if (!confirm("Are you sure you want to delete this comment?")) {
    		return;
		}	
		var id = row.attr("id");
		$.ajax({
			url: 'api.php/comments/' + id,
			method: 'DELETE'
		});
		console.log("Comment deleted!");
	}

	function deleteCLick(){
		var row = $(this).closest("tr");
		commentDelete(row);
		row.remove();
	}
</script>

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