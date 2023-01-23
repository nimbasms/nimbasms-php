<?php

namespace Nimbasms;

use GuzzleHttp\Client as GuzzleClient;

class Nimbasms {

   protected const BASE_URL = 'https://api.nimbasms.com';

   /**
    * Client Service Identifier. Unique ID provided by the Nimba backend server to identify 
    * your application.
    *
    * @var string
    */
   
   protected $serviceId = '';

   /**
    * The Token will be used for all further API calls.
    *
    * @var string
    */
   
   protected $serviceToken = '';

   /**
    * Creates a new Nimbasms instance. If the user doesn't know his token or doesn't have a
    * token yet, he can leave $token empty and retrieve a token with
    * getTokenFromConsumerKey() method later.
    *
    * @param  array  $config  An associative array containing clientId (required), 
    *                       clientSecret (required), token (optional), 
    *                       and verifyPeerSSL (optional)
    *
    * @return void
    */
   
   private $credentials = '';

   private $headers = '';

   private $args = '';


   public function __construct($serviceId,$serviceToken)
   {
      $this->serviceId = $serviceId;

      $this->serviceToken = $serviceToken;

      $this->credentials = $this->getServiceId() . ':' . $this->getServiceToken();

      $this->headers = array('Authorization: Basic ' . base64_encode($this->credentials));

      $this->args = array('auth' => [$this->getServiceId(),$this->getServiceToken()]);
   }

   # Get your account balance
   
   public function getAccountBalance()
   {
       	$url = self::BASE_URL. '/v1/accounts';

        $client = new GuzzleClient;

        $request = $client->get($url, $this->args, ['headers' => $this->headers]);

        $result = $request->getBody();
        
        $response = json_decode($result, true);

       	return $response;
   }

   # Get groups
   
   public function getAccountGroup()
   {
        
   }


   # Get Sendernames
   
   public function getAccountSendernames()
   {

   }


   # Get Contact
   
   public function getContactList($limit,$offset)
   {
        $url = self::BASE_URL. '/v1/contacts';

        $this->args = array('auth' => [$this->getServiceId(),$this->getServiceToken()], 
                            'limit' => $limit, 
                            'offset' => $offset);

        $client = new GuzzleClient;

        $request = $client->get($url, $this->args, ['headers' => $this->headers]);

        $result = $request->getBody();
        
        $response = json_decode($result, true);

        return $response;
   }

   # Create Contact
   # This contact will be added to the default contact list
   
   public function addContactToList()
   {

   }


   # Create with groups and name - name and groups are optional.
   
   public function createContactGroup()
   {

   }

   # Get All messages
   
   public function getAllAccountMessages()
   {

   }

   # Get only last 10 messages
   
   public function getLastTenAccountMessage()
   {

   }

   # send message...
   
   public function sendMessage()
   {

   }


   # Retrieve message
   
   public function retrieveMessage()
   {

   }

   /**
    *  Gets the Cliend Service ID.
    *
    * @return string
    */
   public function getServiceId()
   {
       return $this->serviceId;
   }

   /**
    *  Sets the Client Service ID.
    *
    * @param  string  $serviceId  the Service ID
    */
   public function setServiceId($serviceId)
   {
       $this->serviceId = $serviceId;
   }
   

   /**
    *  Gets the Cliend Service Token.
    *
    * @return string
    */
   public function getServiceToken()
   {
       return $this->serviceToken;
   }

   /**
    *  Sets the Client Service Token.
    *
    * @param  string  $serviceToken the Service Token
    */
   public function setServiceToken($serviceToken)
   {
       $this->serviceToken = $serviceToken;
   }
}

