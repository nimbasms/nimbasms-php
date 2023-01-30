<?php

namespace Nimbasms;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;

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

   private $auth = '';


   public function __construct($serviceId,$serviceToken)
   {
        $this->serviceId = $serviceId;

        $this->serviceToken = $serviceToken;

        $this->credentials = $this->getServiceId() . ':' . $this->getServiceToken();

        $this->headers =  [   
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.base64_encode($this->credentials)
        ];

        $this->auth = ['auth' => [$this->getServiceId(),$this->getServiceToken()]];
   }

   # Get your account balance
   
   public function getAccountBalance()
   {
       	$url = self::BASE_URL. '/v1/accounts';

        $client = new GuzzleClient;

        $request = $client->get($url, ['headers' => $this->headers]);

        $response = json_decode($request->getBody()->getContents());

       	return $response;
   }

   # Get groups
   
   public function getAccountGroup($limit = null, $offset = null)
   {
        $url = self::BASE_URL. '/v1/groups';

        $client = new GuzzleClient;

        $request = $client->get($url, $this->auth,
                                ['query' => ['limit' => $limit, 'offset' => $offset]],
                                ['headers' => $this->headers]);

        $response = json_decode($request->getBody()->getContents());

        return $response;
   }


   # Get Sendernames
   
   public function getAccountSendernames($limit = null, $offset = null)
   {
        $url = self::BASE_URL. '/v1/sendernames';

        $client = new GuzzleClient;

        $request = $client->get($url, $this->auth,
                                ['query' => ['limit' => $limit, 'offset' => $offset]],
                                ['headers' => $this->headers]);

        $response = json_decode($request->getBody()->getContents());

        return $response;
   }


   # Get Contact
   
   public function getContactList($limit = null, $offset = null)
   {
        $url = self::BASE_URL. '/v1/contacts';

        $client = new GuzzleClient;

        $request = $client->get($url, $this->auth,
                                ['query' => ['limit' => $limit, 'offset' => $offset]],
                                ['headers' => $this->headers]);

        $response = json_decode($request->getBody()->getContents());

        return $response;
   }

   # Create Contact
   # This contact will be added to the default contact list
   
   public function addContactToList($numero, $name ='', $groups=[])
   {

        $url = self::BASE_URL. '/v1/contacts';

        $client = new GuzzleClient;

        $params = ['numero' => $numero, 'name' => $name, 'groups' => $groups];

        $request = $client->post($url, [ 'headers' => $this->headers, 'json' => $params]);
            
        $response = json_decode($request->getBody()->getContents());

        return $response;
   }


   # Create with groups and name - name and groups are optional.
   
   public function createContactGroup()
   {

   }

   # Get All messages
   
   public function getAllAccountMessages($sent_at = null, $sent_at_gte = null, $sent_at__lte = null,
    $limit = null, $offset = null)
   {
        $url = self::BASE_URL. '/v1/messages';

        $client = new GuzzleClient;

        $query = [
                    'sent_at' => $sent_at, 
                    'sent_at_gte' => $sent_at_gte, 
                    'sent_at__lte' => $sent_at__lte,
                    'limit' => $limit,
                    'offset' => $offset
                ];

        $request = $client->get($url, $this->auth, ['query' => $query], ['headers' => $this->headers]);
            
        $response = json_decode($request->getBody()->getContents());

        return $response;
   }

   # Get only last 10 messages
   
   public function getLastTenAccountMessage()
   {

   }

   /**
    * Sends SMS.
    *
    * @param  string  $senderName    Message Sender Name (Max Length of 11). Case sensitive
    *                                   
    * @param  array  $to  Mobile Number to which to send message to 
    *                     (Should not include a '+' sign or '00')
    * 
    * @param  string  $message          The message to send (Can be used for 'long' messages, that is, 
    *                                   messages longer than 140 characters per message)         
    *
    * @return array
    */
   
   public function sendMessage($senderName, $receiverAddress, $message)
   {    
        // API Call URI for sending message 
        
        $url = self::BASE_URL. '/v1/messages';

        // Requested Parameters
        
        $params = ['sender_name' => $senderName, 'to' => [$receiverAddress], 'message' => $message];

        $client = new GuzzleClient;

        $request = $client->request('POST', $url, [ 'headers' => $this->headers, 'json' => $params]);
    
        $response = json_decode($request->getBody()->getContents());

        return $response;
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

