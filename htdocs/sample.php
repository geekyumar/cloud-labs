<pre>
<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';


// $env_cmd = get_config('env_cmd');
// $container_info = system("docker exec -it wireguard wg set wg0 peer KuZ5km+DBPSln0wFUOATXrvRqnLW52BxgKDufoB8IWs= allowed-ips 172.19.0.0/16,172.19.116.227/32", $result);
// echo $result;

// $wg_privkey = shell_exec('wg genkey');
// $wg_pubkey = shell_exec("echo $wg_privkey | wg pubkey");

// echo $wg_privkey;
// echo $wg_pubkey;

// Generate private key
$descriptorspec = [
    0 => ["pipe", "r"],  // stdin
    1 => ["pipe", "w"],  // stdout
    2 => ["pipe", "w"]   // stderr
];

$process = proc_open('wg genkey', $descriptorspec, $pipes);

if (is_resource($process)) {
    fclose($pipes[0]);
    $wg_privkey = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    // Generate public key from private key
    $process2 = proc_open('wg pubkey', $descriptorspec, $pipes2);

    if (is_resource($process2)) {
        fwrite($pipes2[0], $wg_privkey);
        fclose($pipes2[0]);

        $wg_pubkey = stream_get_contents($pipes2[1]);
        fclose($pipes2[1]);

        // Close the process
        proc_close($process2);
    } else {
        die('Failed to execute wg pubkey command');
    }

    // Close the process
    proc_close($process);
} else {
    die('Failed to execute wg genkey command');
}

// Print or use the keys as needed
echo "Private Key: $wg_privkey\n";
echo "Public Key: $wg_pubkey\n";
