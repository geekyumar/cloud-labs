<?php

class REST2
{
    public function sendResponseData($status_code, $data)
    {
        switch ($status_code) {
            case 200:
                header("HTTP/1.1 200 OK");
                break;
            case 201:
                header("HTTP/1.1 201 Created");
                break;
            case 204:
                header("HTTP/1.1 204 No Content");
                break;
            case 400:
                header("HTTP/1.1 400 Bad Request");
                break;
            case 401:
                header("HTTP/1.1 401 Unauthorized");
                break;
            case 403:
                header("HTTP/1.1 403 Forbidden");
                break;
            case 404:
                header("HTTP/1.1 404 Not Found");
                break;
            case 500:
                header("HTTP/1.1 500 Internal Server Error");
                break;
                
            default:
                header("HTTP/1.1 " . $status_code);
            }

            echo json_encode($data);
        }

        public function request_method(){
            return $_SERVER['REQUEST_METHOD'];
        }

        public function set_headers($header){
            return header($header);
        }
}
