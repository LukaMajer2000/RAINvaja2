<?php
	session_start();
	
    require_once "connection.php";

	//Seja poteče po 30 minutah - avtomatsko odjavi neaktivnega uporabnika
	if(isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] < 1800){
		session_regenerate_id(true);
	}
	$_SESSION['LAST_ACTIVITY'] = time();
	
	//Poveži se z bazo
	$conn = new mysqli('localhost', 'root', '', 'vaja1');
	//Nastavi kodiranje znakov, ki se uporablja pri komunikaciji z bazo
	$conn->set_charset("UTF8");
?>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <script src="js/bootstrap.bundle.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>AntiEbay</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<div style="text-align: center;">    
<h1>AntiEbay Store</h1>
    <nav>
        <ul>
        <button class="btn btn-primary text-white bg-light"><a href="index.php">Home</a></button>
            <?php
            if(isset($_SESSION["USER_ID"])){
                ?>
                <button class="btn btn-primary text-white bg-light"><a href="upload.php">Upload AD</a></button>
                <button class="btn btn-primary text-white bg-light"><a href="myAd.php">Your ADs</a></button>
                <button class="btn btn-primary text-white bg-light"><a href="myProfile.php">Your Profle</a></button>
                <button class="btn btn-primary text-white bg-light"><a href="logOut.php">Log Out</a></button>
                <?php
            }else{
                ?>
                <button class="btn btn-primary text-white bg-light"><a href="logIn.php">Log In</a></button>
                <button class="btn btn-primary text-white bg-light"><a href="registration.php">Register</a></button>
                <?php
            }
            ?>
        </ul>
    </nav>
</div>
    </body>
</html>