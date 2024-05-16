<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['fingerprint']) and session::get('session_token')) {
        try {
            $result = usersession::authorize(session::get('session_token'), $_POST['fingerprint']);
            if($result === true){
                REST::sendResponseData(200, ["response" => "success"]);
            } else {
                usersession::destroy(session::get('session_token'));
                REST::sendResponseData(401, ["response" => "session_destroyed"]);
            }
        } catch(Exception $e) {
            REST::sendResponseData(500, ["response" => "auth_error"]);
        }
    } else {
        REST::sendResponseData(500, ["response" => "invalid_api_parameters"]);
    }
};