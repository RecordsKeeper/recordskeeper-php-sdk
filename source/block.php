<?php

namespace recordskeeper\recordskeepersdk;
error_reporting(0);

class Block { 

public $config;

 function __construct(array $config) {
     $this->chain = $config['chain'];
     $this->url = $config['url'];
     $this->username = $config['rkuser'];
     $this->pass = $config['passwd'];
     $this->port = $config['port'];
 }  

function blockInfo($block_height){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"getblock\",\"params\":[\"$block_height\"],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
  $result   = json_decode(curl_exec($curl));
  $err      = curl_error($curl);
  $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  if ($httpCode == 200 && $result->error == null) {    
      $tx_count =count($result->result->tx);
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
      for($i=0;$i<$tx_count;$i++){
          array_push($tx, $result->result->tx[$i]);
       }
      $response = array("tx_count" => $tx_count,"tx"=> $tx ,"miner" => $miner,"size" =>$size,"nonce" =>$nonce,"hash" =>$blockhash,"previousblockhash" =>$prevblock,"nextblockhash" =>$nextblock,"merkleroot" =>$merkleroot,"time" =>$blocktime,"difficulty" =>$difficulty);
      $block_info = json_encode($response, JSON_PRETTY_PRINT);
       
  } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
      $block_info = $result->error->message;
  }
   return $$block_info;
  }

function retrieveBlocks($block_range){
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
    CURLOPT_POSTFIELDS => "{\"method\":\"listblocks\",\"params\":[\"$block_range\"],\"id\":1,\"chain_name\":\"" . $this->chain . "\"}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
    )
));
  $result   = json_decode(curl_exec($curl));
  $err      = curl_error($curl);
  $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  if ($httpCode == 200 && $result->error == null) {
      $block_count =count($result->result);
      $total_hash= [];
      $total_miner=[];
      $total_blocktime=[];
      $total_tx_count=[];
      
      for($i=0;$i<$block_count;$i++){
        $hash= $result->result[$i]->hash;
        $miner=$result->result[$i]->miner;
        $blocktime=$result->result[$i]->time;
        $tx_count=$result->result[$i]->txcount;
        array_push($total_hash, $hash);
        array_push($total_miner, $miner);
        array_push($total_blocktime, $blocktime);
        array_push($total_tx_count, $tx_count);
    }
       $response = array("miner" => $total_miner,"hash"=> $total_hash ,"block_time" =>$total_blocktime,"total_txcount" =>$total_tx_count);
       $block_info = json_encode($response, JSON_PRETTY_PRINT);
      } else if ($httpCode != 200 || ($httpCode == 200 && $result->error != null)) {
      $block_info = $result->error->message;
  }
  return $block_info;
  }
}

?>