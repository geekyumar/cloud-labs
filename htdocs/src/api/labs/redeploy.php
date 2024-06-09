<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['instance_id']) and session::get('session_token')) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $labs = new labs($_POST['instance_id'], session::getUsername());
                if($labs->isDeployed(session::getUsername()) == true){
                    $env_cmd = get_config('env_cmd');
                    $username = session::getUsername();
                    exec($env_cmd . "cloudlabsctl redeploy $username {$_POST['instance_id']}", $out, $return_var);
                    if($return_var == 0){ 
                        REST::sendResponseData(200, ["response" => "success"]);
                    } else {
                        REST::sendResponseData(500, ["response" => "failed"]);
                    }
            } else {
                REST::sendResponseData(500, ["response" => "container_stopped"]);
            }
        } else {
            REST::sendResponseData(500, ["response" => "auth_error"]);
        }
     } catch(Exception $e) {
            REST::sendResponseData(500, ["response" => "error"]);
        }
    } else {
        REST::sendResponseData(500, ["response" => "invalid_api_parameters"]);
    }
};