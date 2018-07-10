<?php

use PHPUnit\Framework\TestCase;
require '../source/permissions.php';

$config = include('test_config.php');
$permissionaddress =$config['permissionaddress'];
$wrongpermissionaddress=$config['wrongpermissionaddress'];


class testPermissions extends TestCase
{
    
    public function test_createasset()
    {
    	$testObject2 = new permissions();
        $txid = $testObject2->grantpermissions($GLOBALS['permissionaddress'],"create");
        // print_r($per);
        $size= strlen("$txid");
        // print_r($size);
		$this->assertEquals(64,$size);
    }
    public function test_revokepermissions()
    {
    	$testObject2 = new permissions();
        $txid = $testObject2->revokepermissions($GLOBALS['permissionaddress'],"create");
        // print_r($txid);
        $size= strlen("$txid");
        // print_r($size);
		$this->assertEquals(64,$size);
    }
      public function test_failgrantpermissions()
    {
    	$testObject2 = new permissions();
        $txid = $testObject2->grantpermissions($GLOBALS['permissionaddress'],"create");
        // print_r($txid);
        // $size= strlen("$txid");
        // print_r($size);
		$this->assertEquals($GLOBALS['wrongpermissionaddress'],$txid);
    }

      public function test_failrevokepermissions()
    {
    	$testObject2 = new permissions();
        $txid = $testObject2->revokepermissions($GLOBALS['permissionaddress'],"create");
        // print_r($txid);
        // $size= strlen("$txid");
        // print_r($size);
		$this->assertEquals($GLOBALS['wrongpermissionaddress'],$txid);
    }


}
 ?>   