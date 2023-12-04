<?php

class wg{
    public static function vpnStatus(){
        $env_cmd = get_config('env_cmd');
        $container_info = exec($env_cmd . "docker inspect -f '{{.State.Running}}' wireguard", $output, $return_var);

        if($return_var == 0 and $output[0] == 'true'){
            return true;
        }
        else{
            return false;
        }
    }
}