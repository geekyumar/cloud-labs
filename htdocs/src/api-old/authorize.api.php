<?php

header('Content-type: application/json');

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST' and
        isset($_POST['fingerprint']) and
        session::get('session_token'))
    {
   
        $fingerprint = $_POST['fingerprint'];
        $session_token = session::get('session_token');
    
        try{
            $result = usersession::authorize($session_token, $fingerprint);
        }
        catch(Exception $e)
        {
            usersession::destroy($session_token);
            $fail = array(
                "response" => "failed"
            );
            $resp_data = json_encode($fail);
            REST::send_response_data(200, $resp_data);
           
        }
    
        if($result === true)
        {
            $success = array(
                "response" => "success"
            );
            $resp_data = json_encode($success);
            REST::send_response_data(200, $resp_data);
            $data = "true";
            
        }
        else{
            usersession::destroy($session_token);
            $fail = array(
                "response" => "failed"
            );
            $resp_data = json_encode($fail);
            REST::send_response_data(500, $resp_data);  
        }
    
    }
    else{
        $fail = array(
            "response" => "failed"
        );
        $resp_data = json_encode($fail);
        REST::send_response_data(200, $resp_data);
       
    }
    