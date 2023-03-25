<!DOCTYPE html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <script src="js/bootstrap.bundle.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>
<body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<h1>BootlegEbay Admin Page</h1>
	<div>
		<nav>
			<a href="myProfile.php">Profile control:</a>
			<button type="button" data-toggle="collapse">
				<span></span>
			</button>
			<div>
				<ul>
					<li class="nav-item <?php if($Controller!="ads") echo("active");?>"><a class="nav-link" gref="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" gref="myAd.php">My ADs</a></li>
					<li class="nav-item"><a class="nav-link" gref="upload.php">Upload AD</a></li>
				</ul>

		<ul>
			<?php
				$conn = new mysqli("localhost", "root", "", "vaja2");
				$conn->set_charset("UTF8");
				$id = $_SESSION["USER_ID"];
				$res = mysqli_query($conn,"SELECT * FROM users where id='$id'");
				if($row["isAdmin"!=null]){
					?>
						<li><a href="?Controller=users&action=index"><i class="fas fa-user"></i>Admin Page</a></li>
					<?php
				}
				?>
					<li><a href="logOut.php"><i class="fas fa-sign-int-alt"></i>Log Out</a></li>
				<?php
			?>
		</ul>
		</div>
		</nav>


		<div>
			<div>
				<br>
					<?php require_once("routes.php");?>
			</div>
		</div>
	</div>
	<?php
	include_once('footer.php');
	?>
</body>
</html>