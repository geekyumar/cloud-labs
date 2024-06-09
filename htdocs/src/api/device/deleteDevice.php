<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['device_id']) and session::get('session_token')) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $delete_device = device::delete($_POST['device_id'], session::getUsername());
                if($delete_device == true){
                    REST::sendResponseData(200, ["response" => "success"]);
                } else {
                    REST::sendResponseData(500, ["response" => "failed"]);
                }
        } else {
            REST::sendResponseData(401, ["response" => "auth_error"]);
        }
     } catch(Exception $e) {
            REST::sendResponseData(500, ["response" => "error"]);
        }
    } else {
        REST::sendResponseData(500, ["response" => "invalid_api_parameters"]);
    }
};