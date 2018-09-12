<?php
namespace recordskeeper\recordskeepersdk;
error_reporting(0);
class Stream {  

public $config;

 function __construct(array $config) {
     $this->chain = $config['chain'];
     $this->url = $config['url'];
     $this->username = $config['rkuser'];
     $this->pass = $config['passwd'];
     $this->port = $config['port'];
 } 

 
function publish($address,$stream, $key, $data){
$hex_data = bin2hex($data);
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
    CURLOPT_POSTFIELDS => "{\"method\":\"publishfrom\",\"params\":[\"$address\",\"$stream\",\"$key\",\"$hex_data\"],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
             $txid =$result->result;
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
             $txid =$result->error->message;
    }
    return $txid;
    }

function retrieveData($stream,$txid){
   
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getstreamitem\",\"params\":[\"$stream\",\"$txid\"],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        $data =$result->result->data;
        $rawdata = hex2bin($data);
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        $rawdata = $result->error->message;
    }

    return $rawdata;
    }

function retrieveWithAddress($stream, $address, $count){
   
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
    CURLOPT_POSTFIELDS => "{\"method\":\"liststreampublisheritems\",\"params\":[\"$stream\",\"$address\", false, $count],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        $keys=[];
        $txids=[];
        $count = count($result->result);
        $datas= [];
        for($i=0;$i<$count;$i++){
        $data = $result->result[$i]->data;
        $key =  $result->result[$i]->key;
        $txid = $result->result[$i]->txid;
        $stringdata=hex2bin($data);
        array_push($datas,$stringdata);
        array_push($keys, $key);
        array_push($txids,$txid);
}
        $response = array("data" => $datas,"key" => $keys,"txid" =>$txids);
        $publisher_items = json_encode($response, JSON_PRETTY_PRINT);
} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        $publisher_items = $result->error->message;
    }
return $publisher_items;
    }



function retrieveWithKey($stream, $key, $count){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"liststreamkeyitems\",\"params\":[\"$stream\",\"$key\", false, $count],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        $datas=[];
        $publishers=[];
        $txids=[];
        $count = count($result->result);
        for($i=0;$i<$count;$i++){
        $data =$result->result[0]->data;
        $publisher= $result->result[0]->publishers[0];
        $txid=$result->result[0]->txid;
        $raw_data = hex2bin($data);
        array_push($datas, $raw_data);
        array_push($publishers, $publisher);
        array_push($txids, $txid);
    }
        $response = array("data" => $datas,"publishers" => $publishers,"txid" =>$txids);
        $key_items = json_encode($response, JSON_PRETTY_PRINT);
    } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        $key_items = $result->result->message;
    }
    return $key_items;
    }

function verifyData($stream,$data,$count){
  
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
    CURLOPT_POSTFIELDS => "{\"method\":\"liststreamitems\",\"params\":[\"$stream\",false,$count],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
        $count=count($result->result);
        $result_data = [];
        for($i=0;$i<$count;$i++){
        $hexdata = $result->result[$i]->data;
        array_push($result_data,hex2bin($hexdata));
        }
        if (in_array($data,$result_data)) {
            $result = "Data  verified.";
        } else {
            $result = "Data not verified.";
    }
} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        $result = $result->error->message; 
    }
    return $result;
}


  
function retrieveItems($stream,$count){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"liststreamitems\",\"params\":[\"$stream\",false,$count],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: liststreamitems");
    $result   = json_decode(curl_exec($curl));
    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode == 200 && $result->error == null) {
    $count =count($result->result);
    $addresses=[];
    $keys=[];
    $datas=[];
    $txids=[];

    for($i=0;$i<$count;$i++){
        $address= $result->result[$i]->publishers;
        $keyvalue=$result->result[$i]->key;
        $data=$result->result[$i]->data;
        $raw_data=hex2bin($data);
        $txid=$result->result[$i]->txid;
        array_push($addresses, $address);
        array_push($datas, $raw_data);
        array_push($keys, $key);
        array_push($txids, $txid);
} 

        $response = array("address" => $addresses,"key" => $keys,"data" => $datas,"txid" => $txids);
        $items = json_encode($response, JSON_PRETTY_PRINT);

} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
        $items = $result->error->message;
   }
    return $items;
  }

}

?>