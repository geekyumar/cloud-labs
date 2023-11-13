<?php

class WebAPI
{
    public function __construct()
    {
        session::start();
    }

    public static function validateSession($token){
        try{
            session::$usersession = usersession::validate_session($token);
        }
        catch(Exception $e)
        {
            die("Exception error!");
        }
    }
}