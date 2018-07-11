
Permissions Class Usage
=======================

Library to work with Permission class in RecordsKeeper Blockchain.


You can grant or revoke permissions like create, send, recieve, mine, admin, connect, issue and activate by using Permissions class. You just have to pass parameters to invoke the pre-defined functions.

  
Node Authentication
-------------------

Import config file.

```PHP
$config = include('config.php');
```
Import values from config file.

- User name: The rpc user is used to call the APIs.
- Password: The rpc password is used to authenticate the APIs.


```PHP
   $chain = $config['chain'];
   $url = $config['url'];
   $username = $config['rkuser'];
   $pass = $config['passwd'];
   $port = $config['port'];
```
Now we have node authentication credentials.


Permissions Class
-----------------

   class Permissions

    
  Permissions class is used to call permissions related functions like grant and revoke permissions for an address functions which are used on the RecordsKeeeper Blockchain. 


**1.Grant Permissions to an address on the RecordsKeeper Blockchain**

 You have to pass these two arguments to the grantPermission function call:


- Permissions: list of comma-seperated permissions passed as a string 
- Address: to which you have to grant permission 

grantPermission() function is used to grant permissions like connect, send, receive, create, issue, mine, activate, admin to an address on RecordsKeeper Blockchain.

```PHP
  grantPermission($address,$permissions)  

  $grant = new Permissions();
  $result = $grant->grantPermission($address,$permissions);          #grantPermission() function call
  echo($result);                                                     #prints response of the grant permision transaction
```
It will return the transaction id of the permission transaction.


**2.Revoke Permissions to an address on the RecordsKeeper Blockchain**


You have to pass these two arguments to the revokePermission function call:


- Permissions: list of comma-seperated permissions passed as a string 
- Address: to which you have to grant permission 


revokePermission() function is used to revoke permissions like connect, send, receive, create, issue, mine, activate, admin to an address on RecordsKeeper Blockchain.

```PHP
  revokePermission($address,$permissions)  

  $revoke = new Permissions();
  $result = $revoke->revokePermission($address,$permissions);      #revokePermission() function call
  echo($result);                                                   #prints response of the revoke permision transaction
```  
It will return the transaction id of the permission transaction.


**3.List all assets on the RecordsKeeper Blockchain**

retrieveAssets() function is used to list all assets, no of assets, issued quantity and issued transaction id of all the assets on RecordsKeeper Blockchain.


```PHP
  retrieveAssets()  

  $ret = new assets();
  $result = $ret->retrieveAssets();                               #retrieveAssets() function call
  echo($result->name);                                            #print  name of all the assets
  echo($result->asset_count);                                     #prints total asset count
  echo($result->id);                                              #prints assets issued transaction id
  echo($result->qty);                                             #prints assets issued quantity
```
It will return all the assets, the count of the assets, issued quantity of assets and issued transaction id of the asset on the RecordsKeeper Blockchain.

