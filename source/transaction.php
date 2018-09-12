<?php

namespace recordskeeper\recordskeepersdk;
error_reporting(0);
class Transaction {

    public $config;

 function __construct(array $config) {
     $this->chain = $config['chain'];
     $this->url = $config['url'];
     $this->username = $config['rkuser'];
     $this->pass = $config['passwd'];
     $this->port = $config['port'];
 } 
	function sendTransaction($sender_address,$receiver_address,$data,$amount) {
    
    $hex_data = bin2hex($data);

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_PORT => $this->port,
    CURLOPT_URL => $this->url,
    CURLOPT_USERPWD => $this->username. ":" . $this->pass,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"createrawsendfrom\",\"params\":[\"$sender_address\",{\"$receiver_address\" 
         :  $amount}, [\"$hex_data\"], \"send\"],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $txid = $result->result;
    if($txid == null){
        $txid =  $result->error->message;
    } else {
        $txid = $txid;
        }
    return $txid;
    }

function createRawTransaction($sender_address,$receiver_address,$data,$amount) {
$hex_data = bin2hex($data);
     
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_PORT => $this->port,
    CURLOPT_URL => $this->url,
    CURLOPT_USERPWD => $this->username. ":" . $this->pass,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"createrawsendfrom\",\"params\":[\"$sender_address\",{\"$receiver_address\" 
         :  $amount}, [\"$hex_data\"]],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $txHex = $result->result;
    if($txHex == null){
        $txHex =  $result->error->message;
    } else {
        $txHex = $txid;
        }
    return $txHex;
    }


function signRawTransaction($tx_hex,$private_key) {

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_PORT => $this->port,
    CURLOPT_URL => $this->url,
    CURLOPT_USERPWD => $this->username. ":" . $this->pass,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"signrawtransaction\",\"params\":[\"$tx_hex\",[],[\"$private_key\"]],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $response =$result->result->complete;
    if($response == false){
            $signedtxHex = "Transaction has not signed";
        } else {
            $signedtxHex = $result->result->hex;
        }

    return $signedtxHex;
    }


function sendRawTransaction($signed_txhex) {
        
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_PORT => $this->port,
    CURLOPT_URL => $this->url,
    CURLOPT_USERPWD => $this->username. ":" . $this->pass,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"sendrawtransaction\",\"params\":[\"$signed_txhex\"],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $txid= $result->result;
    if($txid == null){
        $txid =  $result->error->message;
    } else {
        $txid = $txid;
        }

    return $txid;
    }

function sendSignedTransaction($sender_address,$reciever_address,$private_key,$data,$amount) {
        $hex_data = bin2hex($data);
        
        $dumptxHex = $this->createrawtransaction($sender_address,$reciever_address,$hex_data,$amount);
        
        $signedtxHex = $this->signrawtransaction($dumptxHex,$private_key);
        
        $txid = $this->sendrawtransaction($signedtxHex);
    
    return $txid;
}

function retrieveTransaction($txid){
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_PORT => $this->port,
    CURLOPT_URL => $this->url,
    CURLOPT_USERPWD => $this->username. ":" . $this->pass,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"getrawtransaction\",\"params\":[\"$txid\",1],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if($result->result==null){
        $tx_info = $result->error->message;
    } else {
    $hexdata = $result->result->data[0];
    $sentdata  =hex2bin($hexdata);
    $sentamount =  $result->result->vout[0]->value;
    $response = array("data" => $sentdata,"value" => $sentamount);
    $tx_info = json_encode($response, JSON_PRETTY_PRINT);
}
    return $tx_info;
}

function getFee($txid,$address){
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_PORT => $this->port,
    CURLOPT_URL => $this->url,
    CURLOPT_USERPWD => $this->username. ":" . $this->pass,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"getaddresstransaction\",\"params\":[\"$address\",\"$txid\",true],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if($result->result==null){
        $fee = $result->error->message;
    } else {
    $sentamount = $result->result->vout[0]->amount;
    $balanceamount =  $result->result->balance->amount;
    $fee = (abs($balanceamount) - $sentamount);
  }
    return $fee;
}

}
?>



