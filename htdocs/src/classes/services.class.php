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
                $delete_user_cmd = exec($env_cmd . "docker exec mysql mysql -u root -p$mysql_root_password -e 'DROP USER '$mysql_username'@'%';'", $out, $return_var);

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

    public static function addDb($mysql_username, $mysql_dbname, $collation, $uid, $username){
        if(wg::vpnStatus() == true){
            $conn = database::getConnection();
            $mysql_user_details_query = "SELECT * FROM `mysql_users` WHERE `mysql_username` = '$mysql_username' AND `username` = '$username'";

            if($conn->query($mysql_user_details_query)->num_rows == 1){
                $env_cmd = get_config('env_cmd');
                $mysql_root_password = get_config('mysql_root_password');
                $add_db_cmd = $env_cmd . "docker exec mysql mysql -u root -p$mysql_root_password -e " . escapeshellarg("CREATE DATABASE $mysql_dbname COLLATE $collation; GRANT ALL PRIVILEGES ON $mysql_dbname.* TO '$mysql_username'@'%'; FLUSH PRIVILEGES;");
                system($add_db_cmd, $return_var);
                if($return_var == 0){
                    $add_db_sql = "INSERT INTO `mysql_dbs` (`uid`, `username`, `mysql_username`, `mysql_dbname`, `time`)
                    VALUES ('$uid', '$username', '$mysql_username', '$mysql_dbname', now())";
                    if($conn->query($add_db_sql) == true){
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

    public static function deleteDb($mysql_username, $mysql_dbname, $username){
        if(wg::vpnStatus() == true){
            $conn = database::getConnection();
            $mysql_user_details_query = "SELECT * FROM `mysql_users` WHERE `mysql_username` = '$mysql_username' AND `username` = '$username'";

            if($conn->query($mysql_user_details_query)->num_rows == 1){
                $env_cmd = get_config('env_cmd');
                $mysql_root_password = get_config('mysql_root_password');
                $delete_db_cmd = exec($env_cmd . "docker exec mysql mysql -u root -p$mysql_root_password -e 'DROP DATABASE IF EXISTS $nysql_dbname;'", $out, $return_var);

                if($return_var == 0){
                    $delete_db_sql = "DELETE FROM `mysql_dbs` WHERE `mysql_dbname` = '$mysql_dbname' AND `username` = '$username'";
                    if($conn->query($delete_db_sql) == true){
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