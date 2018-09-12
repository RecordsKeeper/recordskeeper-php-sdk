
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

Import RecordsKeeper library.

```PHP
  require_once "vendor/autoload.php";
  use recordskeeper\recordskeepersdk\permissions;
```



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
  grantPermissions($address,$permissions)  

  $classObject = new Permissions();
  $txid = $classObject->grantPermission($address,$permissions);    #grantPermissions() function call
  echo($txid);                                                    #prints txid of the grant permision transaction
```
It will return the transaction id of the permission transaction.


**2.Revoke Permissions to an address on the RecordsKeeper Blockchain**


You have to pass these two arguments to the revokePermission function call:


- Permissions: list of comma-seperated permissions passed as a string 
- Address: to which you have to grant permission 


revokePermission() function is used to revoke permissions like connect, send, receive, create, issue, mine, activate, admin to an address on RecordsKeeper Blockchain.

```PHP
  revokePermission($address,$permissions)  

  $classObject = new Permissions();
  $txid = $classObject->revokePermission($address,$permissions); #revokePermission() function call
  echo($txid);                                                   #prints txid of the revoke permision transaction
```  
It will return the transaction id of the permission transaction.

