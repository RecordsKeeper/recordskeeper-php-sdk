<?php

namespace recordskeeper\recordskeepersdk;
error_reporting(0);

class Blockchain {  

  public $config;

 function __construct(array $config) {
     $this->chain = $config['chain'];
     $this->url = $config['url'];
     $this->username = $config['rkuser'];
     $this->pass = $config['passwd'];
     $this->port = $config['port'];
 } 

 
function getChainInfo(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getblockchainparams\",\"params\":[],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        $chaininfo = (array)$result->result;
        $chain_protocol = $chaininfo['chain-protocol'];
        $chain_description = $chaininfo['chain-description'];
        $root_stream= $chaininfo['root-stream-name'];
        $max_blocksize = $chaininfo['maximum-block-size'];
        $default_networkport= $chaininfo['default-network-port'];
        $default_rpcport = $chaininfo['default-rpc-port'];
        $mining_diversity = $chaininfo['mining-diversity'];
        $response = array("chain-protocol" => $chain_protocol,"chain-description" => $chain_description,"root-stream-name" =>$root_stream,"maximum-block-size" =>$max_blocksize,"default-network-port" =>$default_networkport,"default-rpc-port" =>$default_rpcport,"mining-diversity" =>$mining_diversity);
        $chain_info = json_encode($response, JSON_PRETTY_PRINT);
} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        $chain_info = $result->error->message;
}
    return $chain_info;
}

function getNodeInfo(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getinfo\",\"params\":[],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: getinfo");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        $node_balance = $result->result->balance;
        $synced_blocks = $result->result->blocks;
        $node_address =$result->result->nodeaddress;
        $difficulty =$result->result->difficulty;

        $response = array("balance" => $node_balance,"blocks" => $synced_blocks,"nodeaddress" =>$node_address,"difficulty" =>$difficulty);
        $node_info = json_encode($response, JSON_PRETTY_PRINT);
       } 

     else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        $node_info = $result->error->message;
    }
        return $node_info;
    }

function Permissions(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"listpermissions\",\"params\":[],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        $count = count($result->result);
        $permissions = [];
    for ($i = 0; $i <$count; $i++) {
      $type = $result->result[$i]->type;
      array_push($permissions,$type);
    }
    $permissions = json_encode($permissions, JSON_PRETTY_PRINT);
}  else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        $permissions = $result->error->message;
    }
return $permissions; 
    }

function getPendingTransactions(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getmempoolinfo\",\"params\":[],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        $mempool = $result->result->size; 
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getrawmempool\",\"params\":[],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $tx_count = count($result->result);
    $tx = [];
    for ($i = 0; $i < $mempool;$i++) {
    $tx_info = $result->result[$i];
       array_push($tx, $tx_info);
}
    $res = array("tx" => $tx,"tx_count" => $tx_count);
    $json_response = json_encode($res, JSON_PRETTY_PRINT);  

      if ($tx_info==null)
      {
        $pending_tx = "No pending transactions";
      } else{
        $pending_tx = $json_response;
        }

     return $pending_tx;
    }
}



function checkNodeBalance(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getmultibalances\",\"params\":[],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: getmultibalances");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
    $node_balance = $result->result->total[0]->qty;
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
    $node_balance = $result->error->message;
    }

    return $node_balance;
    }
}
?>
