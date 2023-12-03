<?php

class labs{

    public $instance;

    public function __construct($instance_id, $username){
        $conn = database::getConnection();
        $sql = "SELECT * FROM `labs` WHERE `instance_id` = '$instance_id' LIMIT 1";

        if($conn->query($sql)->num_rows == 1){
            $row = $conn->query($sql)->fetch_assoc();
            $instance_username = $row['username'];
            if($instance_username == $username){
                $this->instance = $row;
            }else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function isDeployed($username){
        if($this->instance){
            $env_cmd = get_config('env_cmd');
            $container_info = exec($env_cmd . "docker inspect -f '{{.State.Running}}' $username", $output, $result);
            if($this->instance['container_status'] == 1 and $output[0] == 'true'){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
        

        }

    public static function isCreated($username){
        $conn = database::getConnection();
        $sql = "SELECT * FROM `labs` WHERE `username` = '$username' LIMIT 1";

        if($conn->query($sql)->num_rows == 1){
            return true;
        }else{
            return false;
        }
    }

    public static function getInstanceId($username){
        $conn = database::getConnection();
        $sql = "SELECT * FROM `labs` WHERE `username` = '$username' LIMIT 1";

        if($conn->query($sql)->num_rows == 1){
            $row = $conn->query($sql)->fetch_assoc();
            return $row['instance_id'];
        }
        else{
            return false;
        }
    }

    public static function create($uid, $username, $private_ip, $wg_ip){
        if(!self::isCreated($username)){
            $wg_privkey = device::generatePrivateKey();
            $wg_pubkey = device::generatePublicKey($wg_privkey);
            $instance_id = md5($username . $private_ip . $wg_ip . $wg_privkey);

            $labs_storage_dir = get_config('labs_storage');
            $labs_storage_permission = get_config('labs_storage_permission');

            if(!is_dir($labs_storage_dir . $username)){
                mkdir($labs_storage_dir . $username . '/wireguard_conf', $labs_storage_permission, true);
                // TODO: change the configuration below.
                $wg_config = "$'\n'[Peer]$'\n'#$username$'\n'PublicKey = $wg_pubkey$'\n'AllowedIPs = 172.19.0.0/16, $private_ip/32";
                $write_conf = file_put_contents($labs_storage_dir . $username . '/wg_config/wg0.conf', $wg_config);
                if($write_conf){
                    $conn = database::getConnection();
                    $timezone =  "SET @@session.time_zone = '+05:30'";
                    $sql = "INSERT INTO `labs` (`uid`, `username`, `instance_id`, `private_ip`, `wg_ip`, `wg_pubkey`, `container_status`, `time`)
                    VALUES ('$uid', '$username', '$instance_id', '$private_ip', '$wg_ip', '$wg_pubkey', 0, now())";
        
                    if($conn->query($timezone) and $conn->query($sql) == true){
                        return true;
                    }
                    else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }

    //TODO: the below code must be corrected in the future. (22/11)

    public function deploy($instance_id, $username){
        $labs = new labs($instance_id, $username);

        if($labs->instance){
            // set all the variables required for deploying the instance (eg: IP, container name, volume etc.)
            $env_cmd = get_config('env_cmd');

            // complete the above docker run command by filling the required params.
            $deploy = system("$env_cmd docker run ", $output);

            // then update deployed status into database
            $sql = "UPDATE `labs` SET
            `container_status` = 1 
            WHERE `instance_id` = '$instance_id' AND `username` = '$username'";

            if($output == 0){
                if($conn->query($sql) == true){
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
    }

    public function stop($instance_id, $username){
        $labs = new labs($instance_id, $username);

        if($labs->instance){
            // set all the variables required for stopping the instance (eg: IP, container name etc.)
            $env_cmd = get_config('env_cmd');

            // complete the above docker remove command by filling the required params.
            $deploy = system("$env_cmd docker remove --force ", $output);

            // then update stopped status into database
            $sql = "UPDATE `labs` SET
            `container_status` = 0
            WHERE `instance_id` = '$instance_id' AND `username` = '$username'";

            if($output == 0){
                if($conn->query($sql) == true){
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
    }

    public function redeploy($instance_id, $username){
        if(self::isDeployed($instance_id, $username)){
            if(self::stop($instance_id, $username)){
                $labs = new labs($instance_id, $username);

                if($labs->instance){
                    
                    // set all the variables required for redeploying the instance (eg: IP, container name, volume etc.)
                    $env_cmd = get_config('env_cmd');
        
                    // complete the above docker run command by filling the required params.
                    $deploy = system("$env_cmd docker run ", $output);
        
                    // then update redeployed status into database
                    $sql = "UPDATE `labs` SET
                    `container_status` = 1 
                    WHERE `instance_id` = '$instance_id' AND `username` = '$username'";
        
                    if($output == 0){
                        if($conn->query($sql) == true){
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
            }
            else{
                return false;
            }
        }
    else{
        return false;
    }
       
    }
}