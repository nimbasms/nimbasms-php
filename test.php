<?php

require_once 'vendor/autoload.php';

use \NimbaSMS\NimbaSMS;

$config = [
	'serviceId' => 'XXXXXXXXXXXXXXXXXXXXXXXX',
	'secretToken' => 'XXXXXXXXXXXXXXXXXXXXXXXX'
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

var_dump($sms->from('Nimba API')->to('625291901')->message('Just testing')->send());

// var_dump($sms->addContactToList('626464671','Aly Kaba'));

