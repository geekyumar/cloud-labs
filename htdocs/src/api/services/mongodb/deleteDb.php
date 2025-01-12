<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['username']) and !empty($_POST['db_name'])) {
        try {
            
                $delete_db = mongodb::deleteDb($_POST['username'], $_POST['db_name']);
                if($delete_db == 'success'){
                    REST::sendResponseData(200, ["response" => 'success']);
                } else {
                    REST::sendResponseData(500, ["response" => $delete_db]);
                }

        } catch(Exception $e) {
            REST::sendResponseData(500, ["response" => "error"]);
        }
    } else {
        REST::sendResponseData(500, ["response" => "invalid_api_parameters"]);
    }
};