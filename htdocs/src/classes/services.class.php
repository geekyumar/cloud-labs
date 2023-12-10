<?php


class mysql{

    public static function addUser($mysql_username, $mysql_password, $uid, $username){
        if(wg::vpnStatus() == true){
            $env_cmd = get_config('env_cmd');
            $mysql_root_password = get_config('mysql_root_password');
            $add_user_cmd = exec($env_cmd . "docker exec mysql mysql -u root -p$mysql_root_password -e 'CREATE USER '$mysql_username'@'%' IDENTIFIED BY '$mysql_password';'", $out, $return_var);

            if($return_var == 0){
                $timezone =  "SET @@session.time_zone = '+05:30'";
                $add_user_sql = "INSERT INTO `mysql_users` (`uid`, `username`, `mysql_username`, `mysql_password`, `time`)
                VALUES ('$uid', '$username', '$mysql_username', '$mysql_password', now())";

                $conn = database::getConnection();
                if($conn->query($timezone) and $conn->query($add_user_sql) == true){
                    return true;
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

    public static function deleteUser($mysql_username, $username){
        if(wg::vpnStatus() == true){
            $conn = database::getConnection();
            $mysql_user_details_query = "SELECT * FROM `mysql_users` WHERE `mysql_username` = '$mysql_username' AND `username` = '$username'";

            if($conn->query($mysql_user_details_query)->num_rows == 1){
                $env_cmd = get_config('env_cmd');
                $mysql_root_password = get_config('mysql_root_password');
                $add_user_cmd = exec($env_cmd . "docker exec mysql mysql -u root -p$mysql_root_password -e 'DROP USER '$mysql_username'@'%';'", $out, $return_var);

                if($return_var == 0){
                    $delete_user_sql = "DELETE FROM `mysql_users` WHERE `mysql_username` = '$mysql_username' AND `username` = '$username'";
                    if($conn->query($delete_user_sql) == true){
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


    

}