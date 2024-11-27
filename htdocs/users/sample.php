<?php
// include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// $conn = database::getConnection();

// if($conn){
//     echo 'works';
// } else {
//     echo 'fails';
// }

// $curl = new curl();
// $curl->setHttpParams('http://wireguard/api/devices/delete', ['wg_pubkey' => 'UwgW7HYmYP1AmC0vTVFDVbWHbOXlgBueFkCDvyreWRU=']);
// $response = $curl->responseData();

// print_r($response['data']);


// echo 'Current user: ' . system('whoami');


// $data = ['wg_pubkey' => 'your_pubkey'];

// $ch = curl_init('http://your-endpoint-url');
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $response = curl_exec($ch);
// curl_close($ch);

// echo $response;
// phpinfo();