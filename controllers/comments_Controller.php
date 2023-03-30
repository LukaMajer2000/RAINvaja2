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
