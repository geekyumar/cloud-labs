<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['mongodb_username']) and !empty($_POST['mongodb_password'])) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $add_user = mongodb::createUser($_POST['mongodb_username'], $_POST['mongodb_password']);
                if($add_user == 'success'){
                    REST::sendResponseData(200, ["response" => 'success']);
                } else {
                    REST::sendResponseData(500, ["response" => $add_user]);
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