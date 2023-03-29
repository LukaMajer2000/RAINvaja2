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

    public function addComment($user_id,$content,$nickname,$date,$email,$adid,$ip){
        $Db = Db::getInstance();
        $content = mysqli_real_escape_string($Db, $content);
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

        if($Db->$query($query)){
            $id = mysqli_real_escape_string($Db, $content);
            return Comment::findOneComment($id);
        }else{
            return false;
        }
    }

    public function deleteComment(){
        $Db = Db::getInstance();
        $id = mysqli_real_escape_string($Db, $this->id);
        $query="SELECT * FROM comments WHERE id='$id'";

        if($Db->$query($query)){
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

    public function loadAllComments($adid){
        $Db = Db::getInstance();
        $query="SELECT * FROM comments WHERE comments.adid = '$adid'";
        $res = $Db->query($query);

        $comments = array();

        while($comment = $res->fetch_object()){
            return new Comment($comment->id,$comment->user_id,$comment->content,$comment->nickname,$comment->date,$comment->email,$comment->adid,$comment->ip);
        }

        return $comments;
    }

    public function findOneComment($id){
        $Db = Db::getInstance();
        $id = mysqli_real_escape_string($Db, $this->id);
        $query="SELECT * FROM comments WHERE comments.id = '$id'";
        $res = $Db->query($query);

        if($comment = $res->fetch_object()){
            return new Comment($comment->id,$comment->user_id,$comment->content,$comment->nickname,$comment->date,$comment->email,$comment->adid,$comment->ip);
        }

        return null;
    }

}
?>