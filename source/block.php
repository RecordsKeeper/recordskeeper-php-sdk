<?php

 $config = include('../../../../config.php');
 $chain = $config['chain'];
 $url = $config['url'];
 $username = $config['rkuser'];
 $pass = $config['passwd'];
 $port = $config['port'];

class block
{  
function blockinfo($block_height){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getblock\",\"params\":[\"$block_height\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
  error_log("Sending request: getblock");
  $result   = json_decode(curl_exec($curl));
  $err      = curl_error($curl);
  $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  if ($httpCode == 200 && $result->error == null) {    
      $block =count($result->result->tx);
     
      $miner =$result->result->miner;
      $size =$result->result->size;
      $nonce =$result->result->nonce;
      $blockhash =$result->result->hash;
      $prevblock =$result->result->previousblockhash;
      $nextblock =$result->result->nextblockhash;
      $merkleroot=$result->result->merkleroot;
      $blocktime =$result->result->time;
      $difficulty=$result->result->difficulty;

       $tx=[];
       for($i=0;$i<$block;$i++){
          array_push($tx, $result->result->tx[$i]);
       }
      $myJSON = array("tx[0]" => $block,"tx"=> $tx ,"miner" => $miner,"size" =>$size,"nonce" =>$nonce,"hash" =>$blockhash,"previousblockhash" =>$prevblock,"nextblockhash" =>$nextblock,"merkleroot" =>$merkleroot,"time" =>$blocktime,"difficulty" =>$difficulty);
      $jsonstring = json_encode($myJSON, JSON_PRETTY_PRINT);
       
  } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
      error_log("ERROR: Info not fetched from blockchain");
  }
   return $jsonstring;
  }

function retreiveblocks($block_range){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"listblocks\",\"params\":[\"$block_range\"],\"id\":1,\"chain_name\":\"" . $GLOBALS["chain"] . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
  error_log("Sending request: listblocks");
  $result   = json_decode(curl_exec($curl));
  $err      = curl_error($curl);
  $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  if ($httpCode == 200 && $result->error == null) {
           
      $block =count($result->result);

       $allresult1=[];
       $hash= [];
       $miner=[];
       $blocktime=[];
       $tx_count=[];

        for($i=0;$i<$block;$i++){
          $hash1= $result->result[$i]->hash;
          
          $miner1=$result->result[$i]->miner;
          
          $blocktime1=$result->result[$i]->time;
          
          $tx_count1=$result->result[$i]->txcount;

           array_push($hash, $hash1);
        array_push($miner, $miner1);
         array_push($blocktime, $blocktime1);
          array_push($tx_count, $tx_count1);
          

       }
       $myJSON = array("miner" => $miner,"hash"=> $hash ,"time" =>$blocktime,"txcount" =>$tx_count);
       $jsonstring = json_encode($myJSON, JSON_PRETTY_PRINT);
      
      

    return $jsonstring;

  }
}
}

?>