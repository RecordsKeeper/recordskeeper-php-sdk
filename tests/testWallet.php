<?php

use PHPUnit\Framework\TestCase;
require '../source/wallet.php';

$config = include('test_config.php');
$newaddress =$config['newaddress'];
$Kprivkey =$config['Kprivkey'];
$testdata=$config['testdata'];
$signedmessage =$config['signedmessage'];


class testWallet extends TestCase
{
    
    public function test_creatWallet()
    {
    	$testObject2 = new wallet();
        $createwallet = $testObject2->createwallet();
        // print_r($createwallet);
        $data = json_decode($createwallet, true);
        $address=$data['address'];
        // print_r($address);
        $size =strlen($address);
        // print_r($size);

		$this->assertEquals(38,$size);
    }
     public function test_getPrivateKey()
    {
    	$testObject2 = new wallet();
        $privkey = $testObject2->getPrivateKey($GLOBALS['newaddress']);
        $this->assertEquals($GLOBALS['Kprivkey'],$privkey);
        
        
    }

      public function test_retrieveWalletinfo()
    {
    	$testObject2 = new wallet();
        $wallinfo = $testObject2->retrieveWalletinfo();
         $data = json_decode($wallinfo, true);
        // print_r($data);
         $balance=$data['balance'];
     $this->assertGreaterthan(0,$balance);
        
        
    }


      public function test_signMessage()
    {
    	$testObject2 = new wallet();
        $sign = $testObject2->signMessage($GLOBALS['Kprivkey'],$GLOBALS['testdata']);
         // print_r($sign);
     $this->assertEquals($GLOBALS['signedmessage'],$sign);
        
        
    }
      public function test_verifyMessage()
    {
    	$testObject2 = new wallet();
        $verify = $testObject2->verifyMessage($GLOBALS['newaddress'],$GLOBALS['signedmessage'],$GLOBALS['testdata']);
         // print_r($verify);
     $this->assertEquals("Yes, message is verified",$verify);
        
        
    }

 }
 ?>   