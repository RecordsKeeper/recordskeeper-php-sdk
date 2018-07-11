<?php

$config = include('config.php');


 $chain = $config['chain'];
 $url = $config['url'];
 $username = $config['rkuser'];
 $pass = $config['passwd'];
 $port = $config['port'];

class stream

 {  
function  publish($address,$stream, $key, $data){
    $hex_data = bin2hex($data);
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
    CURLOPT_POSTFIELDS => "{\"method\":\"publishfrom\",\"params\":[\"$address\",\"$stream\",\"$key\",\"$hex_data\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
error_log("Sending request: publishfrom");
$result   = json_decode(curl_exec($curl));
$err      = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($httpCode == 200 && $result->error == null) {
         $res=$result->result;
    

} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
    error_log("ERROR: Info not fetched from blockchain");
}

return $res;
}

function  retrieve($stream,$txid){
   
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getstreamitem\",\"params\":[\"$stream\",\"$txid\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
error_log("Sending request: getstreamitem");
$result   = json_decode(curl_exec($curl));
$err      = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($httpCode == 200 && $result->error == null) {
    $data =$result->result->data;
         $rawdata = hex2bin($data);
    
    

} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
    error_log("ERROR: Info not fetched from blockchain");
}

return $rawdata;
}

function  retrieveWithAddress($stream,$address){
   
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
    CURLOPT_POSTFIELDS => "{\"method\":\"liststreampublisheritems\",\"params\":[\"$stream\",\"$address\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
error_log("Sending request: liststreampublisheritems");
$result   = json_decode(curl_exec($curl));
$err      = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($httpCode == 200 && $result->error == null) {

    $key1=[];
    $resultall=[];
    $txid1=[];
    $count1 = count($result->result);
     
    $data1= [];
     for($i=0;$i<$count1;$i++){
        
    $data = $result->result[$i]->data;
    $key =  $result->result[$i]->key;
    $txid = $result->result[$i]->txid;
    $stringdata=hex2bin($data);
    array_push($data1,$stringdata);
    array_push($key1, $key);
    array_push($txid1,$txid);

    }
         $myJSON = array("data" => $data1,"key" => $key1,"txid" =>$txid1);
    $json_string = json_encode($myJSON, JSON_PRETTY_PRINT);

    

} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
    error_log("ERROR: Info not fetched from blockchain");
}

return $json_string;
}

function  retrieveWithKey($stream,$key){
   
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
    CURLOPT_POSTFIELDS => "{\"method\":\"liststreamkeyitems\",\"params\":[\"$stream\",\"$key\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
error_log("Sending request: liststreamkeyitems");
$result   = json_decode(curl_exec($curl));
$err      = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($httpCode == 200 && $result->error == null) {


     $data1=[];
     $key1=[];
     $txid1=[];
    
    $data =$result->result[0]->data;
    $publishers= $result->result[0]->publishers[0];
    $txid=$result->result[0]->txid;
         $raw_data = hex2bin($data);

         array_push($data1, $data);
         array_push($key1, $key);
         array_push($txid1, $txid);
      

         $myJSON = array("data" => $data1,"key" => $key1,"txid" =>$txid1);
    $json_string = json_encode($myJSON, JSON_PRETTY_PRINT);
    

} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
    error_log("ERROR: Info not fetched from blockchain");
}

return $json_string;
}

function  verifydata($stream,$data,$count){
  
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
    CURLOPT_POSTFIELDS => "{\"method\":\"liststreamitems\",\"params\":[\"$stream\",false,$count],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
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
    $count=count($result->result);
    
  $result_data=[];
     
     
     for($i=0;$i<$count;$i++){
        
        $hexdata = $result->result[$i]->data;
        
        
     }
   
     if (is_string($hexdata))
    {
     array_push($result_data,hex2bin($hexdata));
     }    
     else {
            echo "No";
          }

    if (in_array($data,$result_data)) {

            $result = "Data  verified.";
    }
        else{

            $result = "Data not verified.";
}


    
    

} 
else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
    error_log("ERROR: Info not fetched from blockchain");
}

return $result;
}


  
function retrieveItems($stream,$count){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"liststreamitems\",\"params\":[\"$stream\",false,$count],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
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
  
    $result_data =count($result->result);

     $resultall=[];
     $address1=[];
     $keyvalue1=[];
     $data1=[];
     $txid1=[];

      for($i=0;$i<$result_data;$i++){
        $address= $result->result[$i]->publishers;
        $keyvalue=$result->result[$i]->key;
        $data=$result->result[$i]->data;
        $raw_data=hex2bin($data);
        $txid=$result->result[$i]->txid;

        array_push($address1, $address);
        array_push($data1, $data);
        array_push($keyvalue1, $keyvalue);
        array_push($txid1, $txid);
         

     }
     array_push($resultall,$address1,$keyvalue1,$data1,$txid1); 

     $myJSON = array("address" => $address1,"keyvalue" => $keyvalue1,"data" => $raw_data,"txid" => $txid1);
    $json_string = json_encode($myJSON, JSON_PRETTY_PRINT);


} else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
    error_log("ERROR: Info not fetched from blockchain");
}
return $json_string;
}

}

// $testObject2 = new stream();
//  $res = $testObject2->retrieveWithAddress();

//  print_r($res);
 ?>