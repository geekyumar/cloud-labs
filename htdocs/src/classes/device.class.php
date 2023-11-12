<?php

class device{
    public static function add($uid, $username, $device_name, $device_type, $device_ip, $wg_pubkey)
    {
        $device_conf = "$'\n'[Peer]$'\n'#$username$'\n'PublicKey = $wg_pubkey$'\n'AllowedIPs = 172.19.0.0/16, $device_ip/32";
        $conf_location = get_config('wg-conf');
        $cmd = system("echo $device_conf >> $conf_location", $result);

        if($result === 0)
        {
            $conn = database::getConnection();
            
            $timezone =  "SET @@session.time_zone = '+05:30'";
            $sql = "INSERT INTO `devices` (`uid`, `username`, `device_name`, `device_type`, `device_ip`, `wg_pubkey`, `time`)
            VALUES ('$uid', '$username', '$device_name', '$device_type', '$device_ip', '$wg_pubkey', now())";

            if($conn->query($timezone) and $conn->query($sql) === true)
            {
                return true;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function generateIP(){
        $first = rand(0, 255);
        $second = rand(0, 255);

        $ip = "172.19.$first.$second";

        $conn = database::getConnection();
        $sql = "SELECT * FROM `devices` WHERE `device_ip` = '$ip'";
        $duplicate_check = $conn->query($sql)->num_rows;

        while($duplicate_check){
            $first = rand(0, 255);
            $second = rand(0, 255);

            $ip = "172.19.$first.$second";
            $sql = "SELECT * FROM `devices` WHERE `device_ip` = '$ip'";
            $duplicate_check = $conn->query($sql)->num_rows;
        }
        return $ip;
    }
}