<?php

require_once 'vendor/autoload.php';

use \Nimbasms\Nimbasms;

$sms = new Nimbasms();

// var_dump($sms->getAccountBalance());

// var_dump($sms->getAccountGroup());

// var_dump($sms->getAccountSendernames());

var_dump($sms->getAllAccountMessages(null,null,null,1,null));

// var_dump($sms->getContactList());

// var_dump($sms->sendMessage('Nimba API','623273737','Just testing'));

// var_dump($sms->addContactToList('626464671','Aly Kaba'));
