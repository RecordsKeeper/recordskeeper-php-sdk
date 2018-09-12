
Stream Class Usage
==================

Library to work with RecordsKeeper streams.

You can publish, retrieve and verify stream data by using Stream class. You just have to pass parameters to invoke the pre-defined functions of Stream class.
  


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
  use recordskeeper\recordskeepersdk\stream;
```



Stream Class
------------

   class Stream

   Stream class to call stream related functions like publish, retrievewithtxid, retrieveWithAddress, retrieveWithKey and verify data functions which are used to publish data into the stream, retrieve data from the stream and verify data from the stream. 


**1.Publish**

 
You have to pass these four arguments to the publish function call:

- Data to be published
- Address of the publihser
- Stream to which you want your data to be published
- key Value for the data to be published

```PHP
  publish($address,$stream,$key,$data)   

  $classObject = new Stream();
  $txid = $classObject->publish($address,$stream,$key,$data);      #publish() function call
  echo($txid);                                                     #prints the transaction id of the data published
```
It will return the transaction id of the published data, use this information to retrieve the particular data from the stream.


**2.Retrieve an existing item from a particular stream against a transaction id**

You have to pass these two arguments to the retrieve function call:

- Stream name: which you want to access
- Transaction id: id of the data you want to retrieve


```PHP 
  retrieveData($stream,$txid) 

  $classObject = new Stream();    
  $data = $classObject->retrieve($stream,$txid);   #retrieveData function call with stream and txid as the required parameter
  
  echo($data);                                          #prints data published in the transaction                                            
```
It will return the item's details like publisher address, key value, confirmations, hexdata and transaction id.


**3.Retrieve an item against a particular publisher address**

You have to pass these three arguments to the retrieveWithAddress function call:

- Stream name: which you want to access
- Publisher address: address of the data publisher you want to verify
- Count: no of items you want to retrieve


```PHP
  retrieveWithAddress($stream,$address,$count)

  $classObject = new Stream();
  $result = $classObject->retrieveWithAddress($stream,$address,$count);   #retrieveWithAddress() function call
  echo($result->key);                                             #prints key value of the data
  echo($result->txid);                                            #prints transaction id of the data
  echo($result->data);                                            #prints raw data 
```
It will return the key value, raw data and transaction id of the published item.


**4.Retrieve an item against a particular key value**

You have to pass these three arguments to the retrieveWithKey function call:

- Stream name: which you want to access
- Key: key value of the published data you want to verify
- Count: no of items you want to retrieve


```PHP 
  retrieveWithKey($stream,$key,$count)

  $classObject = new Stream();    
  $result = $classObject->retrieveWithKey($stream,$key,$count);          #call retrieveWithKey function with stream,key and count as the required parameter
  
  echo($result->publisher);                                      #prints publisher's address of the published data
  echo($result->txid);                                           #prints transaction id of the data
  echo($result->data);                                           #prints raw data 
```

It will return the key value, raw data and transaction id of the published item.


**5.Verify an data item on a particular stream of RecordsKeeper Blockchain**

You have to pass these three arguments to the retrieveWithKey function call:


- Stream name: which you want to access
- Data: against which you want to make a query
- Count: count of items which will be queried

```PHP 
  verifyData($stream,$data,$count)

  $classObject = new Stream();    
  $result = $classObject->verifyData($stream,$data,$count);    #call verifyData function with stream,data and count as the required parameter
  
  echo($result);                                                #prints if verification is successful or not
```  
It will return the result if verification is successful or not.


**6.Retrieve data items on a particular stream of RecordsKeeper Blockchain**

You have to pass these two arguments to the verifyWithKey function call:

- Stream name: which you want to access
- Count: count of items which will be queried


```PHP 
   retrieveItems($stream,$count)

  $classObject = new Stream();    
  $result = $classObject->retrieveItems($stream,$count);          #call retrieveItems function with stream and count as the required parameter
  
  echo($result->address);                                      #prints address of the publisher of the item
  echo($result->key);                                          #prints key value of the stream item
  echo($result->data);                                         #prints raw data published
  echo($result->txid);                                         #prints transaction id of the item published 
```

It will return the address, key value, data and transaction id of the stream item published.
    
  

