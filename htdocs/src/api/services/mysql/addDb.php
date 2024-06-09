<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['mysql_username']) and !empty($_POST['mysql_dbname'])
     and !empty($_POST['collation']) and session::get('session_token')) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $add_db = mysql::addDb($$_POST['mysql_username'], session::getUsername() . "_" . $_POST['mysql_dbname'], $_POST['collation'], session::getUserId(), session::getUsername());
                if($add_db == true){
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