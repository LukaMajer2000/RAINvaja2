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

    function __construct($id=0,$user_id,$content,$nickname,$date,$email,$adid,$ip){
        $this->id=$id;
        $this->user_id=$user_id;
        $this->content=$content;
        $this->nickname=$nickname;
        $this->date=$date;
        $this->email=$email;
        $this->adid=$adid;
        $this->ip=$ip;
    }

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

    public function countryOfOrigin($ip){
        $chrl = curl_init();
        curl_setopt($chrl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($chrl,CURLOPT_URL,"http://ip-api.com/json/" . $ip);
        $res = curl_exec($chrl);
        curl_close($chrl);
        $res = json_decode($res,true);

        if($res["status"] != "fail"){
            return $res["country"];
        }else{
            return "";
        }
    }

    public function addComment($Db){
        $id=$this->id;
        $user_id=$this->user_id;
        $content=$this->content;
        $nickname=$this->nickname;
        $date=$this->date;
        $email=$this->email;
        $adid=$this->adid;
        $ip=$this->ip;

        if($user_id == ""){
            $user_id=-1;
        }

        $chrl = curl_init();
        curl_setopt($chrl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($chrl,CURLOPT_URL,"http://apilayer.net/api/check?access_key=3114b53a2bea85adf75141a5c895bea5&email=" . $ip);
        $res = curl_exec($chrl);
        curl_close($chrl);
        $res = json_decode($res,true);

        if($res["format_valid"]==true){
            $query="INSERT INTO comments(user_id,content,nickname,date,email,adid,id) VALUES ('$user_id','$content','$nickname','$date','$email','$adid','$id')";
            $res = mysqli_query($Db,$query);
            
            if(mysqli_error($Db)){
                var_dump(mysqli_error($Db));
                exit();
            }

            $this->id=mysqli_insert_id($Db);
        }else{
            var_dump($res);
            exit;
        }
    }

    public function deleteComment($Db,$id){
        $query="DELETE FROM comments WHERE id=$id";
        $res = mysqli_query($Db,$query);

        if(mysqli_error($Db)){
            var_dump(mysqli_error($Db));
            exit();
        }
    }

    public function loadAllComments($Db,$adid){
        $query="SELECT * FROM comments WHERE adid=$adid ORDER BY date DESC";
        $res = mysqli_query($Db,$query);

        if(mysqli_error($Db)){
            var_dump(mysqli_error($Db));
            exit();
        }

        $comments = array();

        while($row = mysqli_fetch_assoc($res)){
            $country = Comment::countryOfOrigin($row["ip"]);
            $comment =  new Comment($row["id"],$row["user_id"],$row["content"],$row["nickname"],$row["date"],$row["email"],$row["adid"],$country);
            $comments[]=$comment;
        }

        return $comments;
    }

    public function loadOneComment($Db, $id){
        $query="SELECT * FROM comments WHERE id='$id'";
        $res = mysqli_query($Db,$query);

        if(mysqli_error($Db)){
            var_dump(mysqli_error($Db));
            exit();
        }
        $row = mysqli_fetch_assoc($res);
        $country = Comment::countryOfOrigin($row["ip"]);
        $comment =  new Comment($row["id"],$row["user_id"],$row["content"],$row["nickname"],$row["date"],$row["email"],$row["adid"],$country);

        return $comment;
    }

    public function loadLastFiveComments($Db,$adid){
        $query="SELECT * FROM comments WHERE adid=$adid ORDER BY date DESC LIMIT 5";
        $res = mysqli_query($Db,$query);

        if(mysqli_error($Db)){
            var_dump(mysqli_error($Db));
            exit();
        }

        $comments = array();

        while($row = mysqli_fetch_assoc($res)){
            $country = Comment::countryOfOrigin($row["ip"]);
            $comment =  new Comment($row["id"],$row["user_id"],$row["content"],$row["nickname"],$row["date"],$row["email"],$row["adid"],$country);
            $comments[]=$comment;
        }

        return $comments;
    }
}
?>