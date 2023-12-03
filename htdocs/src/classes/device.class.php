<?php

class device{
    public static function add($uid, $username, $device_name, $device_type, $private_ip, $wg_ip, $wg_pubkey)
    {
        $env_cmd = get_config('env_cmd');

        $add_conf = system($env_cmd . "docker exec wireguard wg set wg0 peer $wg_pubkey allowed-ips 172.19.0.0/16,$wg_ip/32", $result);
        
        if($result == 0){
            $update_conf = system($env_cmd . "docker exec wireguard wg-quick save wg0");

            $device_id = md5($private_ip . $wg_ip . $wg_pubkey);
            $conn = database::getConnection();

            $timezone =  "SET @@session.time_zone = '+05:30'";
            $sql = "INSERT INTO `devices` (`uid`, `username`, `device_name`, `device_id`, `device_type`, `private_ip`, `wg_ip`, `wg_pubkey`, `time`)
            VALUES ('$uid', '$username', '$device_name', '$device_id', '$device_type', '$private_ip', '$wg_ip', '$wg_pubkey', now())";

            if($conn->query($timezone) and $conn->query($sql) === true){
                return true;
            }else{
                $add_conf = system($env_cmd . "docker exec wireguard wg set wg0 peer $wg_pubkey remove");
                $update_conf = system($env_cmd . "docker exec wireguard wg-quick save wg0");
            }
        }else{
            return false;
        }
        
    }

    public static function delete($device_id, $username){

        $conn = database::getConnection();
        $sql = "SELECT * FROM `devices` WHERE `device_id` = '$device_id'";

        if($conn->query($sql)->num_rows == 1){
            $row = $conn->query($sql)->fetch_assoc();
            $device_username = $row['username'];
            $wg_pubkey = $row['wg_pubkey'];

            if($device_username == $username){
                $env_cmd = get_config('env_cmd');
                $add_conf = system($env_cmd . "docker exec wireguard wg set wg0 peer $wg_pubkey remove", $result);

                if($result == 0){
                    $update_conf = system($env_cmd . "docker exec wireguard wg-quick save wg0");
                    $conn = database::getConnection();
                    $delete_query = "DELETE FROM `devices` WHERE `device_id` = '$device_id'";
                    if($conn->query($delete_query) == true){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
            else{
                return false;
            }
        }else{
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

    public static function generatePrivateKey() {
        $descriptorspec = [
            0 => ["pipe", "r"],  // stdin
            1 => ["pipe", "w"],  // stdout
            2 => ["pipe", "w"]   // stderr
        ];

        $process = proc_open('wg genkey', $descriptorspec, $pipes);

        if (is_resource($process)) {
            fclose($pipes[0]);
            $privateKey = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            // Close the process
            proc_close($process);

            return $privateKey;
        } else {
            die('Failed to execute wg genkey command');
        }
    }

    public static function generatePublicKey($privateKey) {
        $descriptorspec = [
            0 => ["pipe", "r"],  // stdin
            1 => ["pipe", "w"],  // stdout
            2 => ["pipe", "w"]   // stderr
        ];

        $process = proc_open('wg pubkey', $descriptorspec, $pipes);

        if (is_resource($process)) {
            fwrite($pipes[0], $privateKey);
            fclose($pipes[0]);

            $publicKey = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            // Close the process
            proc_close($process);

            return $publicKey;
        } else {
            die('Failed to execute wg pubkey command');
        }
    }


}