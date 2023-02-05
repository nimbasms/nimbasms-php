# nimbasms-php
A PHP library to interact with Nimba SMS API.

# Usage

 - [Installation](#installation)
 - [Check balance](#account)
 - [Groups](#group)
 - [Sendernames](#sendername)
 - [Create Contacts](#contact)
 - [Send Message](#message)

## <a name="installation"></a> Installation

Using composer:
```sh
$ composer require nimbasms/nimbasms-php
```

## Usage
First you need to resolve a `NimbaSMS` instance:

```php
use NimbaSMS\NimbaSMS;

# Use <service_id> and <service_secret>

$config = [
	'serviceId' => 'XXXXXXXXXXXXXXXXXXXXXXXX',
	'secretToken' => 'XXXXXXXXXXXXXXXXXXXXXXXX'
];

# OR use a valid access token

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
# Get user account balance

$sms->getBalance();
```

## <a name="group"></a> Groups

```php
# Get user account Groups

$sms->getGroups();

# With options limit or offset. You can use only limit, offset or both

$options = [
	'limit' = 2,
	'offset' = 2
];

$sms->getGroups($options);
```

## <a name="sendername"></a> Sendernames

```php
# Get account Sendernames

$sms->getSendername();
```

## <a name="contact"></a> Create Contact

```php

# Add contact

$sms->addContact('XXXXXXX');

# Add contact with Name

$options = [
	'name' => 'Full Name', 
];

$sms->addContact('XXXXXXX',$options);

# Add contact and assignate to Group or Groups

$options = [
	'groups' => ['Group 1','Group 2'], 
];

$sms->addContact('XXXXXXXX',$options);

# Add contact with Name and assignate to Group or Groups

$options = [
	'name' => 'Full Name',
	'groups' => ['Group 1','Group 2'], 
];

$sms->addContact('XXXXXX',$options);

```

## <a name="message"></a> Send message

```php

# Send message...

$contacts = ['XXXXXXXX'];

$sms->from('SENDER_NAME')->to($contacts)->message('MESSAGE_TO_SEND')->send();

# Get All messages

$sms->getMessages();

# Get only last 10 messages

$options = [
	'limit' => 10
];

$sms->getMessages($options);

# Get only last 10 messages with offset 2

$options = [
	'limit' => 10,
	'offset' => 2
];

$sms->getMessages($options);

# Get messages on specific date

$options = [
	'sent_at' => 'XXXX-XX-XX'
];

$sms->getMessages($options);

# Get messages messages with a date greater than specific date

$options = [
	'sent_at__gte' => 'XXXX-XX-XX'
];

$sms->getMessages($options);

# Get messages messages with a date lower than specific date

$options = [
	'sent_at__lte' => 'XXXX-XX-XX'
];

$sms->getMessages($options);


# Retrieve message

$sms->retrieveMessage('XXXXX-XXX-XXXX-XXXX-XXXXXXXX');

```

## Credit
Nimba SMS
