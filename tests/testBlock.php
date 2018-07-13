<?php

use PHPUnit\Framework\TestCase;
require '../source/block.php';

 $config = include('../../../../config.php');
//$validaddress1 =$config['validaddress1'];\
$mainaddress=$config['mainaddress'];
$merkleroot =$config['merkleroot'];
$blockhash = $config['blockhash'];

class testBlock extends TestCase
{
    
    public function test_blockinfo()
    {
    	$testObject2 = new block();
        $blockinfo = $testObject2->blockinfo("100");
        $data = json_decode($blockinfo, true);
        $miner= $data['miner'];
		$this->assertEquals($GLOBALS['mainaddress'],$miner);


		
        $size= $data['size'];
		$this->assertEquals(300,$size);

		 $nonce= $data['nonce'];
		$this->assertEquals(260863,$nonce);

         $merkleroot= $data['merkleroot'];
		$this->assertEquals($GLOBALS['merkleroot'],$merkleroot);



		
    }

   public function test_retreiveblocks()
    {
    	$testObject2 = new block();
        $retblock = $testObject2->retreiveblocks("10-20");
        $data = json_decode($retblock, true);
        // print_r($retblock);
        $miner= $data['miner'][0];
         //print_r($miner);		
         $this->assertEquals($GLOBALS['mainaddress'],$miner);
         // print_r($miner);

    
        //    $blocktime= $data['time'][2];
        // // print_r($blocktime);		
        //  $this->assertEquals(1522831624 ,$blocktime);
        //  // print_r($data);		
        // $blockhash=$data['hash'][4];
        //  $this->assertEquals($GLOBALS['blockhash'] ,$blockhash);

        //  $txcount =$data['txcount'][3];
        //   $this->assertEquals(1,$txcount);


		
  //       $size= $data['size'];
		// $this->assertEquals(300,$size);

		//  $nonce= $data['nonce'];
		// $this->assertEquals(260863,$nonce);

  //        $merkleroot= $data['merkleroot'];
		// $this->assertEquals($GLOBALS['merkleroot'],$merkleroot);



		
    }



}
?>    