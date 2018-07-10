<?php

$config = include('config.php');


 $chain = $config['chain'];
 $url = $config['url'];
 $username = $config['rkuser'];
 $pass = $config['passwd'];
 $port = $config['port'];

class permissions

 {  
function grantpermissions($address,$permissions){
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_PORT => $GLOBALS['port'],
    CURLOPT_URL => $GLOBALS['url'],
    CURLOPT_USERPWD => $GLOBALS['username'] . ":" . $GLOBALS['pass'],
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"grant\",\"params\":[\"$address\",\"$permissions\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
error_log("Sending request: grant");
$result   = json_decode(curl_exec($curl));
$err      = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($httpCode == 200 && $result->error == null) {
    
    if($result == null){
        $print = $result->error->message;
    } else {
        $print = $result->result;
    }
    

} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
    error_log("ERROR: Info not fetched from blockchain");
}

return $print;
}

function revokepermissions($address,$permissions){
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_PORT => $GLOBALS['port'],
    CURLOPT_URL => $GLOBALS['url'],
    CURLOPT_USERPWD => $GLOBALS['username'] . ":" . $GLOBALS['pass'],
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"revoke\",\"params\":[\"$address\",\"$permissions\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
error_log("Sending request: revoke");
$result   = json_decode(curl_exec($curl));
$err      = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($httpCode == 200 && $result->error == null) {
         
     if($result == null){
        $print = $result->error->message;
    } else {
        $print = $result->result;
    }
    

} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
    error_log("ERROR: Info not fetched from blockchain");
}

return $print;
}

}

?>