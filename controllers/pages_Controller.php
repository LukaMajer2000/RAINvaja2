<?php
class pages_controller {
  public function error() {
    // Izpiše pogled s sporočilom o napaki
    require_once('views/pages/error.php');
  }

  public function home(){
    if(!isset($_GET["id"])){
      if(isset($_SESSION["USER_ID"])){
          $user = User::find($_SESSION["USER_ID"]);
          $_GET["id"] = $_SESSION["USER_ID"];
          require_once("views/pages/home.php");
      }else{
        require_once("views/pages/error.php");
      }
    }else{
      $id = $_GET["id"];
      $user = User::find("id");
      require_once("views/pages/home.php");
    }
  }
}
?>