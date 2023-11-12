<?php

// $device_conf = "$'\n'[Peer]$'\n'#peer3$'\n'PublicKey = fcUvLlYkhGXzW1+fzh0PTVthTIvcwPDekN2RizQxui4=$'\n'AllowedIPs = 172.19.0.0/16, 172.19.0.3/32";
// $cmd = system("echo $device_conf >> co", $result);

include 'htdocs/src/main.php';

echo get_wg_conf('wg_pubkey');