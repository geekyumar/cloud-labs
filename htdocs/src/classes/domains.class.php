<?php

class domains{
    public static $available_domains = [
        "cloudlabs.space"
    ];

    public static function addSubDomain($domain, $domain_type){
        $subdomain = $domain . '.' . $domain_type;
        if(in_array($domain_type, self::$available_domains)){
            $labs = new labs('username', session::getUsername());
            $conn = database::getConnection();
            $sql = "INSERT INTO domains (`uid`, `username`, `domain`, `domain_type`, `container_ip`, `added_on`, `last_updated`) 
                    VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issss", $labs->uid, $labs->username, $subdomain, $domain_type, $labs->private_ip);
            $stmt->execute();
            if($stmt->get_result() == true){
                return true;
            } else {
                return 'db_add_error';
            }
        } else {
            return 'invalid_subdomain';
        }
    }

    public static function validateSubdomain($subdomain){
            $domain_split = explode('.', $subdomain);
            $subdomain_name = $domain_split[count($domain_split) - 2] . '.' . $domain_split[count($domain_split) - 1];
            if(in_array($subdomain_name, self::$available_domains)){
                return true;
            } else {
                return false;
            }
            // if(string_contains($subdomain, self::$available_domains[$i])){
            //     return true;
            // } else {
            //     return false;
            // }
    }

    public static function forwardRequest($domain){

        $conn = database::getConnection();
        $sql = "SELECT * FROM `domains` WHERE `domain` = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $domain);
        $stmt->execute();

        $result = $stmt->get_result();
        if($result->num_rows == 0){
            http_response_code(502);
            header("Content-Type: text/plain");
            echo "Domain not registered.\n";
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
            echo "Destination Not Reachable\n";
            echo "The server is unreachable or not responding.\n";
            echo "Error: $curlError\n";
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
}