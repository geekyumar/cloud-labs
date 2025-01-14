<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['mongodb_username']) and !empty($_POST['mongodb_dbname'])) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $add_db = mongodb::addDb($_POST['mongodb_username'], $_POST['mongodb_dbname']);
                if($add_db == 'success'){
                    REST::sendResponseData(200, ["response" => 'success']);
                } else {
                    REST::sendResponseData(500, ["response" => $add_db]);
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