<?php

class database
{
    public static $conn = null;

    public static function getConnection()
    {
        if (self::$conn !== null) {
            return self::$conn;
        }

        $servername = get_config('servername');
        $username = get_config('username');
        $password = get_config('password');
        $dbname = get_config('dbname');

        try {
            $connection = new mysqli($servername, $username, $password, $dbname);
            
            if ($connection->connect_error) {
                throw new Exception("Connection failed: " . $connection->connect_error);
            }

            $connection->query("SET time_zone = '+05:30'");
            $connection->set_charset("utf8mb4");

            self::$conn = $connection;
            return self::$conn;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}