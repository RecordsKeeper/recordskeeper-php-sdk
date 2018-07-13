<?php


 $config = include('../../../../config.php');


 $chain = $config['chain'];
 $url = $config['url'];
 $username = $config['rkuser'];
 $pass = $config['passwd'];
 $port = $config['port'];




class Transaction
{
	function sendtransaction($sender_address,$receiver_address,$data,$amount) {
    
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
    CURLOPT_POSTFIELDS => "{\"method\":\"createrawsendfrom\",\"params\":[\"$sender_address\",{\"$receiver_address\" 
         :  $amount}, [\"$hex_data\"], \"send\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: createrawsendfrom");
    $result   = json_decode(curl_exec($curl));

    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $txid = $result->result;
    return $txid;
    }

function createrawtransaction($sender_address,$receiver_address,$data,$amount) {
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
    CURLOPT_POSTFIELDS => "{\"method\":\"createrawsendfrom\",\"params\":[\"$sender_address\",{\"$receiver_address\" 
         :  $amount}, [\"$hex_data\"]],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: createrawsendfrom");
    $result   = json_decode(curl_exec($curl));

    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $createraw = $result->result;

    return $createraw;
    }

function signrawtransaction($tx_hex,$private_key) {

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
    CURLOPT_POSTFIELDS => "{\"method\":\"signrawtransaction\",\"params\":[\"$tx_hex\",[],[\"$private_key\"]],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: signrawtransaction");
    $result   = json_decode(curl_exec($curl));

    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

         $res=$result->result->complete;

        if($res == false){
            $status = "Transaction has not signed";
        } else {
            $status = $result->result->hex;
        }

    return $status;
    }


function sendrawtransaction($signed_txhex) {
        
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
    CURLOPT_POSTFIELDS => "{\"method\":\"sendrawtransaction\",\"params\":[\"$signed_txhex\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: sendrawtransaction");
    $result   = json_decode(curl_exec($curl));

    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

         $txid= $result->result;

          if($txid == null){
              $print =  $result->error->message;
          }
          else {
            $print = $txid;
        }

    return $print;
    }

function sendsignedtransaction($sender_address,$reciever_address,$private_key,$data,$amount) {
        $hex_data = bin2hex($data);
        
        $dumptxHex = $this->createrawtransaction($sender_address,$reciever_address,$hex_data,$amount);
        
        $signedtxHex = $this->signrawtransaction($dumptxHex,$private_key);
        
        $txid = $this->sendrawtransaction($signedtxHex);
    
    return $txid;
}

function retrievetransaction($txid){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getrawtransaction\",\"params\":[\"$txid\",1],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: getrawtransaction");
    $result   = json_decode(curl_exec($curl));

    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $retrievehexdata = $result->result->data[0];
        $sentdata  =hex2bin("$retrievehexdata");
        $sentamount =  $result->result->vout[0]->value;

         $myJSON = array("data" => $retrievehexdata,"value" => $sentamount);
        $json_string = json_encode($myJSON, JSON_PRETTY_PRINT);
        
    return $json_string;


    }

function getfee($txid,$address){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getaddresstransaction\",\"params\":[\"$address\",\"$txid\",true],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
    error_log("Sending request: getaddresstransaction");
    $result   = json_decode(curl_exec($curl));

    $err      = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $sentamount = $result->result->vout[0]->amount;
        $balanceamount =  $result->result->balance->amount;
        $fees = (abs($balanceamount) - $sentamount);
            
        

    return $fees;


}

}

// $testObject2 = new Transaction();
// $res = $testObject2->sendsignedtransaction();
// print_r($res);
?>



