<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;


class Account {
   private $this->_base_url;
   private $this->_client;

   public function __construct($client)
   {
   		$this->_base_url = 'https://api.nimbasms.com';
   		$this->_client = $client;
   }

   public function get()
   {
   		$response = $client->get('/accounts/');
   		return $response->getBody();
   }
}


class Client {
	public $sid;
	public $secret_key;

	private $_accounts;
	private $_messages;
	private $_client;

	public function __construct($sid, $secret_key)
	{
		$this->sid = $sid;
		$this->secret_key = $secret_key;
		$this->_client = new GuzzleClient([
		    'base_uri' => 'https://api.nimbasms.com',
		    'auth' => [$sid, $secret_key]
		]);
	}

	public function accounts()
	{
		if(!$this->_accounts){
			$this->_accounts = Account($this->_client);
		}
		return $this->_accounts;
	}
}
