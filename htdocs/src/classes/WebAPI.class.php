<?php

class WebAPI
{
    public function __construct()
    {
        session::start();
    }

    public function validateSession($token){
        try{
            session::$usersession = usersession::validate_session($token);
        }
        catch(Exception $e)
        {
            die("User Auth Failed!");
        }

        if(session::$usersession){
            return true;
        }
        else{
            // usersession::destroy($token);
            session::destroy();
        }
    }
}