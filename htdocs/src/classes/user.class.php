<?php

class user{

    public $data;
    public static function signup($name, $username, $email, $phone, $pass)
    {
        $password = password_hash($pass, PASSWORD_BCRYPT);
        
        $conn = database::getConnection();

        $sql1 = "SET @@session.time_zone = '+05:30'";

        $sql2 = "INSERT INTO `users` (`name`,`username`, `email`,`phone`, `date_joined`)
        VALUES ('$name','$username', '$email', '$phone', now())";

        if ($conn->query($sql1) and $conn->query($sql2) == true) {

           $uid_query = "SELECT * FROM `users` WHERE `username` = '$username' LIMIT 1";
           $result = $conn->query($uid_query);
           if($result->num_rows == 1)
           {
            $row = $result->fetch_assoc();
            $uid = $row['id'];

            $sql3 = "INSERT INTO `login` (`uid`,`username`, `email`,`password`, `date_joined`)
            VALUES ('$uid','$username', '$email', '$password', now())";

            if($conn->query($sql3) === true)
            {
                return true;
            }
           }
           else{
            return false;
           }
        } 
    else 
    {
    return false;
    }

 }

    public static function login($username, $password)
    {
        $conn = database::getConnection();

        $sql = "SELECT * FROM `login` WHERE `username` = '$username' OR `email` = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $pass_verify = password_verify($password, $row['password']);
            if ($pass_verify === true) {
                return true;
            } else {
                return false;
            }

        } else {

            return false;

        }

    }

    public function __construct($id)
    {
        $conn = database::getConnection();
        $query = "SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            return $this->data = $row;
        } else {
            die("Invalid username");
        }
    }

    public static function isUser($username){
        $conn = database::getConnection();
        $user_check = "SELECT * FROM `users` WHERE `username` = '$username'";

        if($conn->query($user_check)->num_rows == 1){
            return true;
        }else{
            return false;
        }
    }



}