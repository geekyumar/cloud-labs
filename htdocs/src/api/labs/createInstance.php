<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and session::get('session_token')) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $wg_ip = device::generateWgIP();
                $private_ip = device::generatePrivateIP();
                $create_instance = labs::create($private_ip, $wg_ip);
                if($create_instance === true){
                    REST::sendResponseData(200, ["response" => "success"]);
                } else {
                    REST::sendResponseData(500, ["response" => $create_instance]);
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