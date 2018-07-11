<?php

use PHPUnit\Framework\TestCase;
require '../source/transactions.php';

$config = include('test_config.php');
$validaddress =$config['validaddress'];
$miningaddress =$config['miningaddress'];
$dumpsignedtxhex =$config['dumpsignedtxhex'];
$dumptxhex = $config['dumptxhex'];
$privatekey=$config['privatekey'];
$testdata=$config['testdata'];
$amount=$config['amount'];
$dumptxid =$config['dumptxid'];


class testTransactions extends TestCase
{
    
    public function test_sendtransaction()
    {
    	$testObject2 = new Transaction();
        $sendtrans = $testObject2->sendtransaction($GLOBALS['miningaddress'],$GLOBALS['validaddress'],"hello",0.2);
        $size=strlen($sendtrans);
     
		$this->assertEquals(64,$size);
		
    }

    public function test_sendrawtransaction()
    {
    	$testObject2 = new Transaction();
        $sendraw = $testObject2->sendrawtransaction($GLOBALS['dumpsignedtxhex']);
      
        $size=strlen($sendraw);

        
		$this->assertEquals(34,$size);

    }
    public function test_signrawtransaction()
    {
    	$testObject2 = new Transaction();
        $signraw = $testObject2->signrawtransaction($GLOBALS['dumptxhex'],$GLOBALS['privatekey']);
       
        $size=strlen($signraw);
       

		$this->assertEquals(26,$size);
    }
    public function test_createrawtransaction()
    {
    	$testObject2 = new Transaction();
        $createraw = $testObject2->createrawtransaction($GLOBALS['miningaddress'],$GLOBALS['validaddress'],$GLOBALS['testdata'],$GLOBALS['amount']);
       
       $size=strlen($createraw);

		$this->assertEquals(276,$size);
    }

     public function test_sendsignedtransaction()
    {
    	$testObject2 = new Transaction();
        $sendsigned = $testObject2->sendsignedtransaction($GLOBALS['miningaddress'],$GLOBALS['validaddress'],$GLOBALS['privatekey'],$GLOBALS['testdata'],$GLOBALS['amount']);
       
       $size= strlen($sendsigned);
        $this->assertEquals(64,$size);

		
  }
    public function test_retrievetransaction()
    {

    	$testObject2 = new Transaction();
        $rettrans = $testObject2->retrievetransaction($GLOBALS['dumptxid']);
         $data = json_decode($rettrans, true);
       	
        $datas=$data['data'];
        $hextostr=hex2bin("$datas");
        
        $this->assertEquals("hellodata",$hextostr);
    }

    public function test_getfee()
    {
    $testObject2 = new Transaction();
        $fee = $testObject2->getfee($GLOBALS['dumptxid'],$GLOBALS['miningaddress']);	
    
        $this->assertEquals(0.0251,$fee);
    }
}
?>   