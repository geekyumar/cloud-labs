<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and session::get('session_token')) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $result = usersession::destroy(session::get('session_token'));
                if($result === true){
                    REST::sendResponseData(200, ["response" => "success"]);
                } else {
                    REST::sendResponseData(500, ["response" => "failed"]);
                }
            } else {
                REST::sendResponseData(500, ["response" => "error"]);
            }
        } catch(Exception $e) {
            REST::sendResponseData(500, ["response" => "error"]);
        }
    } else {
        REST::sendResponseData(500, ["response" => "invalid_api_parameters"]);
    }
};