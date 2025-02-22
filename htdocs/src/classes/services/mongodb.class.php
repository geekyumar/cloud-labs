<?php

class mongodb {

    public static function createUser($mongodb_username, $mongodb_password) {
        if (wg::vpnStatus() === true) {
            $uid = session::getUserId();
            $username = session::getUsername();

            $conn = database::getConnection();
            $mongodb_user_details_query = "SELECT * FROM `mongodb_users` WHERE `mongodb_username` = '$mongodb_username' AND `uid` = '$uid'";
            if($conn->query($mongodb_user_details_query)->num_rows == 0){

                $conn = database::getConnection();
                $mongodb_usercount = "SELECT * FROM `mongodb_users` WHERE `uid` = '$uid'";
                if($conn->query($mongodb_usercount)->num_rows >= 5){
                    return 'user_limit_exceeded';
                }

                $env_cmd = get_config('env_cmd');
                $mongodb_server_username = get_config('mongodb_username');
                $mongodb_server_password = get_config('mongodb_password');
                
                $command = "mongosh --host mongodb -u $mongodb_server_username --password $mongodb_server_password --eval ";
                $command .= escapeshellarg("
                    db.getSiblingDB('users').createUser({
                        user: '$mongodb_username',
                        pwd: '$mongodb_password',
                        roles: [{ role: 'dbOwner', db: 'test' }]
                    });
                ");
        
                exec($command, $output, $return_var);
        
                if ($return_var == 0) {
                    $timezone =  "SET @@session.time_zone = '+05:30'";
                    $add_user_sql = "INSERT INTO `mongodb_users` (`uid`, `username`, `mongodb_username`, `mongodb_password`, `time`)
                    VALUES ('$uid', '$username', '$mongodb_username', '$mongodb_password', now())";

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
                return 'username_already_exists';
            }
        } else {
            return 'wireguard_failed';
        }
    }

    public static function deleteUser($mongodb_username){
        if(wg::vpnStatus() == true){
            $uid = session::getUserId();
            $username = session::getUsername();
            $conn = database::getConnection();
            $mongodb_user_details_query = "SELECT * FROM `mongodb_users` WHERE `mongodb_username` = '$mongodb_username' AND `uid` = '$uid'";

            if($conn->query($mongodb_user_details_query)->num_rows == 1){
                $env_cmd = get_config('env_cmd');
                $mongodb_server_username = get_config('mongodb_username');
                $mongodb_server_password = get_config('mongodb_password');
                $delete_user_cmd = $env_cmd . "mongosh --host mongodb -u $mongodb_server_username --password $mongodb_server_password --eval " .  escapeshellarg("
                    db.getSiblingDB('users').dropUser('$mongodb_username');
                ");
                exec($delete_user_cmd, $output, $return_var);

                if($return_var == 0){
                    $delete_user_sql = "DELETE FROM `mongodb_users` WHERE `mongodb_username` = '$mongodb_username' AND `uid` = '$uid'";
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

    public static function addDb($mongodb_username, $mongodb_dbname){
        if(wg::vpnStatus() == true){
            $uid = session::getUserId();
            $username = session::getUsername();

            $conn = database::getConnection();
            $mongodb_user_details_query = "SELECT * FROM `mongodb_users` WHERE `mongodb_username` = '$mongodb_username' AND `uid` = '$uid'";

            if($conn->query($mongodb_user_details_query)->num_rows == 1){
                $env_cmd = get_config('env_cmd');
                $mongodb_server_username = get_config('mongodb_username');
                $mongodb_server_password = get_config('mongodb_password');
                $dbname = $mongodb_username . '_' . $mongodb_dbname;
                $add_db_cmd = $env_cmd . "mongosh --host mongodb -u $mongodb_server_username --password $mongodb_server_password --eval " .  escapeshellarg("
                    db.getSiblingDB('users').grantRolesToUser('$mongodb_username', [{ role: 'dbOwner', db: '$dbname' }]);
                ");
                exec($add_db_cmd, $output, $return_var);

                if($return_var == 0){
                    $timezone =  "SET @@session.time_zone = '+05:30'";
                    $add_db_sql = "INSERT INTO `mongodb_dbs` (`uid`, `username`, `mongodb_username`, `mongodb_dbname`, `time`)
                    VALUES ('$uid', '$username', '$mongodb_username', '$dbname', now())";
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

    public static function deleteDb($mongodb_dbname){
        if(wg::vpnStatus() == true){
            $uid = session::getUserId();
            $username = session::getUsername();

            $conn = database::getConnection();
            $mongodb_user_details_query = "SELECT * FROM `mongodb_dbs` WHERE `mongodb_dbname` = '$mongodb_dbname' AND `uid` = '$uid'";
            $result = $conn->query($mongodb_user_details_query);
            if($result->num_rows == 1){
                $mongodb_username = $result->fetch_assoc()['mongodb_username'];
                $env_cmd = get_config('env_cmd');
                $mongodb_server_username = get_config('mongodb_username');
                $mongodb_server_password = get_config('mongodb_password');
                $delete_db_cmd = $env_cmd . "mongosh --host mongodb -u $mongodb_server_username --password $mongodb_server_password --eval " .  escapeshellarg("
                    db.getSiblingDB('users').revokeRolesFromUser('$mongodb_username', [{ role: 'dbOwner', db: '$mongodb_dbname' }]);
                ");
                exec($delete_db_cmd, $output, $return_var);

                if($return_var == 0){
                    $delete_db_sql = "DELETE FROM `mongodb_dbs` WHERE `mongodb_dbname` = '$mongodb_dbname' AND `uid` = '$uid'";
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
                return 'db_not_found';
            }
        }else{
            return 'wireguard_failed';
        }
    }

    public static function fetchDb($mongodb_username){
        if(wg::vpnStatus() == true){
            $uid = session::getUserId();
            $db_array = [];
            $conn = database::getConnection();
            $mongodb_db_details_query = "SELECT `mongodb_dbname` FROM `mongodb_dbs` WHERE `mongodb_username` = '$mongodb_username' AND `uid` = '$uid'";

            if($conn->query($mongodb_db_details_query)->num_rows){
                $result = $conn->query($mongodb_db_details_query);
                    while ($row = $result->fetch_assoc()) {
                        $db_array[] = $row['mongodb_dbname'];
                    }
                    return $db_array;
            }else{
                return false;
            }
        }
    }
}