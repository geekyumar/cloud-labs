<?php

header('Content-type: application/json');

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST' and
        isset($_POST['mysql_dbname']) and
        isset($_POST['fingerprint']) and
        session::get('session_token'))
    {
        global $delete_db;
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

            $mysql_dbname = $_POST['mysql_dbname'];

            try{
                $delete_db = mysql::deleteDb($mysql_dbname, $username);
            }
            catch(Exception $e)
            {
                $fail = array(
                    "response" => "exception error"
                );
                $resp_data = json_encode($fail);
                REST::send_response_data(500, $resp_data);   
            }

            if($delete_db === true)
            {
                $success = array(
                    "response" => "success"
                );
                $resp_data = json_encode($success);
                REST::send_response_data(200, $resp_data);
            }
            else{
                $fail = array(
                    "response" => "delete mysql db failed"
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
    