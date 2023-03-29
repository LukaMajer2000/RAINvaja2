<?php

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