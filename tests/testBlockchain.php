<?php

use PHPUnit\Framework\TestCase;
require '../source/blockchain.php';


$config = include('test_config.php');

$chain_name = $config['chain-name'];


class testBlockchain extends TestCase
{
    
    public function test_getchaininfo()
    {
    	$testObject2 = new blockchain();
        $getinfo = $testObject2->getchaininfo();
        //echo($getinfo);
       $data = json_decode($getinfo, true);
       $array= (array)$data;
        $chainname= $array['chain-description'];
		$this->assertEquals($GLOBALS['chain_name'],$chainname);
		//print_r($data);

     $rootstream= $array['root-stream-name'];
    $this->assertEquals("root",$rootstream);

      $rpcport= $array['default-rpc-port'];
    $this->assertEquals($GLOBALS['port'],$rpcport);

      $networkport= $array['default-network-port'];
    $this->assertEquals(8379,$networkport);

    }

     public function test_getnodeinfo()
    {
         $testObject2 = new blockchain();
        $getnodeinfo = $testObject2->getnodeinfo();
         $data = json_decode($getnodeinfo, true);
         //print_r($data);
         $blocks=$data['blocks'];
         $this->assertGreaterthan(60,$blocks);

        $balance=$data['balance'];
        $this->assertnotnull($balance);
         

        $difficulty=$data['difficulty'];
        $this->assertlessthan(1,$difficulty);

         //public function test_permissions()

    }

    public function test_permissions()
    {
      $testObject2 = new blockchain();
        $permission = $testObject2->permissions();
       // print_r($permission);
        $this->assertSame(['mine', 'admin', 'activate', 'connect', 'send', 'receive', 'issue', 'create'],$permission);

    }

    public function test_getpendingtransactions()
    {
      $testObject2 = new blockchain();
        $pendingtrans = $testObject2->getpendingtransactions();
        // print_r($pendingtrans);
        $this->assertSame([],$pendingtrans);

    }


    public function test_checknodebalance()
    {
     $testObject2 = new blockchain();
        $nodebal = $testObject2->checknodebalance();
        // print_r($nodebal);
        $this->assertGreaterthan(0,$nodebal);   

    }
 }
 ?>   