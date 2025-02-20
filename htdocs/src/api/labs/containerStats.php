<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['instance_id']) and session::get('session_token')) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $labs = new labs('instance_id', $_POST['instance_id']);
                if($labs->labStatus() == 'active'){
                    $username = session::getUsername();
                    $instance_json = exec("cloudlabsctl stats {$username}", $out, $return_var);
                    if($instance_json){ 
                        REST::sendResponseData(200, ["response" => "success", "stats"=> json_decode($out[1], true)]);
                    } else {
                        REST::sendResponseData(500, ["response" => "failed"]);
                    }
            } else {
                REST::sendResponseData(500, ["response" => "error"]);
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