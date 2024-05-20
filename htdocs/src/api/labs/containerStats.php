<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['instance_id']) and session::get('session_token')) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $labs = new labs($_POST['instance_id'], session::getUsername());
                if($labs->labStatus($_POST['instance_id'], session::getUsername()) == true){
                    $username = session::getUsername();
                    $instance_json = shell_exec("cloudlabsctl stats {$username} {$_POST['instance_id']}");
                    if($instance_json){ 
                        REST::sendResponseData(200, ["response" => "success", "stats"=> json_decode($instance_json, true)]);
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