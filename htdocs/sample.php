<pre>
<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';


$env_cmd = get_config('env_cmd');
$container_info = system("docker exec -it wireguard wg set wg0 peer KuZ5km+DBPSln0wFUOATXrvRqnLW52BxgKDufoB8IWs= allowed-ips 172.19.0.0/16,172.19.116.227/32", $result);
echo $result;