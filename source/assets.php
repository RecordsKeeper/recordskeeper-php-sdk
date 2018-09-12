<?php

namespace recordskeeper\recordskeepersdk;
error_reporting(0);

class Assets {
public $config;
function __construct(array $config) {
     $this->chain = $config['chain'];
     $this->url = $config['url'];
     $this->username = $config['rkuser'];
     $this->pass = $config['passwd'];
     $this->port = $config['port'];
 }  

function createAsset($address,$assetname,$assetqty) {
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_PORT => $this->port,
    CURLOPT_URL => $this->url,
    CURLOPT_USERPWD => $this->username. ":" .$this->pass,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"method\":\"issue\",\"params\":[\"$address\",\"$assetname\",$assetqty],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
$result   = json_decode(curl_exec($curl));
$err      = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$response = $result->result;
if ($response != null) {
    $txid = $response;
    }
else {
    $txid = $result->error->message;
}
return $txid;
}


function retrieveAssets() {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"listassets\",\"params\":[],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
         $assetcount = count($result->result);
         $asset_names=[];
         $issue_ids=[];
         $issue_qtys=[];
         for($i=0;$i<$assetcount;$i++){
         	$asset_name = $result->result[$i]->name;
    	    $issue_id = $result->result[$i]->issuetxid;
            $issue_qty = $result->result[$i]->issueraw;
            array_push($asset_names,$asset_name);
            array_push($issue_ids,$issue_id);
            array_push($issue_qtys,$issue_qty);
         }
    $response = array("asset_count" => $assetcount,"asset_name"=> $asset_names ,"tx_id" => $issue_ids,"asset_qty" =>$issue_qtys);
    $assets_info = json_encode($response, JSON_PRETTY_PRINT);
         
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        $assets_info = $result->error->message;
    }
    return $assets_info;
    }


function sendAsset($to_address,$assetname,$qty) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"sendasset\",\"params\":[\"$to_address\",\"$assetname\",$qty],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $response = $result->result;
    if ($response != null) {
    $txid = $response;
    } else {
    $txid = $result->error->message;
}
    return $txid;
}

?>
