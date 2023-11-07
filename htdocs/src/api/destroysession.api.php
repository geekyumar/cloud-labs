<?php

header('Content-type: application/json');

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

if(session::get('session_token'))
{
    if( session::get('session_token'))
    {
   
        $fingerprint = $_POST['fingerprint'];
        $session_token = session::get('session_token');
    
        try{
            $result = usersession::destroy($session_token);
        }
        catch(Exception $e)
        {
            $fail = array(
                "response" => "failed"
            );
            $resp_data = json_encode($fail);
            REST::send_response_data(500, $resp_data);
        }
    
        if($result)
        {
            $success = array(
                "response" => "success"
            );
            $resp_data = json_encode($success);
            REST::send_response_data(200, $resp_data);
        }
        else{
            $fail = array(
                "response" => "failed"
            );
            $resp_data = json_encode($fail);
            REST::send_response_data(500, $resp_data);
        }
    
    }
    else{
        REST::send_response_data(500, 'Invalid POST data');
    }
    }
    else{
    REST::send_response_data(500, 'Invalid session');
    }
    