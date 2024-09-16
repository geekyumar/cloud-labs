<?php

class wg{
    public static function vpnStatus(){
        $env_cmd = get_config('env_cmd');
        $container_info = exec("ping -c 1 167.0.0.4", $output, $return_var);

        if($return_var == 0){
            return true;
        }
        else{
            return false;
        }
    }
}