<?php

require_once 'vendor/autoload.php';

use \Nimbasms\Nimbasms;

$sms = new Nimbasms("ba270d0c088652ac7ba3b58fa6ee8c8b","LP-3lv5Q-GV4zp6YK31n-DUhYQ0FO5CCThZ5r2NmX37HnY3TUqxIhoa10innIJ4Aws0aW86Erd6ovMsYxQVEQPaNcnHwQBcU3xLsCFleqFw");


var_dump($sms->getContactList(10,2));
