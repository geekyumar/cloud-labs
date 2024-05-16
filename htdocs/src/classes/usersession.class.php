<?php


class usersession
{
    public $data;
    public static function authenticate($user, $pass, $fingerprint){
        if(user::login($user, $pass)){ 

        $conn = database::getConnection();

        $sql1 = "SELECT * FROM `users` WHERE `username` = '$user' OR `email` = '$user' LIMIT 1";
        $result = $conn->query($sql1);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $uid = $row['id'];
            $username = $row['username'];

            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5(rand(0, 9999999). $agent. $ip . time());

            $conn = database::getConnection();
            $sql2 = "INSERT INTO `sessions` (`uid` ,`username`, `session_token`, `login_time`, `ip`, `fingerprint`, `user_agent`, `active`)
            VALUES ('$uid', '$username', '$token', now(), '$ip', '$fingerprint', '$agent', '1')";
            if ($conn->query($sql2)) {
                session::set('session_token', $token);
                session::set('session_username', $user);
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }else{
        return false;
    }
    }


    public static function authorize ($token, $fingerprint){
        $session = new usersession($token);
        $host_ip = $_SERVER['REMOTE_ADDR'];
        $host_useragent = $_SERVER['HTTP_USER_AGENT'];

        if($session->data['ip'] == $host_ip and $session->data['user_agent'] == $host_useragent and $session->data['fingerprint'] == $fingerprint){
            return true;
        } else {
            return false;
        }
    }

    public static function validate_session($token){
        $session = new usersession($token);
        $host_ip = $_SERVER['REMOTE_ADDR'];
        $host_useragent = $_SERVER['HTTP_USER_AGENT'];

        if($session->data['ip'] == $host_ip and $session->data['user_agent'] == $host_useragent){
            session::$user = $session->getUser();
            return $session;
        }
        else{
            return false;
        }
    }

public function __construct($token){
    $conn = database::getConnection();
    $sql = "SELECT * FROM `sessions` WHERE `session_token`= '$token' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $this->data = $row;
        return $this->data;
    } else {
        return false;
    }
}

public function isValid(){
    if (isset($this->data['login_time'])) {
        $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['login_time']);
        if (3600 > time() - $login_time->getTimestamp()) {
            return true;
        } else {
            return false;
        }
    } else {
        throw new Exception("login tiem is null");
    }
}

public function getIP($token){
    if(!$this->conn)
    {
        $this->conn = database::getConnection();
    }
    $sql = "SELECT `ip` FROM `sessions` WHERE `session_token` = '$token'";
    
    $result = $this->conn->query($sql);
    if ($result->num_rows) {
        $row = $result->fetch_assoc();
        return $this->ip = $row['ip'];
    } else {
        return false;
    }
}

public static function getUserAgent($token){
    $conn = database::getConnection();
    $sql = "SELECT `user_agent` FROM `sessions` WHERE `session_token` = '$token'";
    if ($conn->query($sql)->num_rows == 1) {
        return $conn->query($sql)->fetch_assoc()['user_agent'];
    } else {
        return false;
    }
}

public function getUser(){
    return new user($this->data['uid']);
}

public static function destroy($token){ 
    if(session::isAuthenticated()){
        $conn = database::getConnection();
        $sql = "DELETE FROM `sessions` WHERE `session_token` = '$token'";
        try {
            $result = $conn->query($sql);
            session::destroy();
            return true;
        }
        catch(Exception $e){
        return false;
        }
    } else {
        return false;
    }
    
}

public static function validateSessionOwner($session_token){
    $conn = database::getConnection();
    $sql = "SELECT `ip` FROM `sessions` WHERE `session_token` = '$session_token'";
    try{
        if($conn->query($sql)->num_rows == 1){
            $session_ip = $conn->query($sql)->fetch_assoc()['ip'];
            if($_SERVER['REMOTE_ADDR'] == $session_ip and $_SERVER['HTTP_USER_AGENT'] == self::getUserAgent(session::get('session_token'))){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    catch(Exception $e){
    return false;
    }
}

public static function invalidate($token){
    if(!$this->conn)
    {
           $this->conn = database::getConnection();
    }
    $sql = "DELETE FROM `sessions` WHERE `session_token` = '$token'";
    $result = $this->conn->query($sql);
    if($result)
    {
        print "Session invalidated. Please Login again." . session_destroy();
    }
}



public static function printserver()
{
    print_r ($_SERVER);
}

public static function printsession()
{
    print_r($_SESSION);
}
}

