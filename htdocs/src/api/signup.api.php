<?php

header('Content-Type: application/json');

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $dataArray = file_get_contents('php://input');
$data = json_decode($dataArray, true);

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

    $result = user::signup($name, $username, $email, $phone, $pass);

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
            "request" => "Signup Failed!"
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
