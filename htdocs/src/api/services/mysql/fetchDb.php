<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['mysql_username']) and session::get('session_token')) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $fetch_db = mysql::fetchDb($_POST['mysql_username'], session::getUsername());
                if($fetch_db){
                    REST::sendResponseData(200, ["response" => "success", "databases" => $fetch_db]);
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