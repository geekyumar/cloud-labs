<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['username']) and !empty($_POST['password'])) {
        try {
            
                $add_user = mongodb::createUser($_POST['username'], $_POST['password'], session::getUserId());
                if($add_user == 'success'){
                    REST::sendResponseData(200, ["response" => "success"]);
                } else {
                    REST::sendResponseData(500, ["response" => "failed"]);
                }

        } catch(Exception $e) {
            REST::sendResponseData(500, ["response" => "error"]);
        }
    } else {
        REST::sendResponseData(500, ["response" => "invalid_api_parameters"]);
    }
};