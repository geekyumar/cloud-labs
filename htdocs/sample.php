<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';
// Run the "docker stats" command and capture the output
$env_cmd = get_config('env_cmd');
exec("$env_cmd docker inspect --format json farooq", $output);
// Check if there is any output
if (!$output) {
  echo 'works';
} else {
    echo 'No Docker stats found.';
}

?>
