<pre>
<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';


$env_cmd = get_config('env_cmd');
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

// $stats_json = exec('cloudlabsctl stats farooq af27ebaaf1a96bf892fd55627f1824ba', $out, $return_var);

// print_r($out);


// $add_db_cmd = system($env_cmd . "docker exec mysql mysql -u root -pumar1234 -e 'CREATE DATABASE db7; GRANT ALL PRIVILEGES ON db7.* TO 'User1'@'%'; FLUSH PRIVILEGES;'", $return_var);
// echo $return_var;


// $user_array = [];

// $conn = database::getConnection();
// $query = "SELECT `mysql_dbname` FROM `mysql_dbs` WHERE `username` = 'farooq'";
// $result = $conn->query($query);

// if ($result->num_rows) {
//     while ($row = $result->fetch_assoc()) {
//         $user_array[] = $row['mysql_dbname'];
//     }
//     print_r($user_array);
// } else {
//     echo "No data";
// }


?>

<button id="sample" class="delete-mysql-db">sample</button>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="js/delete-mysql-db.js"></script>


    