
Blockchain Class Usage
====================

Library to work with Blockchain class in RecordsKeeper Blockchain.

You can get chain information, node information, node's permissions, pending transaction information and node balance by using Blockchain class. You just have to pass parameters to invoke the pre-defined functions of Blockchain class.


Node Authentication
-------------------

Import config file.

```PHP
$config = include('config.php');
```
Import values from config file.

Import RecordsKeeper library.

```PHP
  require_once "vendor/autoload.php";
  use recordskeeper\recordskeepersdk\blockchain;
```



Blockchain class
----------------

  class Blockchain

  Blockchain class is used to call blockchain related functions like retrieving blockchain parameters, retrieving node's information, retrieving mempool's information, retrieving node's permissions and check node's balance functions which are used on the RecordsKeeeper Blockchain. 


**1. Retrieve Blockchain parameters of RecordsKeeper Blockchain**

getChainInfo() function is used to retrieve Blockchain parameters.

```PHP
  getChainInfo()

  $classObject = new Blockchain();
  $result = $classObject->chaininfo();                                          #getChainInfo() function call
  echo($result->chain-protocol);                                         #prints blockchain's protocol
  echo($result->chain-description);                                      #prints blockchain's description
  echo($result->root-stream-name);                                       #prints blockchain's root stream
  echo($result->maximum-blocksize);                                      #prints blockchain's maximum block size
  echo($result->default-network-port);                                   #prints blockchain's default network port
  echo($result->default-rpc-port);                                       #prints blockchain's default rpc port
  echo($result->mining-diversity);                                       #prints blockchain's mining diversity
  echo($result->chain-name);                                             #prints blockchain's name
``` 

It will return the information about RecordsKeeper blockchain's parameters.


**2.Retrieve node's information on RecordsKeeper Blockchain**

getNodeInfo() function is used to retrieve node's information on RecordsKeeper Blockchain.


```PHP
  getNodeInfo() 

  $classObject = new Blockchain();
  $result = $classObject->getNodeInfo();                                          #getNodeInfo() function call
  echo($result->node-balance);                                            #prints balance of the node
  echo($result->synced-blocks);                                           #prints no of synced blocks
  echo($result->node-address);                                            #prints node's address
  echo($result->difficulty);                                              #prints node's difficulty 
```
It will return node's balance, no of synced blocks, node's address and node's difficulty.


**3.Retrieve permissions given to the node on RecordsKeeper Blockchain**


permissions() function is used to retrieve node's permissions. 

```PHP
  permissions()  

  $classObject = new Blockchain();
  $allowed_permissions = $classObject->permissions();                                  #permissions() function call
  echo($allowed_permissions);                                                   #prints permissions available to the node
```
It will return the permissions available to the node.

**4.Retrieve pending transaction's information on RecordsKeeper Blockchain**

getpendingTransactions() function is used to retrieve pending transaction's information like no of pending transactions and the pending transactions. 

```PHP
  getPendingTransactions($address)  

  $classObject = new Blockchain();
  $result = $classObject->getPendingTransactions($address);             #getPendingTransactions() function call
  echo($result->tx);                                                    #prints pending transactions
  echo($result->tx_count);                                              #prints pending transaction count
```
It will return the information of pending transactions on Recordskeeper Blockchain.


**5.Check node's total balance**

checkNodeBalance() function is used to check the total balance of the node. 

```PHP
  checkNodeBalance() 

  $classObject = new Blockchain();
  $node_balance = $classObject->checkNodeBalance();                      #checkNodeBalance() function call
  echo($node_balance);                                                   #prints total balance of the node
```  

It will return the total balance of the node on RecordsKeeper Blockchain.
