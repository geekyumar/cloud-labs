<?php

class database
{
    public static $conn = null;

    public static function getConnection()
    {
        $servername = 'localhost';
        $username = 'root';
        $password = 'umar1234';
        $dbname = 'mysql';

        try{
            $connection = new mysqli($servername, $username, $password, $dbname);
        }
        catch(Exception $e)
        {
            throw new Exception("Connection to MySQL failed");
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