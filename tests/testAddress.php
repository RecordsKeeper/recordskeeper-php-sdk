<?php

use PHPUnit\Framework\TestCase;
require '../source/address.php';

 $config = include('../../../../config.php');
$validaddress = $config['validaddress'];
$invalidaddress=$config['invalidaddress'];
$miningaddress =$config['miningaddress'];
$nonminingaddress =$config['nonminingaddress'];
$pubkey1=$config['pubkey1'];
$pubkey2=$config['pubkey2'];
$pubkey3=$config['pubkey3'];
$multisigaddress=$config['multisigaddress'];
$wrongimportaddress=$config['wrongimportaddress'];

class testAddress extends TestCase
{
    
    public function test_getAddress()
    {
    	$testObject2 = new address();
        $address = $testObject2->getAddress();
		$this->assertEquals(34,strlen($address));
    }

    public function test_checkifvalid()
    {
    	$testObject2= new address();
    	
    	$address=$testObject2->checkifvalid($GLOBALS['validaddress']);
    	$this->assertEquals("Address is valid", $address);
    }

    public function test_failcheckifvalid()
    {
    	$testObject2=new address();
    	$address=$testObject2->checkifvalid($GLOBALS['invalidaddress']);
    	$this->assertEquals("Address is not valid", $address);
    }

    public function test_checkifmineallowed()
    {
    	$testObject2=new address();
    	$address=$testObject2->checkifmineallowed($GLOBALS['miningaddress']);
    	$this->assertEquals("Address has mining permission", $address);
    }

    public function test_failcheckifmineallowed()
    {
    	$testObject2=new address();
    	$address=$testObject2->checkifmineallowed($GLOBALS['nonminingaddress']);
    	$this->assertEquals("Address has not given mining permission", $address);
    }

     public function test_checkBalance()
    {
    	$testObject2=new address();
    	$address=$testObject2->checkBalance($GLOBALS['nonminingaddress']);
    	$this->assertEquals(7.9, $address);
    }

      public function test_getMultisigwalletAddress()
    {
    	$testObject2=new address();
    	$key = $GLOBALS['pubkey1'].",".$GLOBALS['pubkey2'].",".$GLOBALS['pubkey3'];
    	//echo ($key);
    	$address=$testObject2->getMultisigwalletAddress(2,$key);
    	
    	//print_r($address);
    	$this->assertEquals($GLOBALS['multisigaddress'], $address);
    }

      public function test_getMultisigAddress()
    {
    	$testObject2=new address();
    	$key = $GLOBALS['pubkey1'].",".$GLOBALS['pubkey2'].",".$GLOBALS['pubkey3'];
    	//echo ($key);
    	$address=$testObject2->getMultisigAddress(2,$key);
    	
    	// print_r($address);
    	$this->assertEquals($GLOBALS['multisigaddress'], $address);
    }


      public function test_importAddress()
     {
    	$testObject2=new address();
    	//$key = $GLOBALS['pubkey1'].",".$GLOBALS['pubkey2'].",".$GLOBALS['pubkey3'];
    	//echo ($key);
    	$address=$testObject2->importAddress($GLOBALS['miningaddress']);
    	
    	// print_r($address);
    	$this->assertEquals("Address successfully imported", $address);
    }


      public function test_wrongimportAddress()
     {
    	$testObject2=new address();
    	//$key = $GLOBALS['pubkey1'].",".$GLOBALS['pubkey2'].",".$GLOBALS['pubkey3'];
    	//echo ($key);
    	$address=$testObject2->importAddress($GLOBALS['wrongimportaddress']);
    	
    	// print_r($address);
    	$this->assertEquals("Invalid Rk address or script", $address);
    }
}

?>


