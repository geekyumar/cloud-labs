<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['name']) and !empty($_POST['username']) and 
    !empty($_POST['email']) and !empty($_POST['phone']) and !empty($_POST['password'])) {
        try {
            $result = user::signup($_POST['name'], $_POST['username'], $_POST['email'], $_POST['phone'], $_POST['password']);
            if($result == true){
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