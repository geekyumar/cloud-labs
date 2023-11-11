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
}