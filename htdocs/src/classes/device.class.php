<?php

class device{
    public static function add($uid, $username, $device_name, $device_type, $private_ip, $wg_ip, $wg_pubkey)
    {
        $device_conf = "$'\n'[Peer]$'\n'#$username$'\n'PublicKey = $wg_pubkey$'\n'AllowedIPs = 172.19.0.0/16, $private_ip/32";
        $conf_location = get_config('wg-conf');

        $device_id = md5($private_ip . $wg_ip . $wg_pubkey);

        $conn = database::getConnection();
        
        $timezone =  "SET @@session.time_zone = '+05:30'";
        $sql = "INSERT INTO `devices` (`uid`, `username`, `device_name`, `device_id`, `device_type`, `private_ip`, `wg_ip`, `wg_pubkey`, `time`)
        VALUES ('$uid', '$username', '$device_name', '$device_id', '$device_type', '$private_ip', '$wg_ip', '$wg_pubkey', now())";

        if($conn->query($timezone) and $conn->query($sql) === true)
        {
            $cmd = system("echo $device_conf >> $conf_location", $result);
            if($result !== 0){
                $conn2 = database::getConnection();
                $delete_device = "DELETE FROM `devices` WHERE `private_ip` = '$private_ip'";
                $conn2->query($delete_device);
            }
            else{
                return true;
            }
        }
        else{
            return false;
        }
    }

    public static function delete($device_id){
        $conn = database::getConnection();
        $delete_query = "DELETE FROM `devices` WHERE `device_id` = '$device_id'";
        if($conn->query($delete_query) == true){
            return true;
        }
        else{
            return false;
        }
    }

    public static function generateWgIP(){
        $first = rand(0, 255);
        $second = rand(0, 255);

        $ip = "172.19.$first.$second";

        $conn = database::getConnection();
        $sql = "SELECT * FROM `devices` WHERE `wg_ip` = '$ip'";
        $duplicate_check = $conn->query($sql)->num_rows;

        while($duplicate_check){
            $first = rand(0, 255);
            $second = rand(0, 255);

            $ip = "172.19.$first.$second";
            $sql = "SELECT * FROM `devices` WHERE `wg_ip` = '$ip'";
            $duplicate_check = $conn->query($sql)->num_rows;
        }
        return $ip;
    }

    public static function generatePrivateIP(){
        $first = rand(0, 255);
        $second = rand(0, 255);

        $ip = "167.48.$first.$second";

        $conn = database::getConnection();
        $sql = "SELECT * FROM `devices` WHERE `private_ip` = '$ip'";
        $duplicate_check = $conn->query($sql)->num_rows;

        while($duplicate_check){
            $first = rand(0, 255);
            $second = rand(0, 255);

            $ip = "172.19.$first.$second";
            $sql = "SELECT * FROM `devices` WHERE `private_ip` = '$ip'";
            $duplicate_check = $conn->query($sql)->num_rows;
        }
        return $ip;
    }
}