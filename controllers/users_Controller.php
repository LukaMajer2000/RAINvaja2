<?php
class users_Controller{

    // Dodajanje
    public function add() {
        require_once("views/users/add.php");
    }
    
    // Brisanje
    public function delete() {
        if(!isset($_GET["id"])){
            return call("pages", "error");
            // Kliče se error, če pride do napake, return preskoči
        }
        User::delete($_GET["id"]);
        require_once("views/users/deleteSuccesfull.php");
    }

    // Uredi
    public function edit() {
        if(!isset($_GET["id"])){
            return call("pages", "error");
        }
        $user = User::find($_GET["id"]);
        require_once("views/users/edit.php");
    }

    // Potrdi urejanje
    public function editConfirm(){
        $user = User::edit($_POST["id"],$_POST["firstname"], $_POST["surname"], $_POST["email"], $_POST["address"], $_POST["phone"], $_POST["gender"], $_POST["isAdmin"]);
        require_once("views/users/editSuccessful.php");
    }

    // Shrani, preko POSt se pošljeta naslov in vsebina
    public function save() {
        $user=User::add($_POST["username"], $_POST["password"]);
        require_once("views/users/addSuccessful.php");
    }

    public function clean() {
        if(!isset($_GET["id"])){
            return call("pages","error");
        }
        User::deleteAll($_GET["id"]);
        require_once("views/users/deleteAll.php");
    }

    public function index() {
        $users = User::all();
        require_once("views/users/index.php");
    }

    public function display() {
        if(!isset($_GET["id"])){
            return call("pages","error");
        }
        $user = User::find($_GET["id"]);
        require_once("views/users/display.php");
    }

}
?>