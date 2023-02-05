<?php

require_once 'vendor/autoload.php';

use \NimbaSMS\NimbaSMS;

$config = [
	'serviceId' => 'ba270d0c088652ac7ba3b58fa6ee8c8b',
	'secretToken' => 'LP-3lv5Q-GV4zp6YK31n-DUhYQ0FO5CCThZ5r2NmX37HnY3TUqxIhoa10innIJ4Aws0aW86Erd6ovMsYxQVEQPaNcnHwQBcU3xLsCFleqFw'
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

