# nimbasms-python
A PHP library to interact with Nimba SMS API.

# Usage

 - [Installation](#installation)
 - [Check balance](#account)
 - [Groups](#group)
 - [Sendernames](#sendername)
 - [Create Contacts](#contact)
 - [Send Message](#message)
 - [Logs Activities](#log)


## <a name="installation"></a> Installation

Using composer:
```sh
$ composer require nimbasms/nimbasms-php
```

## Usage
First you need to resolve a `NimbaSMS` instance:

```php
use NimbaSMS\NimbaSMS;

// Use <service_id> and <service_secret>

$config = [
	'serviceId' => 'XXXXXXXXXXXXXXXXXXXXXXXX',
	'secretToken' => 'XXXXXXXXXXXXXXXXXXXXXXXX'
];

// OR

// Use a valid access token

$config = [
    'token' => 'Basic XXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
];
```
next step, create an `SMS` object passing it the `$config` :
```php
$sms = new SMS($config);
```

## <a name="account"></a> Check balance
```php
$sms->getBalance()
```

## <a name="group"></a> Groups

```php
$sms->getGroups();

// With options limit or offset

$options = [
	'limit' = integer,
	'offset' = integer
];

$sms->getGroups($options);
```

## <a name="sendername"></a> Sendernames

```php
$sms->getSendername()
```

## <a name="contact"></a> Create Contact

```php
$sms->addContact('XXXXXXX')

// Create with name

$options = [
	'name' => 'Full Name', 
];

$sms->addContact('620371218',$options)

// Create and assignate to group or groups

$options = [
	'groups' => ['Group 1','Group 2'], 
];

$sms->addContact('620371218',$options)

# Create with name and assignate to group or groups

$options = [
	'name' => 'Full Name',
	'groups' => ['Group 1','Group 2'], 
];

$sms->addContact('620371218',$options)

```


## <a name="message"></a> Send message

```php
from nimbasms import Client

ACCOUNT_SID = 'XXXX'
AUTH_TOKEN = 'XXXX'
client = Client(ACCOUNT_SID, AUTH_TOKEN)

# Get All messages
response = client.messages.list()
if response.ok:
    all_messages = response.data
    print('There are {} messages in your account.'.format(len(all_messages)))

# Get only last 10 messages
response = client.messages.list(limit=10)
if response.ok:
    some_messages = some_messages.data
    print('Here are the last 10 messages in your account:')
    for m in some_messages:
        print(m)

# send message...
print('Sending a message...')
response = client.messages.create(to=['XXXX'],
            sender_name='YYYY', message='Hi Nimba!')
if response.ok:
    print('message response : {}'.format(response.data))


# Retrieve message
response = client.messages.retrieve(messageid='XXXXXXXXXXXXXXXXXXXXX')
if response.ok:
    print("Message retrieve : {}".format(response.data))
```

## <a name="log"></a> Logs Activities

```php
import logging
from nimbasms import Client

ACCOUNT_SID = 'XXXX'
AUTH_TOKEN = 'XXXX'
client = Client(ACCOUNT_SID, AUTH_TOKEN)
logging.basicConfig() # log in console
logging.basicConfig(filename='./log.txt') # or loging in file
client.http_client.logger.setLevel(logging.INFO)

# ....
```

## Credit
Nimba SMS
