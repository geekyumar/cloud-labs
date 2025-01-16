<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['mongodb_username'])) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $delete_user = mongodb::deleteUser($_POST['mongodb_username']);
                if($delete_user == 'success'){
                    REST::sendResponseData(200, ["response" => 'success']);
                } else {
                    REST::sendResponseData(500, ["response" => $delete_user]);
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