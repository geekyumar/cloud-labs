<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['mongodb_dbname'])) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $delete_db = mongodb::deleteDb($_POST['mongodb_dbname']);
                if($delete_db == 'success'){
                    REST::sendResponseData(200, ["response" => 'success']);
                } else {
                    REST::sendResponseData(500, ["response" => $delete_db]);
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