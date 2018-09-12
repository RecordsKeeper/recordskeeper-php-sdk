<?php

namespace recordskeeper\recordskeepersdk;
error_reporting(0);

class Permissions {

 public $config;

 function __construct(array $config) {
     $this->chain = $config['chain'];
     $this->url = $config['url'];
     $this->username = $config['rkuser'];
     $this->pass = $config['passwd'];
     $this->port = $config['port'];
 } 
   
function grantPermissions($address,$permissions){
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_PORT => $this->port,
    CURLOPT_URL => $this->url,
    CURLOPT_USERPWD => $this->username . ":" . $this->pass,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"grant\",\"params\":[\"$address\",\"$permissions\"],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if($result == null){
        $response = $result->error->message;
    } else {
        $response = $result->result;
    }
    return $response;
    }

function revokePermissions($address,$permissions){
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_PORT => $this->port,
    CURLOPT_URL => $this->url,
    CURLOPT_USERPWD => $this->username . ":" . $this->pass,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"revoke\",\"params\":[\"$address\",\"$permissions\"],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if($result == null){
        $response = $result->error->message;
        } else {
        $response = $result->result;
        }
    return $response;
    }
}

?>