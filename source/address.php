<?php

 $config = include('../../../../config.php');
 $chain = $config['chain'];
 $url = $config['url'];
 $username = $config['rkuser'];
 $pass = $config['passwd'];
 $port = $config['port'];

class address

 {  
function getAddress(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getnewaddress\",\"params\":[],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: getnewaddress");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
             //print_r($result);
        $address = $result->result;
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $address;
    }



// $testObject = new address();
// $res = $testObject->getAddress();       
// echo($res);




function retrieveAddresses() {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getaddresses\",\"params\":[],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
    ));
    error_log("Sending request: getaddresses");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
         //print_r($result);
        $addresses = $result->result;
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $addresses;    
    }

function checkifvalid($address) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"validateaddress\",\"params\":[\"$address\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: validateaddress");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
         //print_r($result);
        $valaddress = $result->result->isvalid;
        if($valaddress == 1){
            $status = "Address is valid";
        } else {
            $status = "Address is not valid";
        }
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $status;
    }


function checkifmineallowed($address) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"validateaddress\",\"params\":[\"$address\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: validateaddress");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
         //print_r($result);
        $valaddress = $result->result->ismine;
        if($valaddress == 1){
            $status = "Address has mining permission";
        } else {
            $status = "Address has not given mining permission";
        }
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $status;
    }

function checkBalance($address) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getaddressbalances\",\"params\":[\"$address\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: getaddressbalances");
    $result   = json_decode(curl_exec($curl));

    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        
        $balance = $result->result[0]->qty;
        
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $balance;
    }

function importAddress($public_address) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"importaddress\",\"params\":[\"$public_address\",\"\", false],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: importaddress");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        
        $resu= $result->result;
        
        $error= $result->error;

        

        if($resu == null && $error== null){
            $print = "Address successfully imported";
        }
        else if($resu == null and $error != null) {
        $print = $result->error->message;
        }
        

    return $print;
    }

function getMultisigAddress($nrequired,$key) {

$myArray = explode(',',$key);

$myArray2 = implode('","', $myArray);


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
        CURLOPT_POSTFIELDS => "{\"method\":\"createmultisig\",\"params\":[$nrequired, [\"$myArray2\"]],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: createmultisig");
    $result   = json_decode(curl_exec($curl));

    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($httpCode == 200 && $result->error == null) {

        
         $address = $result->result->address;

          if($address == null) {
            $res= $result->result->error->message;
        }
        else {
            $res= $result->result->address;
        }




    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $res;
    }

function getMultisigwalletAddress($nrequired,$key) {

$myArray = explode(',',$key);

$myArray2 = implode('","', $myArray);


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
        CURLOPT_POSTFIELDS => "{\"method\":\"addmultisigaddress\",\"params\":[$nrequired, [\"$myArray2\"]],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: addmultisigaddress");
    $result   = json_decode(curl_exec($curl));

    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($httpCode == 200 && $result->error == null) {
         
         $address = $result->result;

          if($address == null) {
            $res = $result->result->error->message;
        }
        else {
            $res = $result->result;
        }

    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $res;
    }


}

?>