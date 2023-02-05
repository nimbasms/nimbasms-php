<?php

require_once 'vendor/autoload.php';

use \NimbaSMS\NimbaSMS;

$config = [
	'serviceId' => 'XXXXXXXXXXXXXXXXXXXXXXXXXX',
	'secretToken' => 'XXXXXXXXXXXXXXXXXXXXXXXXXX'
];

// or 
// $config = [
// 	'token' => 'Basic_Auth_Token'
// ];

$sms = new NimbaSMS($config);

// var_dump($sms->getBalance());

// var_dump($sms->getGroups($options));

// var_dump($sms->getSendername());

// var_dump($sms->getMessages($options));

// var_dump($sms->getContacts());

// $contacts = ['XXXXXXXXX'];

// var_dump($sms->from('Nimba API')->to($contacts)->message('Hello World!')->send());

// $options = ['name' => 'XXXX XXXX', 'groups' => ['XXXXX']];

// var_dump($sms->addContact('XXXXXXXX'));

// var_dump($sms->retrieveMessage('XXXXX-XXX-XXXX-XXXX-XXXXXXXX'));

