<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';
// Run the "docker stats" command and capture the output
$env_cmd = get_config('env_cmd');
exec("$env_cmd docker stats --no-stream --format json wireguard", $output);

// Check if there is any output
if (!empty($output)) {
    // Convert the output to a single JSON array
    $jsonArray = '[' . implode(',', $output) . ']';

    // Decode the JSON array
    $containerStats = json_decode($jsonArray, true);

    // Check if decoding was successful
    if ($containerStats !== null) {
        // Output the container statistics on the webpage
        echo '<pre>';
        print_r($containerStats);
        echo '</pre>';
    } else {
        echo 'Error decoding JSON: ' . json_last_error_msg();
    }
} else {
    echo 'No Docker stats found.';
}

?>
