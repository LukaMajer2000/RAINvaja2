<?php

//kontroler za delo z oglasi

require_once "connection.php";
require_once "comment.php"; 

class comments_Controller{

    public function index($adid)
    {
        // Iz modela pidobimo vse oglase
        
        $comments = Comment::loadAllComments($adid);

        //izpišemo $ads v JSON formatu
        echo json_encode($comments);
    }

    public static function show($id)
    {
        $comments = Comment::findOneComment($id);
        echo json_encode($comments);
    }
    //$user_id,$content,$nickname,$date,$email,$adid,$ip
    public function store()
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $adid = $_POST["adid"];
        $user_id = $_SESSION["USER_ID"];
        /*$nickname = $_POST["nickname"];
        $date = $_POST["date"];
        $email = $_POST["email"];*/
        // Store se pokliče z POST, zato so podatki iz obrazca na voljo v $_POST
        $comment = Comment::addComment($user_id,$_POST["content"],$adid,$ip);/*$nickname,$date,$email,*/
        // Vrnemo vstavljen oglas
        echo json_encode($comment);
    }

    public function delete($id)
    {
        // Poiščemo in izbrišemo oglas
        $comments = Comment::findOneComment($id);
        $comments->deleteComment();
        // Vrnemo podatke iz izbrisanega oglasa
        echo json_encode($comments);
    }
}
<<<<<<< HEAD
=======
$Db=mysqli_connect("localhost", "root", "", "vaja1");
$Db->set_charset("UTF8");

class comments_Controller{
    public function refreshComments($Db){
        if(!isset($_GET["id"])){
            return call("pages","error");
        }
        $comment = new Comment(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        $comment->refreshComments($Db);
    }

    public function countryOfOrigin($ip){
        if(!isset($_GET["id"])){
            return call("pages","error");
        }
        $comment = new Comment(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        $comment->countryOfOrigin($_GET["ip"]);
    }

    public function addComment($Db){
        if(!isset($_GET["id"])){
            return call("pages","error");
        }
        $comment = new Comment(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        $comment->addComment($Db);
    }

    public function deleteComment($Db,$id){
        if(!isset($_GET["id"])){
            return call("pages","error");
        }
        $comment = new Comment(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        $comment->deleteComment($Db,$_GET["id"]);
    }

    public function loadAllComments($Db,$adid){
        if(!isset($_GET["id"])){
            return call("pages","error");
        }
        $comment = new Comment(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        $comment->loadAllComments($Db,$_GET["adid"]);
    }

    public function loadOneComment($Db, $id){
        if(!isset($_GET["id"])){
            return call("pages","error");
        }
        $comment = new Comment(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        $comment->loadOneComment($Db,$_GET["id"]);
    }

    public function loadLastFiveComments($Db,$adid){
        if(!isset($_GET["id"])){
            return call("pages","error");
        }
        $comment = new Comment(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        $comment->loadLastFiveComments($Db,$_GET["adid"]);
    }
}

?>
>>>>>>> 90c4629 (Pozabo commit)
=======
>>>>>>> 120217e (Problem z mergom)
