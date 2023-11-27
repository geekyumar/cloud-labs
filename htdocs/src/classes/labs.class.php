<?php

//TODO: ALL THE STATIC FUNCTIONS IN THIS CLASS MUST BE CHANGED TO NON-STATIC ONES. (22/11)

class labs{

    public $instance = null;

    public function __contruct($instance_id, $username){
        $conn = database::getConnection();
        $sql = "SELECT * FROM `labs` WHERE `instance_id` = '$instance_id' AND `username` = '$username' LIMIT 1";

        if($conn->query($sql)->num_rows == 1){
            $this->instance = $conn->query($sql)->fetch_assoc();
        }
        else{
            return false;
        }
    }

    public function isDeployed($instance_id, $username){
        $labs = new labs($instance_id, $usernamee);
        if($labs->instance){
            $env_cmd = get_config('env_cmd');
            $container_info = exec($env_cmd . "docker inspect $username", $output);
            if($labs->instance['container_status'] == 1 and $output == 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
        

        }

    public function isCreated($instance_id){
        $conn = database::getConnection();
        $sql = "SELECT * FROM `labs` WHERE `instance_id` = '$instance_id' LIMIT 1";

        if($conn->query($sql)->num_rows == 1){
            return true;
        }else{
            return false;
        }
    }

    public static function create($uid, $username, $instance_id){
        $conn = database::getConnection();
        $sql = "INSERT INTO `labs` (`uid`, `username`, `instance_id`, `container_status`)
        VALUES ('$uid', '$username', '$instance_id')";

        if($conn->query($sql) == true){
            return true;
        }
        else{
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