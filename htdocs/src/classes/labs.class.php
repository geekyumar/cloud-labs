<?php

class labs{

    public $instance;

    public function __construct($param_type, $param) {
        $conn = database::getConnection();
        $sql = "SELECT * FROM `labs` WHERE `$param_type` = ? LIMIT 1";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $param);  // Assuming $param is a string
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $this->instance = $result->fetch_assoc();
        } else {
            $this->instance = null;  // Handle no result case
        }

        $stmt->close();
    }

    public static function validateInstanceId($instance_id){
        $conn = database::getConnection();
        $username = session::getUsername();
        $sql = "SELECT * FROM `labs` WHERE `instance_id` = '$instance_id' AND `username` = '$username' LIMIT 1";

        if($conn->query($sql)->num_rows == 1){
            return true;
        }else{
            return false;
        }
    }

    public function isDeployed(){
        if($this->instance){
            $env_cmd = get_config('env_cmd');
            $sess_username = $this->instance['username'];
            $container_info = exec($env_cmd . "docker inspect -f '{{.State.Running}}' $sess_username", $output, $result);
            if($this->instance['container_status'] == 1 and $output[0] == 'true'){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function isCreated($sess_username){
        #TODO: in this method, the lab instance creation should not be validated by checking the storage directory.
        $conn = database::getConnection();
        $sql = "SELECT * FROM `labs` WHERE `username` = '$sess_username' LIMIT 1";

        if($conn->query($sql)->num_rows == 1){
            return true;
        }else{
            return false;
        }
    }

    public function getInstanceId(){
        if($this->instance){
            return $this->instance['instance_id'];
        } else {
            return false;
        }
    }

    public function labStatus(){
        if($this->instance){
            $sess_username = $this->instance['username'];
            $container_status = $this->instance['container_status'];
            $env_cmd = get_config('env_cmd');
            $container_info = exec($env_cmd . "docker inspect -f '{{.State.Running}}' $sess_username", $output, $return_var);

            if($return_var == 0 and $container_status == 1 and $output[0] == 'true'){
                return 'active';
            }
            else{
                return 'inactive';
            }
        }
        else{
            return 'no_instance_found';
        }
    }

    public function updateContainerStatus($container_status){
        if($this->instance){
            $sess_username = $this->instance['username'];
            $instance_id = $this->instance['instance_id'];
            $conn = database::getConnection();
            $update_status_query = "UPDATE `labs` SET
            `container_status` = '$container_status'
            WHERE `instance_id` = '$instance_id' AND `username` = '$sess_username'";

            if($conn->query($update_status_query) == true){
                return true;
            }else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public static function wgAddConf($wg_pubkey, $wg_ip){

        $curl = new curl();
        $curl->setHttpParams('http://wireguard/api/devices/add', ['wg_ip' => $wg_ip, 'wg_pubkey' => $wg_pubkey]);
        $response = $curl->responseData();
        
        if($response['response_code'] == 200 and $response['data']['response'] == 'success'){
            return true;
        } else {
            return false;
        }

        // $env_cmd = get_config('env_cmd');
        // $add_conf = system($env_cmd . "docker exec wireguard wg set wg0 peer $wg_pubkey allowed-ips 172.19.0.0/16,$wg_ip/32", $result);
    
        // if($result == 0){
        //     $update_conf = system($env_cmd . "docker exec wireguard wg-quick save wg0", $result);
        //     return $result;
        // }else{
        //     return false;
        // }

    }

    public static function create($private_ip, $wg_ip){

        /*
        TODO: 
        1. handle the case 'already_created' if the directory is already present.
        2. handle the case 'failed' if the directory creation fails.
        */
        $uid = session::getUid();
        $username = session::getUsername();

        if(wg::vpnStatus() == true){ 
        if(!self::isCreated($username)){
            # wireguard private and public keys for instance.
            $wg_privkey = device::generatePrivateKey();
            $wg_pubkey = device::generatePublicKey($wg_privkey);

            $instance_id = md5($username . $private_ip . $wg_ip . $wg_privkey . $wg_pubkey);

            $labs_storage_dir = get_config('labs_storage');
            $labs_storage_permission = get_config('labs_storage_permission');

            $server_pubkey = get_wg_config('wg_pubkey');
            $server_allowedips = get_wg_config('allowed_ips');
            $server_endpoint = get_wg_config('endpoint');

            if(!is_dir($labs_storage_dir . $username)){
                $oldmask = umask(0);
                if(self::wgAddConf($wg_pubkey, $wg_ip) == true){
                if(mkdir($labs_storage_dir . $username . '/wireguard_conf', 0777, true) == true){

                $wg_config = "[Interface]\nPrivateKey = $wg_privkey\nAddress = $wg_ip/32\n\n[Peer]\nPublicKey = $server_pubkey\nAllowedIPs = $server_allowedips\nEndpoint = $server_endpoint\nPersistentKeepalive = 30";
                $write_conf = file_put_contents($labs_storage_dir . $username . '/wireguard_conf/wg0.conf', $wg_config);

                if($write_conf){
                    $conn = database::getConnection();
                    $timezone =  "SET @@session.time_zone = '+05:30'";
                    $sql = "INSERT INTO `labs` (`uid`, `username`, `instance_id`, `private_ip`, `wg_ip`, `wg_pubkey`, `container_status`, `time`)
                    VALUES ('$uid', '$username', '$instance_id', '$private_ip', '$wg_ip', '$wg_pubkey', 0, now())";
        
                    if($conn->query($timezone) and $conn->query($sql) == true){
                            return true;
                        }
                }else{
                    $user_dir = $labs_storage_dir . $username;
                    system("rm -rf $user_dir");
                }
            }else{
                return false;
            }
        }
            else{
                return false;
            }
        }else{
            return false;
        }
        }else{
            return false;
        }

        umask($oldmask);
    }
    else{
        return false;
    }
}

    // the below code must be corrected in the future. (22/11) (done).

    public function deploy(){
        $env_cmd = get_config('env_cmd');
        $username = $this->instance['username'];
        $deploy_cmd = exec($env_cmd . "cloudlabsctl deploy $username", $out, $return_var);

        if($return_var == 0){
            return 'deployed';
        } else {
            return 'deploy_failed';
        }
    }

    public function redeploy(){
        $env_cmd = get_config('env_cmd');
        $username = $this->instance['username'];
        $redeploy_cmd = exec($env_cmd . "cloudlabsctl redeploy $username", $out, $return_var);

        if($return_var == 0){
            return 'redeployed';
        } else {
            return 'redeploy_failed';
        }
    }

    public function stop(){
        $env_cmd = get_config('env_cmd');
        $username = $this->instance['username'];
        $stop_cmd = exec($env_cmd . "cloudlabsctl stop $username", $out, $return_var);

        if($return_var == 0){
            return 'stopped';
        } else {
            return 'stop_failed';
        }
    }
}