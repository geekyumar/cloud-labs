<?php

class device{
    public static function add($uid, $username, $device_name, $device_type, $private_ip, $wg_ip, $wg_pubkey)
    {
        $conn = database::getConnection();
        $uid = session::getUserId();
        $devices_count = "SELECT * FROM `devices` WHERE `uid` = '$uid'";
        if($conn->query($devices_count)->num_rows >= 5){
            return 'device_limit_exceeded';
        }

        $curl = new curl();
        $curl->setHttpParams('http://wireguard/api/devices/add', ['wg_ip' => $wg_ip, 'wg_pubkey' => $wg_pubkey]);
        $response = $curl->responseData();
        
        if($response['response_code'] == 200 and $response['data']['response'] == 'success'){

            $device_id = md5($private_ip . $wg_ip . $wg_pubkey);
            $conn = database::getConnection();

            $timezone =  "SET @@session.time_zone = '+05:30'";
            $sql = "INSERT INTO `devices` (`uid`, `username`, `device_name`, `device_id`, `device_type`, `private_ip`, `wg_ip`, `wg_pubkey`, `time`)
            VALUES ('$uid', '$username', '$device_name', '$device_id', '$device_type', '$private_ip', '$wg_ip', '$wg_pubkey', now())";

            if($conn->query($timezone) and $conn->query($sql) === true){
                return 'success';
            }else{
                $curl->setHttpParams('http://wireguard/api/devices/delete', ['wg_pubkey' => $wg_pubkey]);
                $response = $curl->responseData();
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
                $curl = new curl();
                $curl->setHttpParams('http://wireguard/api/devices/delete', ['wg_pubkey' => $wg_pubkey]);
                $response = $curl->responseData();
                
                if($response['response_code'] == 200 and $response['data']['response'] == 'success'){
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
    
            if (!is_resource($process)) {
                die('Failed to execute wg genkey command');
            }
    
            fclose($pipes[0]);
            $privateKey = trim(stream_get_contents($pipes[1]));  // Trim newline characters
            fclose($pipes[1]);
    
            // Close the process
            proc_close($process);
    
            return $privateKey;
        }
    
        public static function generatePublicKey($privateKey) {
            $descriptorspec = [
                0 => ["pipe", "r"],  // stdin
                1 => ["pipe", "w"],  // stdout
                2 => ["pipe", "w"]   // stderr
            ];
    
            $process = proc_open('wg pubkey', $descriptorspec, $pipes);
    
            if (!is_resource($process)) {
                die('Failed to execute wg pubkey command');
            }
    
            fwrite($pipes[0], $privateKey);
            fclose($pipes[0]);
    
            $publicKey = trim(stream_get_contents($pipes[1]));  // Trim newline characters
            fclose($pipes[1]);
    
            // Close the process
            proc_close($process);
    
            return $publicKey;
        }

        public static function isActive($ip){
            $curl = new curl();
            $curl->setHttpParams('http://wireguard/api/devices/status', ['wg_ip' => $ip]);
            $response = $curl->responseData();
            if($response['data']['response'] == 'online'){
                return 'Online';
            } else {
                return 'Offline';
            }
        }
    


}