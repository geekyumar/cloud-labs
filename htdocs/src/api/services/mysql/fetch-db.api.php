<?php

header('Content-type: application/json');

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST' and
        isset($_POST['mysql_username']) and
        isset($_POST['fingerprint']) and
        session::get('session_token'))
    {
        global $fetch_db;
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
    
            $mysql_username = $_POST['mysql_username'];

            try{
                $fetch_db = mysql::fetchDb($mysql_username, $username);
            }
            catch(Exception $e)
            {
                $fail = array(
                    "response" => "exception error"
                );
                $resp_data = json_encode($fail);
                REST::send_response_data(500, $resp_data);   
            }

            if($fetch_db)
            {
                $success = array(
                    "response" => "success",
                    "databases" => $fetch_db
                );
                $resp_data = json_encode($success);
                REST::send_response_data(200, $resp_data);
            }
            else{
                $fail = array(
                    "response" => "mysql db fetch failed"
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
    