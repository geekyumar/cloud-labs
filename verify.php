<?php

header('content-type: Application/json');
function set_response_code($code) {
    switch ($code) {
        case 200:
            header("HTTP/1.1 200 OK");
            break;
        case 404:
            header("HTTP/1.1 404 Not Found");
            break;
        case 500:
            header("HTTP/1.1 500 Internal Server Error");
            break;
        // Add more cases as needed for other status codes
        default:
            header("HTTP/1.1 " . $code);
    }
}
if(isset($_POST['fingerprint']))
    {
        $response = [
            'status' => 'success'
        ];
        echo json_encode($response);
    }
    else{
       set_response_code(404);
       echo "404 Not Found raa";
    }

    //sample change