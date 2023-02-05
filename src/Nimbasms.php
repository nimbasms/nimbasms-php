<?php

namespace NimbaSMS;

use GuzzleHttp\Client as GuzzleClient;

class NimbaSMS {

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
   
   protected $secretToken = '';

   /**
    * @var string
    */
   protected $to;

   /**
    * @var string
    */
   protected $from;

   /**
    * @var string
    */
   protected $message;

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
   
   private $credentials = null;

   private $headers = null;

   public function __construct($config = [])
   {
        if (array_key_exists('serviceId', $config) && array_key_exists('secretToken', $config)) {
            
            $this->serviceId = $config['serviceId'];

            $this->secretToken = $config['secretToken'];

            $this->credentials = $this->getServiceId() . ':' . $this->getSecretToken();

            $this->headers =  [   
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic '.base64_encode($this->credentials)
            ];
        }

        if (array_key_exists('token', $config)) {

            $this->token = $config['token'];

            $this->headers =  [   
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => $this->token
            ];

        }

   }

   # Get your account balance
   
   public function getBalance()
   {
       	$url = self::BASE_URL. '/v1/accounts';

        $client = new GuzzleClient;

        $request = $client->get($url, ['headers' => $this->headers]);

        $response = json_decode($request->getBody()->getContents());

       	return $response;
   }

   # Get groups
   
   public function getGroups($options = [])
   {
        $url = self::BASE_URL. '/v1/groups';

        $client = new GuzzleClient;

        $request = $client->get($url,['headers' => $this->headers,'query' => $options]);

        $response = json_decode($request->getBody()->getContents());

        return $response;
   }


   # Get Sendernames
   
   public function getSendername($options = [])
   {
        $url = self::BASE_URL. '/v1/sendernames';

        $client = new GuzzleClient;

        $request = $client->get($url,['headers' => $this->headers,'query' => $options]);

        $response = json_decode($request->getBody()->getContents());

        return $response;
   }


   # Get Contact
   
   public function getContacts($options = [])
   {
        $url = self::BASE_URL. '/v1/contacts';

        $client = new GuzzleClient;

        $request = $client->get($url,['headers' => $this->headers,'query' => $options]);

        $response = json_decode($request->getBody()->getContents());

        return $response;
   }

   # Create Contact
   # This contact will be added to the default contact list
   
   public function addContact($numero, $options = [])
   {

        $url = self::BASE_URL. '/v1/contacts';

        $client = new GuzzleClient;

        $params = ['numero' => $numero];

        if(array_key_exists('name',$options))
            $params['name'] = $options['name'];
        
        if(array_key_exists('groups',$options))
            $params['groups'] = $options['groups'];

        $request = $client->post($url,['headers' => $this->headers, 'json' => $params]);
            
        $response = json_decode($request->getBody()->getContents());

        return $response;
   }



   # Get All messages
   
   public function getMessages($options = [])
   {
        $url = self::BASE_URL. '/v1/messages';

        $client = new GuzzleClient;

        $request = $client->get($url,['headers' => $this->headers,'query' => $options]);
            
        $response = json_decode($request->getBody()->getContents());

        return $response;
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
   
   public function from($from){

        $this->from = $from;
        
        return $this;
        
   }
   
   public function to(Array $to){

        $this->to = $to;

        return $this;
   }

   public function message($message){

        $this->message = $message;

        return $this;
   }
   
   public function send()
   {    
        // API Call URI for sending message 
        
        $url = self::BASE_URL. '/v1/messages';

        // Requested Parameters
        
        $params = [
            'sender_name' => $this->from, 
            'to' => $this->to, 
            'message' => $this->message
        ];

        $client = new GuzzleClient;

        $request = $client->post($url, ['headers' => $this->headers, 'json' => $params]);
    
        $response = json_decode($request->getBody()->getContents());

        return $response;
   }


   # Retrieve message
   
   public function retrieveMessage($messageId)
   {
        $url = self::BASE_URL. '/v1/messages/'.$messageId;

        $client = new GuzzleClient;

        $request = $client->get($url,['headers' => $this->headers]);

        $response = json_decode($request->getBody()->getContents());

        return $response;
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
   public function getSecretToken()
   {
       return $this->secretToken;
   }

   /**
    *  Sets the Client Service Token.
    *
    * @param  string  $secretToken the Service Token
    */
   public function setSecretToken($secretToken)
   {
       $this->secretToken = $secretToken;
   }
}

