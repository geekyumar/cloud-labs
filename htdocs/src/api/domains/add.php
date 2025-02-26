<?php
 
${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['domain']) and !empty($_POST['domain_type'])) {
        try {
            // if(usersession::validateSessionOwner(session::get('session_token'))){
                $add = domains::addSubDomain($_POST['domain'], $_POST['domain_type']);
                if($add === true){
                    REST::sendResponseData(200, ["response" => "success"]);
                    } else {
                        REST::sendResponseData(500, ["response" => $add]);
                    }
                // } else {
                //     REST::sendResponseData(500, ["response" => "auth_error"]);
                // }
        } catch(Exception $e) {
            REST::sendResponseData(500, ["response" => $e->getMessage()]);
        }
    } else {
        REST::sendResponseData(500, ["response" => "invalid_api_parameters"]);
    }
};