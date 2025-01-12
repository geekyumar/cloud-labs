<?php

class mongodb {

    public static function createUser($username, $password, $uid) {
        if (wg::vpnStatus() === true) {
            $env_cmd = get_config('env_cmd');
            $mongodb_username = get_config('mongodb_username');
            $mongodb_password = get_config('mongodb_password');
            
            $command = "mongosh --host mongodb -u $mongodb_username --password $mongodb_password --eval ";
            $command .= escapeshellarg("
                db.getSiblingDB('users').createUser({
                    user: '$username',
                    pwd: '$password',
                    roles: [{ role: 'dbOwner', db: 'test' }]
                });
            ");
    
            $output = system($command, $return_var);
    
            if ($return_var == 0) {
                    $timezone =  "SET @@session.time_zone = '+05:30'";
                    $add_user_sql = "INSERT INTO `mongodb_users` (`uid`, `username`, `mongodb_username`, `mongodb_password`, `time`)
                    VALUES ('1', 'umar', '$username', '$password', now())";
    
                    $conn = database::getConnection();
                    if($conn->query($timezone) and $conn->query($add_user_sql) == true){
                        return 'success';
                    }else{
                        return 'mysql_entry_failed';
                    }
                
            } else {
                return 'add_user_failed';
            }
        } else {
            return 'wireguard_failed';
        }
    }

    public static function deleteUser($username, $uid){
        if(wg::vpnStatus() == true){
            $conn = database::getConnection();
            $mongodb_user_details_query = "SELECT * FROM `mongodb_users` WHERE `mongodb_username` = '$username' AND `uid` = '$uid'";

            if($conn->query($mongodb_user_details_query)->num_rows == 1){
                $env_cmd = get_config('env_cmd');
                $mongodb_username = get_config('mongodb_username');
                $mongodb_password = get_config('mongodb_password');
                $delete_user_cmd = $env_cmd . "mongosh --host mongodb -u $mongodb_username --password $mongodb_password --eval " .  escapeshellarg("
                    db.getSiblingDB('users').dropUser('$username');
                ");
                system($delete_user_cmd, $return_var);

                if($return_var == 0){
                    $delete_user_sql = "DELETE FROM `mongodb_users` WHERE `username` = '$username' AND `uid` = '$uid'";
                    if($conn->query($delete_user_sql) == true){
                        return 'success';
                    }else{
                        return 'mysql_drop_failed';
                    }
                }else{
                    return 'delete_user_failed';
                }
            }
            else{
                return 'user_not_found';
            }
        }else{
            return 'wireguard_failed';
        }
    }

    public static function addDb($username, $db_name){
        if(wg::vpnStatus() == true){
            $conn = database::getConnection();
            $mongodb_user_details_query = "SELECT * FROM `mongodb_users` WHERE `username` = '$username'";

            if($conn->query($mongodb_user_details_query)->num_rows == 1){
                $env_cmd = get_config('env_cmd');
                $mongodb_username = get_config('mongodb_username');
                $mongodb_password = get_config('mongodb_password');
                $add_db_cmd = $env_cmd . "mongosh --host mongodb -u $mongodb_username --password $mongodb_password --eval " .  escapeshellarg("
                    db.getSiblingDB('users').grantRolesToUser('$username', [{ role: 'dbOwner', db: '$db_name' }]);
                ");
                system($add_db_cmd, $return_var);

                if($return_var == 0){
                    $timezone =  "SET @@session.time_zone = '+05:30'";
                    $add_db_sql = "INSERT INTO `mongodb_dbs` (`uid`, `username`, `mongodb_username`, `mongodb_dbname`, `time`)
                    VALUES ('1', 'umar', '$username', '$db_name', now())";
                    if($conn->query($timezone) and $conn->query($add_db_sql) == true){
                        return 'success';
                    }else{
                        return 'mysql_entry_failed';
                    }
                }else{
                    return 'failed';
                }
            }
            else{
                return 'user_not_found';
            }
        }else{
            return 'wireguard_failed';
        }
    }

    public static function deleteDb($username, $db_name){
        if(wg::vpnStatus() == true){
            $conn = database::getConnection();
            $mongodb_user_details_query = "SELECT * FROM `mongodb_users` WHERE `username` = '$username'";

            if($conn->query($mongodb_user_details_query)->num_rows == 1){
                $env_cmd = get_config('env_cmd');
                $mongodb_username = get_config('mongodb_username');
                $mongodb_password = get_config('mongodb_password');
                $delete_db_cmd = $env_cmd . "mongosh --host mongodb -u $mongodb_username --password $mongodb_password --eval " .  escapeshellarg("
                    db.getSiblingDB('users').revokeRolesFromUser('$username', [{ role: 'dbOwner', db: '$db_name' }]);
                ");
                system($delete_db_cmd, $return_var);

                if($return_var == 0){
                    $delete_db_sql = "DELETE FROM `mongodb_dbs` WHERE `mongodb_username` = '$username' AND `mongodb_dbname` = '$db_name'";
                    if($conn->query($delete_db_sql) == true){
                        return 'success';
                    }else{
                        return 'mysql_drop_failed';
                    }
                }else{
                    return 'failed';
                }
            }
            else{
                return 'user_not_found';
            }
        }else{
            return 'wireguard_failed';
        }
    }
}