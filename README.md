 RecordsKeeper-PHP-SDK
 ======================

It is an infrastructure to build RecordsKeeper blockchain-based applications, products and is used to work around applications that are built on top of this blockchain platform.

**Note:** If you're looking for the RecordsKeeper PHP Library please see: [RecordsKeeper PHP Library](https://github.com/RecordsKeeper/recordskeeper-php-sdk/tree/master)


 Getting Started
 ---------------

 Before you begin you need to setup PHP Development Environment.  


Creating Connection
-------------------

Entry point for accessing Address class resources.

Make Config file to import config parameters.


Import config file.

```PHP
$config = include('config.php')
```
   
Import values from config file:

```PHP
   $chain = $config['chain'];
   $url = $config['url'];
   
   $port = $config['port'];
```


Node Authentication
-------------------

Importing user name and password values from config file to authenticate the node:

- User name: The rpc user is    used to call the APIs.
- Password: The rpc password is used to authenticate the APIs.


```PHP
   $username = $config['rkuser'];
   $pass = $config['passwd'];
```   

**Libraries**

-[Addresses](https://github.com/RecordsKeeper/recordskeeper-php-sdk/blob/master/source/address.php) Library to work with RecordsKeeper addresses. You can generate new address, check all addresses, check address validity, check address permissions, check address balance by using Address class. You just have to pass parameters to invoke the pre-defined functions.

-[Assets](https://github.com/RecordsKeeper/recordskeeper-php-sdk/blob/master/source/assets.php) Library to work with RecordsKeeper assets. You can create new assets and list all assets by using Assets class. You just have to pass parameters to invoke the pre-defined functions.

-[Block](https://github.com/RecordsKeeper/recordskeeper-php-sdk/blob/master/source/block.php) Library to work with RecordsKeeper block informaion. You can collect block information by using block class. You just have to pass parameters to invoke the pre-defined functions.

-[blockchain](https://github.com/RecordsKeeper/recordskeeper-php-sdk/blob/master/source/blockchain.php) Library to work with RecordsKeeper block informaion. You can collect block information by using block class. You just have to pass parameters to invoke the pre-defined functions.

-[Permissions](https://github.com/RecordsKeeper/recordskeeper-php-sdk/blob/master/source/permissions.php) Library to work with RecordsKeeper permissions. You can grant and revoke permissions like connect, send, receive, create, issue, mine, activate, admin by using Assets class. You just have to pass parameters to invoke the pre-defined functions.

-[Stream](https://github.com/RecordsKeeper/recordskeeper-php-sdk/blob/master/source/stream.php) Library to work with RecordsKeeper streams. You can publish, retrieve and verify stream data by using stream class. You just have to pass parameters to invoke the pre-defined functions.

-[Transaction](https://github.com/RecordsKeeper/recordskeeper-php-sdk/blob/master/source/transactions.php) Library to work with RecordsKeeper transactions. You can send transaction, create raw transaction, sign raw transaction, send raw transaction, send signed transaction, retrieve transaction information and calculate transaction's fees by using transaction class. You just have to pass parameters to invoke the pre-defined functions.

-[Wallet](https://github.com/RecordsKeeper/recordskeeper-php-sdk/blob/master/source/wallet.php) Library to work with RecordsKeeper wallet functionalities. You can create wallet, dump wallet into a file, backup wallet into a file, import wallet from a file, lock wallet, unlock wallet, change wallet's password, retrieve private key, retrieve wallet's information, sign and verify message by using wallet class. You just have to pass parameters to invoke the pre-defined functions.

**Unit Tests**

Under recordskeeper_php_lib/test using test data from testconfig_sample file. 

**Documentation**

The complete docs are here: [RecordsKeeper php library documentation](https://github.com/RecordsKeeper/recordskeeper-php-sdk/tree/master/docs).
