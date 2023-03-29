<?php
class Comment{
    public $id;
    public $user_id;
    public $content;
    public $nickname;
    public $date;
    public $email;
    public $adid;
    public $ip;

    function __construct($id,$user_id,$content,$nickname,$date,$email,$adid,$ip){
        $this->id=$id;
        $this->user_id=$user_id;
        $this->content=$content;
        $this->nickname=$nickname;
        $this->date=$date;
        $this->email=$email;
        $this->adid=$adid;
        $this->ip=$ip;
    }

    public static function addComment($user_id,$content,$nickname,$date,$email,$adid,$ip){
        $Db = Db::getInstance();
        $content = mysqli_real_escape_string($Db, $content);
        $query="INSERT INTO comments(user_id,content,nickname,date,email,adid,ip) VALUES ('$user_id','$content','$nickname','$date','$email','$adid','$ip')";

        if($Db->$query($query)){
            $id = mysqli_real_escape_string($Db, $content);
            return Comment::findOneComment($id);
        }else{
            return false;
        }
    }

    public static function deleteComment(){
        $Db = Db::getInstance();
        $id = mysqli_real_escape_string($Db, $_GET["id"]);
        $query="SELECT * FROM comments WHERE id='$id'";

        if($Db->$query($query)){
            return true;
        }else{
            return false;
        }
    }

    public static function loadAllComments($adid){
        $Db = Db::getInstance();
        $query="SELECT * FROM comments WHERE comments.adid = '$adid'";
        $res = $Db->query($query);

        $comments = array();

        while($comment = $res->fetch_object()){
            return new Comment($comment->id,$comment->user_id,$comment->content,$comment->nickname,$comment->date,$comment->email,$comment->adid,$comment->ip);
        }

        return $comments;
    }

    public static function findOneComment($id){
        $Db = Db::getInstance();
        $id = mysqli_real_escape_string($Db, $_GET["id"]);
        $query="SELECT * FROM comments WHERE comments.id = '$id'";
        $res = $Db->query($query);

        if($comment = $res->fetch_object()){
            return new Comment($comment->id,$comment->user_id,$comment->content,$comment->nickname,$comment->date,$comment->email,$comment->adid,$comment->ip);
        }

        return null;
    }

}
?>