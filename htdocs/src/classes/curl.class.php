<?php

class curl{

    public $curl_obj = null;

    public function setHttpParams($url, array $data = null){
        $this->curl_obj = curl_init($url);
        curl_setopt($this->curl_obj, CURLOPT_POST, true);
        curl_setopt($this->curl_obj, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($this->curl_obj, CURLOPT_RETURNTRANSFER, true);
    }

    public function setHeaders(array $headers){
        curl_setopt($this->curl_obj, CURLOPT_HTTPHEADER, $headers);
    }

    public function responseData(){
        $response = curl_exec($this->curl_obj);
        curl_close($this->curl_obj);
        return [
            'response_code' => curl_getinfo($this->curl_obj, CURLINFO_HTTP_CODE),
            'data' => json_decode($response, true)
        ];
        curl_close($this->curl_obj);
    }

}