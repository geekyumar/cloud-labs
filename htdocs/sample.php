<pre>
<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';


$env_cmd = get_config('env_cmd');
$container_info = exec($env_cmd . "docker stats --no-stream", $result, $out);

print_r ($out);
