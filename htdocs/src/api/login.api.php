<?php

header('Content-Type: application/json');

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';


if($_SERVER['REQUEST_METHOD'] == 'POST')
{

 if(isset($_POST['username']) and
    isset($_POST['password']))

{   
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = usersession::authenticate($username, $password);

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
            "request" => "failed"
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
