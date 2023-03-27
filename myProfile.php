<!-- 'vmesnik' med navadno stranjo in stranjo za admina, vse zahteve gredo preko te datoteke

<?php

require_once("connection.php");

if(isset($_GET["Controller"]) && isset($_GET["action"])){
    $Controller = $_GET["Controller"];
    $action = $_GET["action"];
}else{
    // napaka iz strani uporabnika
    $Controller = "pages";
    $action = "home";
}

// glavna stran za admin
require_once("views/layout.php");

?>