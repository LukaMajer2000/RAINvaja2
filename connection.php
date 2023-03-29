<?php
//session_start();

if(isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] < 1800){
  session_regenerate_id(true);
}
$_SESSION['LAST_ACTIVITY'] = time();

class Db
{
  private static $instance = NULL;
  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      self::$instance = mysqli_connect("localhost", "root", "", "vaja1");
    }
    return self::$instance;
  }
}
