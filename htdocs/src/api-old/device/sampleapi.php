<?php

header('Content-type: application/json');

$response = ["response"=> "success", 'users' => ['Hi', 'Hello', "array"]];

// Convert the array to JSON

echo json_encode($response);