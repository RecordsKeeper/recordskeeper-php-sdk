Transactions Class Usage
========================

Library to work with RecordsKeeper transactions.

You can send transaction, create raw transaction, sign raw transaction, send raw transaction, send signed transaction, retrieve transaction information and calculate transaction's fees by using transaction class. You just have to pass parameters to invoke the pre-defined functions.  


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


Transaction Class
-----------------

   class Transaction

   Transaction class is used to call transaction related functions like create raw transaction, sign transaction, send transaction , retrieve transaction and verify transaction functions which are used to create raw transactions, send transactions, sign transactions, retrieve transactions and verify transactions on the RecordsKeeeper Blockchain. 



**1.Send Transaction without signing with private key**

You have to pass these three arguments to the sendTransaction function call:

- Transaction's sender address
- Transaction's reciever address
- Amount to be sent in transaction

sendTransaction() function is used to send transaction by passing reciever's address, sender's address and amount.

```PHP
  sendTransaction($sender_address,$reciever_address,$data,$amount)  


  $send = new Transaction();
  $result = $send->sendTransaction($sender_address,$reciever_address,$data,$amount);   #sendTransaction() function call
  echo($result);                                                    #prints transaction id of the sent transaction
```

It will return the transaction id of the raw transaction.


**2.Send Transaction by signing with private key**

You have to pass these four arguments to the sendSignedTransaction function call:

- Transaction's sender address
- Transaction's reciever address
- Amount to be sent in transaction
- Private key of the sender's address

sendSignedTransaction() function is used to send transaction by passing reciever's address, sender's address, private key of sender and amount. In this function private key is required to sign transaction.


```PHP 
  sendSignedTransaction($sender_address,$reciever_address,$amount,$private_key,$data)  

  $sendsigned = new Transaction();    
  $result = $sendsigned->sendSignedTransaction($sender_address,$reciever_address,$amount,$private_key,$data); #sendSignedTransaction function call
  
  echo($result);                                                 #prints transaction id of the signed transaction                           
```
It will return transaction id of the signed transaction.


**3.Create raw transaction**

You have to pass these three arguments to the createRawTransaction function call:


- Transaction's sender address
- Transaction's reciever address
- Amount to be sent in transaction

createRawTransaction() function is used to create raw transaction by passing reciever's address, sender's address and amount. 


```PHP
   createRawTransaction(sender_address, reciever_address, amount, data)  

   $tx_hex = new Transaction();
   $result = $tx_hex->createRawTransaction(sender_address, reciever_address, amount, data);   #createRawTransaction() function call
   echo($result);                                               #prints transaction hex of the raw transaction.
``` 
It will return transaction hex of the raw transaction.


**4.Sign raw transaction**

You have to pass these three arguments to the signRawTransaction function call:

- Transaction hex of the raw transaction
- Private key to sign raw transaction

signRawTransaction() function is used to sign raw transaction by passing transaction hex of the raw transaction and the private key to sign the raw transaction. 


```PHP 
   signRawTransaction($tx_hex,$private_key) 

   $sign = new Transaction();    
   $result = $sign->signRawTransaction($tx_hex,$private_key);  #signRawTransaction function call
   echo($result);                                              #prints signed transaction hex of the raw transaction
``` 
It will return signed transaction hex of the raw transaction.


**5.Send raw transaction**

You have to pass these three arguments to the sendRawTransaction function call:

- Signed transaction hex of the raw transaction 

sendRawTransaction() function is used to send raw transaction by passing signed transaction hex of the raw transaction. 


```PHP 
  sendRawTransaction(signed_txHex) 

  $sendraw = new Transaction();    
  $result = $sendraw-> sendRawTransaction(signed_txHex);      #sendRawTransaction() function call
  
  echo($result);                                              #prints transaction id of the raw transaction
```
  
It will return transaction id of the raw transaction sent on to the Blockchain.


**6.Retrieve a transaction from the Blockchain**

You have to pass given argument to the retrieveTransaction function call:

- Transaction id of the transaction you want to retrieve

retrieveTransaction() function is used to retrieve transaction's information by passing transaction id to the function.



```PHP 
   retrieveTransaction($tx_id)

   $ret = new Transaction();    
   $result = $ret->retrieveTransaction($tx_id);                #retrieveTransaction() function call
   echo($result->sent_data);                                   #print sent data
   echo($result->sent_amount);                                 #print sent amount
```   

It will return the sent data and sent amount of the retrieved transaction.
  
  
**7.Calculate a particular transaction's fee on RecordsKeeper Blockchain**

You have to pass these two arguments to the getFee function call:

- Transaction id of the transaction you want to calculate fee for
- Sender's address

getFee() function is used to calculate transaction's fee by passing transaction id and sender's address to the function.


```PHP 
   getFee($address,$tx_id)

   $fee = new Transaction();    
   $result = $fee->getfee($address,$tx_id);                   #getfee() function call
   echo($result);                                             #prints fees consumed in the verified transaction
```  
   

It will return the fees consumed in the transaction.
 