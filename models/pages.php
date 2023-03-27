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

public static function find($id){
    $id = intval($id);
    $dataBase = Db::getInstance();
    $res = mysqli_query($dataBase,"SELECT * FROM users WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    $res2 = mysqli_query($dataBase,"SELECT COUNT(*) FROM ads WHERE id=$id");
    $row2 = mysqli_fetch_assoc($res2);
    
    if(is_null($row) || is_null($row)){
        return new User("Empty","Empty","Empty","Empty","Empty","Empty","Empty","Empty","Empty","Empty","Empty","Empty");
    }

    return new User($row["id"],$row["username"],$row["password"],$row["email"],$row["firstname"],$row["surname"],$row["address"],$row["post"],$row["phone"],$row["gender"],$row["birthday"],$row["isAdmin"]);

}

}

?>