<?php

 $config = include('../../../../config.php');
$chain = $config['chain'];
$url = $config['url'];
$username = $config['rkuser'];
$pass = $config['passwd'];
$port = $config['port'];

class blockchain

{  
function getchaininfo(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getblockchainparams\",\"params\":[],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: getblockchainparams");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
            
        $chaininfo = $result->result;
      

        $array =  (array) $chaininfo;
        


        $chain_protocol = $array['chain-protocol'];
        $chain_description = $array['chain-description'];
        $root_stream= $array['root-stream-name'];
        $max_blocksize = $array['maximum-block-size'];
        $default_networkport= $array['default-network-port'];
        $default_rpcport = $array['default-rpc-port'];
        $mining_diversity = $array['mining-diversity'];
        
        $myJSON = array("chain-protocol" => $chain_protocol,"chain-description" => $chain_description,"root-stream-name" =>$root_stream,"maximum-block-size" =>$max_blocksize,"default-network-port" =>$default_networkport,"default-rpc-port" =>$default_rpcport,"mining-diversity" =>$mining_diversity);
        $jsonstring = json_encode($myJSON, JSON_PRETTY_PRINT);
        

      
     } 

     else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        $jsonstring = "ERROR: Info not fetched from blockchain";
    }

     return $jsonstring;
    }

function getnodeinfo(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getinfo\",\"params\":[],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
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

         $myJSON = array("balance" => $node_balance,"blocks" => $synced_blocks,"nodeaddress" =>$node_address,"difficulty" =>$difficulty);
        $jsonstring = json_encode($myJSON, JSON_PRETTY_PRINT);
       
        
     } 

     else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }


    return $jsonstring;
    }

function permissions(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"listpermissions\",\"params\":[],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: listpermissions");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {

        
        $count = count($result->result);
        $permissions = [];
        
    for ($i = 0; $i <$count; $i++) {
      $perm = $result->result[$i]->type;
      array_push($permissions,$perm);
    }


      }  
      

     else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }

    return $permissions;
    }

function getpendingtransactions(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getmempoolinfo\",\"params\":[],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: getmempoolinfo");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {

        $mempool = $result->result->size; 

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
    CURLOPT_POSTFIELDS => "{\"method\":\"getrawmempool\",\"params\":[],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: getrawmempool");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
     

      $count = count($result->result);
     
       $tx = [];
     
     for ($i = 0; $i < $mempool;$i++) {

     $tx_info = $result->result[$i];
       array_push($tx, $tx_info);


    }
       

     $myJSON = array("tx" => $tx,"count" => $count);
     $json_string = json_encode($myJSON, JSON_PRETTY_PRINT);  

      if ($tx_info==null)
      {
        $res="No pending transactions";
      }
      else{
        $res = $json_string;
        }

     return $res;
    }
    }



function checknodebalance(){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getmultibalances\",\"params\":[],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
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

       
        $nodebal = $result->result->total[0]->qty;
        
      }  
      

     else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        error_log("ERROR: Info not fetched from blockchain");
    }

    return $nodebal;
    }
}



// $testObject2 = new blockchain();
// $res = $testObject2->getpendingtransactions();
// print_r($res);
?>
