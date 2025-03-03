<?php

function get_config($key, $default = null)
{
    $db_cred = file_get_contents('/var/www/labs/workspace/config.json');
    $db_conf = json_decode($db_cred, true);
    if(isset($db_conf[$key]))
    {
        return $db_conf[$key];
    }
    else{
        return false;
    }
}

function getConnection()
{
    $servername = get_config('servername');
    $username = get_config('username');
    $password = get_config('password');
    $dbname = get_config('dbname');

    try{
        $connection = new mysqli($servername, $username, $password, $dbname);
    }
    catch(Exception $e)
    {
        throw new Exception($e->getMessage());
    }
    
    if($connection == true)
    {
        return $connection;
    }
    else{
        return false;
    }
}


function forwardRequest($domain){

    $conn = getConnection();
    $sql = "SELECT * FROM `domains` WHERE `domain` = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $domain);
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows == 0){
        http_response_code(502);
        header("Content-Type: text/plain");
        echo "Domain not registered.\n";
        exit;
    }

    $row = $result->fetch_assoc();
    $container_ip = $row['container_ip'];


    $destinationUrl = "http://$container_ip"; // Change this to your target server

    // Get method and path
    $method = $_SERVER['REQUEST_METHOD'];
    $path = $_SERVER['HTTP_X_REPLACED_PATH'] ?? '/';

    // Preserve query parameters
    $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';

    // Construct full target URL
    $targetUrl = $destinationUrl . $path . $queryString;

    // Initialize cURL
    $ch = curl_init($targetUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // Fail faster if unreachable

    // Preserve headers
    $headers = [];
    foreach (getallheaders() as $key => $value) {
        if (strtolower($key) !== 'expect') { // Ignore Expect header to prevent delays
            $headers[] = "$key: $value";
        }
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Handle request body (for POST, PUT, PATCH, DELETE)
    if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
        $body = file_get_contents('php://input');
        if (!empty($body)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
    }

    // Execute request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);

    // If cURL error occurs (server unreachable), show plain text error
    if (!empty($curlError)) {
        http_response_code(502);
        header("Content-Type: text/plain");
        echo "The server is unreachable or not responding.\n";
        exit;
    }

    // Separate headers and body
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $responseHeaders = substr($response, 0, $headerSize);
    $responseBody = substr($response, $headerSize);

    curl_close($ch);

    // Send headers to the client
    header("Content-Type: text/plain");
    foreach (explode("\r\n", trim($responseHeaders)) as $header) {
        if (!empty($header) && !str_starts_with(strtolower($header), 'transfer-encoding:')) {
            header($header);
        }
    }

    // Output response body
    http_response_code($httpCode);
    echo $responseBody;
}

forwardRequest($_SERVER['SERVER_NAME']);