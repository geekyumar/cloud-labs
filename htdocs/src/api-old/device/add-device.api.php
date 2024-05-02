<?php

header('Content-type: application/json');

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST' and
        isset($_POST['device_name']) and
        isset($_POST['device_type']) and
        isset($_POST['wg_pubkey']) and
        isset($_POST['fingerprint']) and
        session::get('session_token'))
    {
        global $add_device;
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
            REST::send_response_data(500, $resp_data);
           
        }

    
        if($result === true)
        {
            $uid = session::$usersession->data['uid'];
            $username = session::$usersession->data['username'];
    
            $device_name = $_POST['device_name'];
            $device_type = $_POST['device_type'];
            $wg_ip = device::generateWgIP();
            $private_ip = device::generatePrivateIP();
            $wg_pubkey = $_POST['wg_pubkey'];

            try{
                $add_device = device::add($uid, $username, $device_name, $device_type, $private_ip, $wg_ip, $wg_pubkey);
            }
            catch(Exception $e)
            {
                $fail = array(
                    "response" => "exception error"
                );
                $resp_data = json_encode($fail);
                REST::send_response_data(500, $resp_data);   
            }

            if($add_device === true)
            {
                $success = array(
                    "response" => "success"
                );
                $resp_data = json_encode($success);
                REST::send_response_data(200, $resp_data);
            }
            else{
                $fail = array(
                    "response" => "add device failed"
                );
                $resp_data = json_encode($fail);
                REST::send_response_data(200, $resp_data);
            }

        }
        else{
            usersession::destroy($session_token);
            $fail = array(
                "response" => "User Auth failed"
            );
            $resp_data = json_encode($fail);
            REST::send_response_data(500, $resp_data);  
        }
    
    }
    else{
        $fail = array(
            "response" => "Invalid request"
        );
        $resp_data = json_encode($fail);
        REST::send_response_data(500, $resp_data);
       
    }
    