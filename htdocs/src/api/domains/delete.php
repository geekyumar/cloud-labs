<?php
 
${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['domain'])) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                $delete = domains::delete($_POST['domain']);
                if($delete === true){
                    REST::sendResponseData(200, ["response" => "success"]);
                    } else {
                        REST::sendResponseData(500, ["response" => $delete]);
                    }
                } else {
                    REST::sendResponseData(500, ["response" => "auth_error"]);
                }
        } catch(Exception $e) {
            REST::sendResponseData(500, ["response" => $e->getMessage()]);
        }
    } else {
        REST::sendResponseData(500, ["response" => "invalid_api_parameters"]);
    }
};