
Address Class Usage
====================

Library to work with RecordsKeeper addresses.


You can generate new address, check all addresses, check address validity, check address permissions, check 
address balance by using Address class. You just have to pass parameters to invoke the pre-defined functions.
  


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


Address Class
-------------

  class Address

  Address class is used to call address related functions like generate new address, list all addresses and no of addresses on the node's wallet, check if given address is valid or not, check if given address has mining permission or not and check a particular address balance on the node functions which are used on the RecordsKeeeper Blockchain. 


**1.Generate new address on the node's wallet**
 

getAddress() function is used to generate a new wallet address.

```PHP
  getAddress()

  $newaddress = new address();
  $result = $newaddress->getAddress();                        #getAddress function call
  echo($result);                                              #print a new address
```
It will return a new address of the wallet.


**2.Generate a new multisignature address**

You have to pass these two arguments to the getMultisigAddress function call:

- nrequired: to pass the no of signatures that are must to sign a transaction
- key: pass any no of comma-seperated public addresses that are to be used with this multisig address as a single variable 

getMultisigAddress() function is used to generate a new multisignature address.

```PHP
  getMultisigAddress($nrequired,$key)  

  $newaddress = new address();
  $result = $newaddress->getMultisigAddress($nrequired,$key);   #getMultisigAddress() function call
  echo($result);                                                #print a newAddress
```
It will return a new multisignature address on RecordsKeeper Blockchain.


**3.Generate a new multisignature address on the node's wallet**

You have to pass these two arguments to the getMultisigWalletAddress function call:

- nrequired: to pass the no of signatures that are must to sign a transaction
- key: pass any no of comma-seperated public addresses that are to be used with this multisig address as a single variable

getMultisigWalletAddress() function is used to generate a new wallet address.

```PHP
  getMultisigWalletAddress($nrequired,$key)  

  $newaddress = new address();
  $result = $newaddress->getMultisigWalletAddress($nrequired,$key);   #getMultisigWalletAddress() function call
  echo($result);                                                      #print a newAddress
```
It will return a new multisignature address on the wallet.


**4.List all addresses and no of addresses on the node's wallet**

retrieveAddresses() function is used to list all addresses and no of addresses on the node's wallet.

```PHP
  retrieveAddresses()

  $newaddress = new address();
  $result = $newaddress->retrieveAddresses();                 #retrieveAddresses function call
  echo($result->address);                                     #print all the addresses of the wallet
  echo($result->address_count);                               #print the address count
```
It will return all the addresses and the count of the addresses on the wallet.
 
**5.Check validity of the address**

You have to pass address as argument to the checkifValid function call:

- Address: to check the validity

checkifValid() function is used to check validity of a particular address. 

```PHP
  checkifValid()

  $newaddress = new address();
  $result = $newaddress->checkifValid();                     #checkifValid() function call
  echo($result);                                             #print validity of the address
```
It will return if an address is valid or not.

**6.Check if given address has mining permission or not**

You have to pass address as argument to the checkifMineAllowed function call:

- Address: to check the permission status

checkifMineAllowed() function is used to sign raw transaction by passing transaction hex of the raw transaction and the private key to sign the raw transaction.

```PHP
  checkifMineAllowed($address) 

  $permissioncheck = new address();
  $result = $permissioncheck->checkifMineAllowed($address);  #checkifValid() function call
  echo($result);                                             #prints permission status of the given address
```
It will return if mining permission is allowed or not.

**7.Check address balance on a particular node**

You have to pass address as argument to the checkifMineAllowed function call:

- Address: to check the balance

checkBalance() function is used to check the balance of the address. 

```PHP
  checkBalance($address)
 
  $address_balance = new address();
  $result = $address_balance->checkBalance($address);        #checkBalance() function call
  echo($result);                                             #prints balance of the address 
```
It will return the balance of the address on RecordsKeeper Blockchain.


**8.Import a non-wallet address on RecordsKeeeper Blockchain**

You have to pass address as argument to the importAddress function call:

- Address: non-wallet address to import on a particular node

importAddress() function is used to check the balance of the address. 

```PHP
  importAddress($public_address)
  
  $response = new address();
  $result = $response->$importAddress($public_address);      #importAddress() function call
  echo($result);                                             #prints response whether address is successfully imported or not
```
It will return the response of the importAddress() function call.

 
