<?php
class Comment{
    public $id;
    public $user_id;
    public $content;
    /*public $nickname;
    public $date;
    public $email;*/
    public $adid;
    public $ip;

    function __construct($id,$user_id,$content,$adid,$ip){/*,$nickname,$date,$email*/
        $this->id=$id;
        $this->user_id=$user_id;
        $this->content=$content;
        /*$this->nickname=$nickname;
        $this->date=$date;
        $this->email=$email;*/
        $this->adid=$adid;
        $this->ip=$ip;
    }

    public static function addComment($user_id,$content,$adid,$ip){/*$nickname,$date,$email,*/
        $Db = Db::getInstance();
        $content = mysqli_real_escape_string($Db, $content);
        $query="INSERT INTO comments(user_id,content,adid,ip) VALUES ('$user_id','$content','$adid','$ip');";/*'$nickname','$date','$email',*//*,nickname,date,email*/

        if($Db->query($query)){
            $id = mysqli_insert_id($Db);
            return Comment::findOneComment($id);
        }else{
            return false;
        }
    }

    public function deleteComment(){
        $Db = Db::getInstance();
        $id = mysqli_real_escape_string($Db, $this->id);
        $query="DELETE FROM comments WHERE id='$id'";

        if($Db->query($query)){
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
            array_push($comments, new Comment($comment->id,$comment->user_id,$comment->content,$comment->adid,$comment->ip));
        }

        return $comments;
    }

    public static function findOneComment($id){
        $Db = Db::getInstance();
        $id = mysqli_real_escape_string($Db, $id);
        $query="SELECT * FROM comments WHERE comments.id = '$id'";
        $res = $Db->query($query);

        if($comment = $res->fetch_object()){
            return new Comment($comment->id,$comment->user_id,$comment->content,$comment->adid,$comment->ip);
        }

        return null;
    }

}
?>