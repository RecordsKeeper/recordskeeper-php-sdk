<?php

$config = include('config.php');


 $chain = $config['chain'];
 $url = $config['url'];
 $username = $config['rkuser'];
 $pass = $config['passwd'];
 $port = $config['port'];

class wallet

 {  
function createwallet(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"createkeypairs\",\"params\":[],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: createkeypairs");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

             $public_address=$result->result[0]->pubkey;
             $private_key=$result->result[0]->privkey;
             $Address=$result->result[0]->address;
        
        $myJSON = array("pubkey" => $public_address,"privkey" => $private_key,"address" =>$Address);
        $json_string = json_encode($myJSON, JSON_PRETTY_PRINT);


    return $json_string;
    }




    function importAddress($pubkey){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"importaddress\",\"params\":[\"pubkey\",[],false],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: importaddress");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        
        

    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }

           
     }

function getPrivateKey($public_address) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"dumpprivkey\",\"params\":[\"$public_address\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: dumpprivkey");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    // if ($httpCode == 200 && $result->error == null) {
         //print_r($result);
         if($result == null){
            $prikey = $request->error->message;
        } else {
            $prikey = $result->result;
         }

    return $prikey;
    }

function retrieveWalletinfo() {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getwalletinfo\",\"params\":[],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: getwalletinfo");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
       
        $balance = $result->result->balance;
        $tx_count = $result->result->txcount;
        $unspent_tx = $result->result->utxocount;

    $myJSON = array("balance" => $balance,"txcount" => $tx_count,"utxocount" =>$unspent_tx);
        $json_string = json_encode($myJSON, JSON_PRETTY_PRINT);

    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $json_string;
    }


function backupWallet($filename) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"backupwallet\",\"params\":[\"$filename\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: backupwallet");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
         
        if($result == null){
            $res = "backup successfull !";
        } else {
            $res = $result->error->message;
        }
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $res;
    }

function importWallet($filename) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"importwallet\",\"params\":[\"$filename\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: importwallet");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
         
       if($result == null){
            $res = "wallet is successfully imported!";
        } else {
            $res = $result->error->message;
        }
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $res;
    }

function dumpWallet($filename) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"dumpwallet\",\"params\":[\"$filename\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: dumpwallet");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
         
          if($result == null){
            $res = "wallet is successfully dumped!";
        } else {
            $res = $result->error->message;
        }
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $res;
    }

function lockWallet($password) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"lockwallet\",\"params\":[\"$password\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: lockwallet");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
         
          if($result == null){
            $res = "wallet is successfully encrypted!";
        } else {
            $res = $result->error->message;
        }
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $res;
    }

function UnlockWallet($password,$unlocktime) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"walletpassphrase\",\"params\":[\"$password\",\"$unlocktime\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: walletpassphrase");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
         
          if($result == null){
            $res = "wallet is successfully unlocked!";
        } else {
            $res = $result->error->message;
        }
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }
    return $res;
    }

function  changeWalletPassword($old_password,$new_password) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"walletpassphrasechange\",\"params\":[\"$old_password\",\"$new_password\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: walletpassphrasechange");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
         
          if($result == null){
            $res = "password successfully changed";
        } else {
            $res = $result->error->message;
        }
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain!");
    }
    return $res;
    }

function  signMessage($private_key,$message) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"signmessage\",\"params\":[\"$private_key\",\"$message\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: signmessage");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        
        $signmsg = $result->result;
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain!");
    }
    return $signmsg;
    }

function  verifyMessage($address,$signedmessage,$message) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"verifymessage\",\"params\":[\"$address\",\"$signedmessage\",\"$message\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: verifymessage");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {

        $verify =$result->result;
        
            if ($verify==true){
                $res = "Yes, message is verified";
            }
            else{
                $res = "No, signedMessage is not correct";
            }

                   
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain!");
    }
    return $res;
    }

}
// $testObject2 = new wallet();
//  $res = $testObject2->verifyMessage();
//  print_r($res);
 ?>