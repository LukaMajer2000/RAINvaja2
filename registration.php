<?php
include_once('header.php');

// Funkcija preveri, ali v bazi obstaja uporabnik z določenim imenom in vrne true, če obstaja.
function username_exists($username){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$query = "SELECT * FROM users WHERE username='$username'";
	$res = $conn->query($query);
	return mysqli_num_rows($res) > 0;
}

// Funkcija ustvari uporabnika v tabeli users. Poskrbi tudi za ustrezno šifriranje uporabniškega gesla.
function register_user($username, $password, $email, $firstname, $surname, $address, $post, $phone, $gender, $birthday){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$pass = sha1($password);
	$query = "INSERT INTO users (username, password, email, firstname, surname, address, post, phone, gender, birthday) VALUES ('$username', '$pass', '$email', '$firstname', '$surname', '$address', '$post', '$phone', '$gender', '$birthday');";
	if($conn->query($query)){
		return true;
	}
	else{
		echo mysqli_error($conn);
		return false;
	}
}

$error = "";
if(isset($_POST["submit"])){
	//Preveri če se gesli ujemata
	if(validate($_POST["username"], $_POST["password"], $_POST["repeat_password"], $_POST["email"], $_POST["firstname"], $_POST["surname"])){
		if($_POST["password"] != $_POST["repeat_password"]){
			$error = "Passwords are not matching.";
		}
		//Preveri ali uporabniško ime obstaja
		else if(username_exists($_POST["username"])){
			$error = "Username taken.";
		}
		//Podatki so pravilno izpolnjeni, registriraj uporabnika
		else if(register_user($_POST["username"], $_POST["password"], $_POST["email"], $_POST["firstname"], $_POST["surname"], $_POST["address"], $_POST["post"], $_POST["phone"], $_POST["gender"], $_POST["birthday"])){
			header("Location: logIn.php");
			die();
		}
		//Prišlo je do napake pri registraciji
		else{
			$error = "Registration error.";
		}
	} else {
		$error = "Username, password, email, name and surname are all necessery.";
	}
}

?>
<div class="col-md-6 offset-md-3 text-center bg-light">
	<h2>Registracija</h2>
	<form action="registration.php" method="POST">
	<label>Username:</label><input class="form-control" type="text" name="username" /> <br/>
		<label>Password:</label><input class="form-control" type="password" name="password" /> <br/>
		<label>Password again:</label><input class="form-control" type="password" name="repeat_password" /> <br/>
		<label>E-mail:</label><input class="form-control" type="text" name="email" /> <br/>
		<label>Name:</label><input class="form-control" type="text" name="firstname" /> <br/>
		<label>Surname:</label><input class="form-control" type="text" name="surname" /> <br/>
		<br>
		<label>Address:</label><input class="form-control" type="text" name="address" /> <br/>
		<label>Post:</label><input class="form-control" type="text" name="post" /> <br/>
		<label>Phone:</label><input class="form-control" type="text" name="phone" /> <br/>
		<label>Gender: </label> <label>M</label><input type="radio" name="gender" value="M" checked="checked"/> <label>F</label><input type="radio" name="gender" value="F"/> <br/>
		<label>Date of birth:</label><input class="form-control" type="date" name="birthday" /> <br/>
		<input class="form-control" type="submit" name="submit" value="Send" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
</div>
<?php

function validate($username, $password, $repeatpassword, $email, $firstname, $lastname){
	if($username!=null && $password!=null && $repeatpassword!=null && $email!=null && $firstname!=null && $lastname!=null){
		return true;
	} else {
		return false;
	}
}

include_once('footer.php');
?>