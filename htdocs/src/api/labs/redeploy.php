<?php

${basename(__FILE__, '.php')} = function(){
    if(REST::request_method() == 'POST' and !empty($_POST['instance_id']) and session::get('session_token')) {
        try {
            if(usersession::validateSessionOwner(session::get('session_token'))){
                if(labs::validateInstanceId($_POST['instance_id']) === true){
                    $labs = new labs('instance_id', $_POST['instance_id']);
                    if($labs->labStatus() == 'active'){
                        $redeploy = $labs->redeploy();
                        if($redeploy == 'redeployed'){ 
                            REST::sendResponseData(200, ["response" => "success"]);
                        } else {
                            REST::sendResponseData(500, ["response" => $redeploy]);
                        }
                    } else {
                    REST::sendResponseData(500, ["response" => "already_redeployed"]);
                }
            } else {
                REST::sendResponseData(500, ["response" => "instance_id_mismatch"]);
            }
        } else {
                REST::sendResponseData(500, ["response" => "auth_error"]);
            }
        } catch(Exception $e) {
            REST::sendResponseData(500, ["response" => "invalid_api_parameters"]);
        }
    }
};