Asset Class Usage
====================

Library to work with RecordsKeeper assets.


You can create new assets, send assets and list all assets by using Assets class. You just have to pass parameters to invoke the pre-defined functions of Assets class.

  


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


Assets Class
-------------

  *class Assets*

    Assets class is used to call assets related functions like create assets and list assets functions which are used on the RecordsKeeeper Blockchain. 


**1. Create Assets on the RecordsKeeper Blockchain**

 

createAsset() function is used to create or issue an asset.

```PHP
  *createAsset($address,$asset_name,$asset_qty)*

  $create = new assets();
  $result = $create->createAsset($address,$asset_name,$asset_qty);                        #createAsset() function call
  echo($result);                                              #print transaction id of the issued asset

It will return the transaction id of the issued asset.
```

**2.Send Assets to a particular address on the RecordsKeeper Blockchain**

You have to pass these three arguments to the createAsset function call:


* address: address which will send the asset
* asset_name: name of the asset
* qty: quantity of asset to be sent


sendAsset() function is used to send an asset.

```PHP
  *sendAsset($address,$assetname,$qty)*  

  $txid = new assets();
  $result = $txid->sendAsset($address,$assetname,$qty);   #sendAsset() function call
  echo($result);                                               #print a transaction id of the sent asset

 It will return the transaction id of the sent asset.
```

**3. List all assets on the RecordsKeeper Blockchain**

retrieveAssets() function is used to list all assets, no of assets, issued quantity and issued transaction id of all the assets on RecordsKeeper Blockchain.



```PHP
  *retrieveAssets()*  

  $ret = new assets();
  $result = $ret->retrieveAssets();   #retrieveAssets() function call
  echo($result->name);                                               #print  name of all the assets
  echo($result->asset_count);   #prints total asset count
  echo($result->id);         #prints assets issued transaction id
  echo($result->qty);      prints assets issued quantity

 It will return all the assets, the count of the assets, issued quantity of assets and issued transaction id of the asset on the RecordsKeeper Blockchain.
```
