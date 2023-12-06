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

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// $directoryPath = '/opt/homebrew/websites/labs/workspace/labs-storage/farooq';

// if (!is_dir($directoryPath)) {
   
//     if (!mkdir($directoryPath, 0777, true)) {
//         die('Failed to create directory: ' . error_get_last()['message']);
//     }
//     umask($oldmask);
// }

system('cloudlabsctl redeploy umar', $ret);

echo $ret;
?>



    