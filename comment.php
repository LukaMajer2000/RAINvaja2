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
<<<<<<< HEAD
        $query="INSERT INTO comments(user_id,content,nickname,date,email,adid,ip) VALUES ('$user_id','$content','$nickname','$date','$email','$adid','$ip')";
<<<<<<< HEAD
=======
    public function refreshComments($Db){
        $id=$this->id;
        $user_id=$this->user_id;
        $content=$this->content;
        $nickname=$this->nickname;
        $date=$this->date;
        $adid=$this->adid;
        $query="UPDATE comments SET user_id='$user_id',content='$content',nickname='$nickname',date='$date',adid='$adid' WHERE id=$id;";
        $res = mysqli_query($Db,$query);
        
        if(mysqli_error($Db)){
            var_dump(mysqli_error($Db));
            exit();
        }
    }
>>>>>>> 90c4629 (Pozabo commit)
=======
>>>>>>> 120217e (Problem z mergom)
=======
        $query="INSERT INTO comments(user_id,content,adid,ip) VALUES ('$user_id','$content','$adid','$ip');";/*'$nickname','$date','$email',*//*,nickname,date,email*/
>>>>>>> f71341c (Končana naloga 2 za predmet RAIN)

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
<<<<<<< HEAD
<<<<<<< HEAD
=======
        $row = mysqli_fetch_assoc($res);
        $country = Comment::countryOfOrigin($row["ip"]);
        $comment =  new Comment($row["id"],$row["user_id"],$row["content"],$row["nickname"],$row["date"],$row["email"],$row["adid"],$country);

        return $comment;
>>>>>>> 90c4629 (Pozabo commit)
=======
>>>>>>> 120217e (Problem z mergom)
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