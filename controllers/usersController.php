<?php
class userController{

    // Dodajanje
    public function add() {
        require_once("views/users/add.php");
    }
    
    // Brisanje
    public function delete() {
        if(!isset($_GET["id"])){
            return call("save", "error");
            // Kliče se error, če pride do napake, return preskoči
        }
        User::delete($_GET["id"]);
        require_once("views/users/deleteSuccesfull.php");
    }

    // Uredi
    public function edit() {
        if(!isset($_GET["id"])){
            return call("save", "error");
        }
        $user = User::find($_GET["id"]);
        require_once("views/users/editSuccessful.php");
    }

    public function editConfirm(){
        $user=User::edit($_POST["id"],$_POST["firstname"],$_POST["surname"],$_POST["email"],$_POST["post"],$_POST["address"],$_POST["phone"],$_POST["gender"],$_POST["birthday"]);
    }

    public function save() {

    }

    public function clean() {

    }

    public function index() {

    }

    public function display() {
    
    }

}
?>