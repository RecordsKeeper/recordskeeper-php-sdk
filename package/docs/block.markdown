Block Class Usage
====================

Library to work with RecordsKeeper block information.

You can collect block information like block's transaction count, blocktime, blockhash, miner of the block by using block class. You just have to pass parameters to invoke the pre-defined functions of Block class.

  


Node Authentication
-------------------


Import config file.

```PHP
$config = include('config.php')
```
Import values from config file.


- User name: The rpc user is    used to call the APIs.
- Password: The rpc password is used to authenticate the APIs.


```PHP
   $chain = $config['chain'];
   $url = $config['url'];
   $username = $config['rkuser'];
   $pass = $config['passwd'];
   $port = $config['port'];
```
   Now we have node authentication credentials.


Block Class
-------------

  *class Block*

   Block class is used to call block related function like blockinfo which is used to retrieve block details like block's hash value, size, nonce, transaction ids, transaction count, miner address, previous block hash, next block hash, merkleroot, blocktime and difficulty of the block for which you have made the query.

**1. Block info to retrieve block information**

You have to pass these block height as the argument to the blockinfo function call:
 

* Block height: height of the block of which you want to collect info


```PHP
  *blockinfo($block_height)*

  $info = new block();
  $result = $info->blockinfo($block_height);            #blockinfo() function call
  echo($result->txcount);                                              #prints transaction count of the block
  echo($result->tx);                                              #prints transaction id of the block
  echo($result->size);                                              #prints size of the block
  echo($result->blockhash);                                              #prints hash value of the block
  echo($result->nonce);                                              #prints nonce of the block
  echo($result->miner);                                              #prints miner's of the block
  echo($result->nextblock);                                              #prints next block's hash 
  echo($result->prevblock);                                              #prints previous block's hash
  echo($result->merkleroot);                                              #prints merkle root of the block
  echo($result->blocktime);                                              #prints time at which block is mined
  echo($result->difficulty);                                              #prints difficulty of the block

  It will return transaction ids, transaction count, nonce, size, hash value, previous block's hash value, next block hash value, merkle root, difficulty, blocktime and miner address of the block.
```

**2. Retrieve a range of blocks on RecordsKeeper chain**

You have to pass these three arguments to the createAsset function call:

* Block range: range of the block of which you want to collect info


```PHP
  *retrieveBlocks($block_range)*  

  $ret = new assets();
  $result = $ret->retrieveBlocks($block_range);
     #sendAsset() function call
  echo($result->blockhash);                                               #print hash of the blocks
  echo($result->miner);     #prints miner of the blocks
  echo($result->blocktime);     #prints block time of the blocks
  echo($result->txcount);              #prints transaction count of the blocks


 It will return blockhash, miner address, blocktime and transaction count of the blocks.
```

