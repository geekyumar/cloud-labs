<?php

function get_config($key, $default = null)
{
    $db_cred = file_get_contents('/var/www/labs/workspace/config.json');
    $db_conf = json_decode($db_cred, true);
    if(isset($db_conf[$key]))
    {
        return $db_conf[$key];
    }
    else{
        return false;
    }
}

function get_wg_config($key, $default = null)
{
    $db_cred = file_get_contents('/var/www/labs/workspace/labs-core/wg-config.json');
    $db_conf = json_decode($db_cred, true);
    if(isset($db_conf[$key]))
    {
        return $db_conf[$key];
    }
    else{
        return false;
    }
}

function sanitizeInput($inputString) {
    $pattern = '/^[A-Za-z0-9_]+$/';
    if (preg_match($pattern, $inputString)) {
        return true;
    } else {
        return false;
    }
}

function mysqlAppBackup(){
    $env_cmd = get_config('env_cmd');
    $app_root = get_config('app_root');
    $mysql_root_password = get_config('mysql_root_password');
    $backup_dir = "$app_root/workspace/backup/mysql-app/";

    if(!is_dir($backup_dir)){
        mkdir($backup_dir, 0777, true);
    }

    $backup_cmd = $env_cmd . "mysqldump -u root -p$mysql_root_password --all-databases > $backup_dir/mysql-app-backup.sql";
    system($backup_cmd, $return_var);

    if($return_var == 0){
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s A'); 
        $last_backup = system("echo Last mysql-app backup: $date > $backup_dir/last_backup.txt", $return_var);
        if($return_var == 0){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function mysqlSchemaBackup(){
    $env_cmd = get_config('env_cmd');
    $app_root = get_config('app_root');
    $mysql_root_password = get_config('mysql_root_password');
    $backup_dir = "$app_root/workspace/backup/mysql-app-schema/";

    if(!is_dir($backup_dir)){
        mkdir($backup_dir, 0777, true);
    }

    $backup_cmd = $env_cmd . "mysqldump -u root -p$mysql_root_password --no-data --all-databases > $backup_dir/mysql-app-schema.sql";
    system($backup_cmd, $return_var);

    if($return_var == 0){
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s A'); 
        $last_backup = system("echo Last mysql-schema backup: $date > $backup_dir/last_backup.txt", $return_var);
        if($return_var == 0){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

include_once 'classes/database.class.php';
include_once 'classes/user.class.php';
include_once 'classes/usersession.class.php';
include_once 'classes/device.class.php';
include_once 'classes/labs.class.php';
include_once 'classes/wg.class.php';
include_once 'classes/services/mysql.class.php';
include_once 'classes/services/mongodb.class.php';
include_once 'classes/curl.class.php';
include_once 'api/index.php';

if(php_sapi_name() == 'apache2handler'){
    include_once 'classes/session.class.php';
    include_once 'classes/WebAPI.class.php';

    $wapi = new WebAPI();

    if(session::get('session_token')){
        $wapi->validateSession(session::get('session_token'));

}
}







