<?php

function get_config($key, $default = null)
{
    $db_cred = file_get_contents('/opt/homebrew/websites/labs/workspace/config.json');
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
    $db_cred = file_get_contents('/opt/homebrew/websites/labs/workspace/labs-core/wg-config.json');
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

include_once 'classes/database.class.php';
include_once 'classes/REST.class.php';
include_once 'classes/user.class.php';
include_once 'classes/usersession.class.php';
include_once 'classes/device.class.php';
include_once 'classes/labs.class.php';
include_once 'classes/wg.class.php';
include_once 'classes/services.class.php';

if(php_sapi_name() == 'apache2handler'){
    include_once 'classes/session.class.php';
    include_once 'classes/WebAPI.class.php';

    $wapi = new WebAPI();

    if(session::get('session_token')){
        $wapi->validateSession(session::get('session_token'));

}
}







