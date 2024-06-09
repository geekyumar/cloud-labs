<?php

header('Content-type: application/json');

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST' and
        isset($_POST['fingerprint']) and
        isset($_POST['instance_id']) and
        session::get('session_token'))
{
        $fingerprint = $_POST['fingerprint'];
        $instance_id = $_POST['instance_id'];
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

    
        if($result === true){
            
            $uid = session::$usersession->data['uid'];
            $username = session::$usersession->data['username'];
            $env_cmd = get_config('env_cmd');

            $labs = new labs($instance_id, $username);
            if($labs->labStatus($instance_id, $username) == true){
                $instance_json = shell_exec("cloudlabsctl stats $username $instance_id");
                if($instance_json)
                    {
                        $instance_stats = json_decode($instance_json, true);
                        $success = array(
                            "response" => "success",
                            "stats" => $instance_stats
                            
                        );
                        $resp_data = json_encode($success);
                        REST::send_response_data(200, $resp_data);
                    }
                    else{
                        $fail = array(
                            "response" => "failed"
                        );
                        $resp_data = json_encode($fail);
                        REST::send_response_data(200, $resp_data);
                    }
            }
                    else{
                        $fail = array(
                            "response" => "failed"
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
    