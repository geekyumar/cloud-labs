<?php

class database
{
    public static $conn = null;

    public static function getConnection()
    {
        $servername = get_config('servername');
        $username = get_config('username');
        $password = get_config('password');
        $dbname = get_config('dbname');

        try{
            $connection = new mysqli($servername, $username, $password, $dbname);
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        
        if($connection == true)
        {
            self::$conn = $connection;
            return self::$conn;
        }
        else{
            return self::$conn;
        }
    }
}