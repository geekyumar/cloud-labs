<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['device_name']) and !empty($_POST['device_type']) and
    !empty($_POST['wg_pubkey']) and session::get('session_token')) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $add_device = device::add(session::getUserId(), session::getUsername(), $_POST['device_name'], $_POST['device_type'],
             device::generatePrivateIP() , device::generateWgIP(), $_POST['wg_pubkey']);
                if($add_device == true){
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