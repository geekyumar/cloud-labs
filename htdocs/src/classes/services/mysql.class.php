<?php


class mysql{

    public static function addUser($mysql_username, $mysql_password, $uid, $username){
        if(wg::vpnStatus() == true){
            $env_cmd = get_config('env_cmd');
            $mysql_root_password = get_config('mysql_root_password');

            $conn = database::getConnection();
            $uid = session::getUserId();
            $mysql_usercount = "SELECT * FROM `mysql_users` WHERE `uid` = '$uid'";
            if($conn->query($mysql_usercount)->num_rows >= 5){
                return 'user_limit_exceeded';
            }


            $add_user_cmd = $env_cmd . "mysql -h mysql mysql -u root -p$mysql_root_password -e " . escapeshellarg("CREATE USER '$mysql_username'@'%' IDENTIFIED BY '$mysql_password';");
            system($add_user_cmd, $return_var);

            if($return_var == 0){
                $timezone =  "SET @@session.time_zone = '+05:30'";
                $add_user_sql = "INSERT INTO `mysql_users` (`uid`, `username`, `mysql_username`, `mysql_password`, `time`)
                VALUES ('$uid', '$username', '$mysql_username', '$mysql_password', now())";

                $conn = database::getConnection();
                if($conn->query($timezone) and $conn->query($add_user_sql) == true){
                    return 'success';
                }else{
                    return 'mysql_entry_failed';
                }
            }else{
                return 'create_user_failed';
            }
        }else{
            return 'wireguard_failed';
        }
    }

    public static function deleteUser($mysql_username, $username){
        if(wg::vpnStatus() == true){
            $conn = database::getConnection();
            $mysql_user_details_query = "SELECT * FROM `mysql_users` WHERE `mysql_username` = '$mysql_username' AND `username` = '$username'";

            if($conn->query($mysql_user_details_query)->num_rows == 1){
                $env_cmd = get_config('env_cmd');
                $mysql_root_password = get_config('mysql_root_password');
                $delete_user_cmd = $env_cmd . "mysql -h mysql mysql -u root -p$mysql_root_password -e " .  escapeshellarg("DROP USER '$mysql_username'@'%';");
                system($delete_user_cmd, $return_var);

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
                $mysql_dbname = $mysql_username . '_' . $mysql_dbname;
                $add_db_cmd = $env_cmd . "mysql -h mysql mysql -u root -p$mysql_root_password -e " . escapeshellarg("CREATE DATABASE $mysql_dbname COLLATE $collation; GRANT ALL PRIVILEGES ON $mysql_dbname.* TO '$mysql_username'@'%'; FLUSH PRIVILEGES;");
                system($add_db_cmd, $return_var);

                if($return_var == 0){
                    $timezone =  "SET @@session.time_zone = '+05:30'";
                    $add_db_sql = "INSERT INTO `mysql_dbs` (`uid`, `username`, `mysql_username`, `mysql_dbname`, `time`)
                    VALUES ('$uid', '$username', '$mysql_username', '$mysql_dbname', now())";
                    if($conn->query($timezone) and $conn->query($add_db_sql) == true){
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

    public static function deleteDb($mysql_dbname, $username){
        if(wg::vpnStatus() == true){
            $conn = database::getConnection();
            $mysql_db_details_query = "SELECT * FROM `mysql_dbs` WHERE `mysql_dbname` = '$mysql_dbname' AND `username` = '$username'";

            if($conn->query($mysql_db_details_query)->num_rows == 1){
                $env_cmd = get_config('env_cmd');
                $mysql_root_password = get_config('mysql_root_password');
                $delete_db_cmd = $env_cmd . "mysql -h mysql mysql -u root -p$mysql_root_password -e " . escapeshellarg("DROP DATABASE IF EXISTS $mysql_dbname;");
                system($delete_db_cmd, $return_var);

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


    public static function fetchDb($mysql_username, $username){
        if(wg::vpnStatus() == true){
            $db_array = [];
            $conn = database::getConnection();
            $mysql_db_details_query = "SELECT `mysql_dbname` FROM `mysql_dbs` WHERE `mysql_username` = '$mysql_username' AND `username` = '$username'";

            if($conn->query($mysql_db_details_query)->num_rows){
                $result = $conn->query($mysql_db_details_query);
                    while ($row = $result->fetch_assoc()) {
                        $db_array[] = $row['mysql_dbname'];
                    }
                    return $db_array;
            }else{
                return false;
            }
        }
    }

    public static function backup(){
        if(wg::vpnStatus() == true){
            $env_cmd = get_config('env_cmd');
            $app_root = get_config('app_root');
            $mysql_root_password = get_config('mysql_root_password');
            $backup_dir = "$app_root/workspace/backup/mysql-service/";
    
            if(!is_dir($backup_dir)){
                mkdir($backup_dir, 0777, true);
            }
    
            $backup_cmd = $env_cmd . "mysqldump -h mysql -u root -p$mysql_root_password --all-databases > $backup_dir/mysql-service-backup.sql";
            system($backup_cmd, $return_var);
    
            if($return_var == 0){
                date_default_timezone_set('Asia/Kolkata');
                $date = date('Y-m-d H:i:s A'); 
                $last_backup = system("echo Last mysql-service backup: $date > $backup_dir/last_backup.txt", $return_var);
                if($return_var == 0){
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

}