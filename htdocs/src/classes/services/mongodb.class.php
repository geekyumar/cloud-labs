<?php

class mongodb {

    public static function createUser($username, $password, $uid) {
        if (wg::vpnStatus() === true) {
            $env_cmd = get_config('env_cmd');
            $mongodb_username = get_config('mongodb_username');
            $mongodb_password = get_config('mongodb_password');
            
            $command = "mongosh --host mongodb -u $mongodb_username --password $mongodb_password --eval ";
            $command .= escapeshellarg("use users; db.createUser({ user: '$username', pwd: '$password', roles: [{ role: 'dbOwner', db: 'test' }] })");
    
            $full_command = $env_cmd . " " . $command;
    
            $output = system($full_command, $return_var);
    
            if ($return_var == 0) {
                return 'success';
            } else {
                return 'failed';
            }
        } else {
            return 'wireguard_failed';
        }
    }
}