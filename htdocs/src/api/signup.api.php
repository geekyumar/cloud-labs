<?php

header('Content-Type: application/json');

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';



if($_SERVER['REQUEST_METHOD'] == 'POST')
{

 if(isset($_POST['name']) and 
isset($_POST['username']) and
isset($_POST['email']) and 
isset($_POST['phone']) and 
isset($_POST['password']))

{
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['password'];

    try{
        $result = user::signup($name, $username, $email, $phone, $pass);
    }
    catch(Exception $e)
    {
        $fail = array(
            "response" => "failed"
        );
        $resp_data = json_encode($fail);
        REST::send_response_data(200, $resp_data);
        die();
    }

    if($result === true)
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
        REST::send_response_data(200, $resp_data);
    }

}
else{
    REST::send_response_data(500, 'Invalid POST data');
}
}
else{
REST::send_response_data(500, 'Unsupported request method');
}
