<?php

class User {
    public $id;
    public $username;
    public $password;
    public $email;
    public $firstname;
    public $surname;
    public $address;
    public $post;
    public $phone;
    public $gender;
    public $birthday;
    public $isAdmin;

public function __construct($id, $username, $password, $email, $firstname, $surname, $address, $post, $phone, $gender, $birthday, $isAdmin){
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->surname = $surname;
    $this->address = $address;
    $this->post = $post;
    $this->phone = $phone;
    $this->gender = $gender;
    $this->birthday = $birthday;
}

public static function add($username,$password){
    $dataBase = Db::getInstance();
    $password = sha1($password);
    
    if($stmt = mysqli_prepare($dataBase, "INSERT INTO users(username, password) VALUES ('$username','$password')")){
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $id=mysqli_insert_id($dataBase);

    return User::find($id);
}

public static function edit($id,$firstname,$surname,$email,$address,$phone,$gender,$isAdmin){
    $id = intval($id);
    $dataBase = Db::getInstance();
    //$gender = substr($gender,0,0);
    $admin=intval($isAdmin);
    $res = mysqli_query($dataBase,"UPDATE users SET firesname='$firstname',surname='$surname',email='$email',address='$address',phone='$phone',gender='$gender',isAdmin='$admin' WHERE id='$id'");
    return User::find($id);
}

public static function delete($id){
    $id = intval($id);
    $dataBase = Db::getInstance();
    $res1 = mysqli_query($dataBase, "SELECT * FROM ads WHERE user_id=$id");
    
    while($row = mysqli_fetch_assoc($res1)){
        $adid = $row["id"];
        $res2 = mysqli_query($dataBase, "DELETE FROM images WHERE user_id=$id");
        $res3 = mysqli_query($dataBase, "DELETE FROM ad_category WHERE fk_ads=$adid");
        $res4 = mysqli_query($dataBase, "DELETE FROM ads WHERE user_id=$id");
    }

    $res5 = mysqli_query($dataBase, "DELETE FROM users WHERE id=$id");

    return $res5;
}

public static function deleteAll($id){
    $id = intval($id);
    $dataBase = Db::getInstance();
    $res = mysqli_query($dataBase, "DELETE FROM users WHERE id <> '$id'");
    return $res;
}

public static function all(){
    $arr = [];
    $dataBase = Db::getInstance();
    $res = mysqli_query($dataBase,"SELECT * FROM users");

    while($row = mysqli_fetch_assoc($res)){
        $arr[] = new User($row["id"],$row["username"],$row["password"],$row["email"],$row["firstname"],$row["surname"],$row["address"],$row["post"],$row["phone"],$row["gender"],$row["birthday"],$row["isAdmin"]);  
    }

    return $arr;
}

public static function find($id){
    $id = intval($id);
    $dataBase = DB::getInstance();
    $res = mysqli_query($dataBase,"SELECT * FROM users WHERE id=$id");
    $row = mysqli_fetch_assoc($res);

    return new User($row["id"],$row["username"],$row["password"],$row["email"],$row["firstname"],$row["surname"],$row["address"],$row["post"],$row["phone"],$row["gender"],$row["birthday"],$row["isAdmin"]);
}

}

?>