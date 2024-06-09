<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['username']) and !empty($_POST['password']) and !empty($_POST['fingerprint'])) {
        try {
            $result = usersession::authenticate($_POST['username'], $_POST['password'], $_POST['fingerprint']);
            if($result){
                REST::sendResponseData(200, ["response" => "success"]);
            } else {
                REST::sendResponseData(200, ["response" => "failed"]);
            }
        } catch(Exception $e) {
            REST::sendResponseData(500, ["response" => "error"]);
        }
    } else {
        REST::sendResponseData(500, ["response" => "invalid_api_parameters"]);
    }
};