<?php

use PHPUnit\Framework\TestCase;
require '../source/assets.php';

 $config = include('../../../../config.php');
$Kvaladdress =$config['Kvaladdress'];


class testAssets extends TestCase
{
    
    public function test_createasset()
    {
    	$testObject2 = new assets();
        $createassets = $testObject2->createasset($GLOBALS['Kvaladdress'],"windows",50);
        // print_r($assets);
		$this->assertEquals("Asset or stream with this name already exists",$createassets);
    }

    public function test_retrieveasset()
    {
    	$testObject2 = new assets();
        $retassets = $testObject2->retrieveasset();
        $data = json_decode($retassets, true);
        $assetcount=$data['asset_count'];
		$this->assertGreaterthan(0,$assetcount);
		// print_r($assetname);
    }
      public function test_retrieveassets()
    {
    	$testObject2 = new assets();
        $retassets = $testObject2->retrieveasset();
        $data = json_decode($retassets, true);
        $assetcount=$data['issue_id'];
		$this->assertGreaterthan(0,$assetcount);
		// print_r($sendassets);
    }
     public function test_retrieveassetss()
    {
    	$testObject2 = new assets();
        $retassets = $testObject2->retrieveasset();
        $data = json_decode($retassets, true);
        $assetcount=$data['issue_qty'];
		$this->assertGreaterthan(0,$assetcount);
		// print_r($sendassets);
    }
}
?>    