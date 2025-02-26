<?php

class domains{
    public static $available_domains = [
        "cloudlabs.space"
    ];

    public static function addSubDomain($domain, $domain_type){
        $subdomain = $domain . '.' . $domain_type;
        if(in_array($domain_type, self::$available_domains)){
            $labs = new labs('username', session::getUsername());
            $conn = database::getConnection();
            $sql = "INSERT INTO domains (`uid`, `username`, `domain`, `domain_type`, `container_ip`, `added_on`, `last_updated`) 
                    VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issss", $labs->uid, $labs->username, $subdomain, $domain_type, $labs->private_ip);
            $stmt->execute();
            if($stmt->get_result() == true){
                return true;
            } else {
                return 'db_add_error';
            }
        } else {
            return 'invalid_subdomain';
        }
    }

    public static function validateSubdomain($subdomain){
            $domain_split = explode('.', $subdomain);
            $subdomain_name = $domain_split[count($domain_split) - 2] . '.' . $domain_split[count($domain_split) - 1];
            if(in_array($subdomain_name, self::$available_domains)){
                return true;
            } else {
                return false;
            }
            // if(string_contains($subdomain, self::$available_domains[$i])){
            //     return true;
            // } else {
            //     return false;
            // }
    }
}