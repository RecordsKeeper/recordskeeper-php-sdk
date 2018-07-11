<?php

use PHPUnit\Framework\TestCase;
require '../source/stream.php';

$config = include('test_config.php');
$miningaddress= $config['miningaddress'];
$stream=$config['stream'];
$txid =$config['txid'];
// echo $stream;
$testdata=$config['testdata'];
$key=$config['key'];
// $validaddress1 =$config['validaddress1'];


class testStream extends TestCase
{
    
    public function test_publish()
    {
    	$testObject2 = new stream();
    	
        $stream = $testObject2->publish($GLOBALS['miningaddress'],$GLOBALS['stream'],$GLOBALS['key'],$GLOBALS['testdata']);
        $size=strlen($stream);
        // print_r($size);

        //print_r($stream);
		$this->assertEquals(64,$size);
    }


       public function test_retrieve_with_txid()
    {
    	$testObject2 = new stream();
    	// $hexdata =bin2hex($GLOBALS['testdata']);
        $ret = $testObject2->retrieve($GLOBALS['stream'],$GLOBALS['txid']);
        // $size=strlen($ret);
      // print_r($ret);

          // $data=$ret->result->data;
          // $stri = hex2bin($data);
      
		$this->assertEquals($GLOBALS['testdata'],$ret);
    }
     public function test_retrieve_with_address()
    {
    	$testObject2 = new stream();
    	// $hexdata =bin2hex($GLOBALS['testdata']);
        $withaddress = $testObject2->retrieveWithAddress($GLOBALS['stream'],$GLOBALS['miningaddress']);
        // $size=strlen($stream);
        $data = json_decode($withaddress, true);
        $result = $data['data'][7];

		$this->assertEquals("testdata",$result);
    }


    public function test_retrieve_with_key()
    {
    	$testObject2 = new stream();
    	// $hexdata =bin2hex($GLOBALS['testdata']);
        $withaddress = $testObject2->retrieveWithKey($GLOBALS['stream'],$GLOBALS['key']);
        // $size=strlen($stream);
        $data = json_decode($withaddress, true);
        $result = $data['data'][0];
            // print_r($result);
		$this->assertEquals("7465737464617461",$result);
    }

     public function test_verifydata()
    {
    	$testObject2 = new stream();
    	// $hexdata =bin2hex($GLOBALS['testdata']);
        $result = $testObject2->verifydata($GLOBALS['stream'],$GLOBALS['testdata'],5);
        // $size=strlen($stream);
  //       $data = json_decode($withaddress, true);
  //       $result = $data['data'][0];
            // print_r($withaddress);
		$this->assertEquals("Data  verified.",$result);
    }

    public function test_retrieveItems()
    {
    	$testObject2 = new stream();
    	// $hexdata =bin2hex($GLOBALS['testdata']);
        $result = $testObject2->retrieveItems($GLOBALS['stream'],20);
        // $size=strlen($stream);
        $data = json_decode($result, true);
        $datas = $data['data'];
           // print_r($datas);
		$this->assertEquals($GLOBALS['testdata'],$datas);
    }
}
?>    