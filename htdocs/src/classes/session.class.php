<?php

class session
{
    public static $user = null;
    public static $usersession = null;
    
    public static function start()
    {
        session_start();
    }


    public static function unset_all()
    {
        session_unset();
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public static function isset($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function get($key)
    {
        if (session::isset($key)) {
            return($_SESSION[$key]); 
        } else {
            return false;
        }
    }

    public static function renderPage()
    {
        include $_SERVER['DOCUMENT_ROOT'].'/view/__master.php';
    }

    public static function loadTemplate($name)
    {
        include $_SERVER['DOCUMENT_ROOT']."/view/__templates/_$name.php";
    }

    public static function loadComponent($name)
    {
        include $_SERVER['DOCUMENT_ROOT']."/view/__components/_$name.php";
    }

    public static function currentPath()
    {
        return basename($_SERVER['SCRIPT_NAME'], '.php');
    }

    public static function isAuthenticated(){
        if(is_object(self::$usersession) and is_object(self::$user)){
            return true;
        }
        else{
            return false;
        }
    }

    public static function getUsername()
    {
        if(self::isAuthenticated()){
            return self::$user->data['username'];
        }
        else{
            return false;
        }
    }

    public static function getName()
    {
        if(self::isAuthenticated()){
            return self::$user->data['name'];
        }
        else{
            return false;
        }
    }

    public static function getUserId()
    {
        if(self::isAuthenticated()){
            return self::$user->data['id'];
        }
        else{
            return false;
        }
    }
}

 