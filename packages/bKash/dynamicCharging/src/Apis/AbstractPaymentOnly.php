<?php

namespace Bkash\Dynamiccharging\Apis;

use Bkash\Dynamiccharging\Consts\BkashApiEndpoints;
use ErrorException;
use Illuminate\Support\Facades\Http;

abstract class AbstractPaymentOnly
{
	protected $config; //Initiating Config Variable to get all conig data
    protected $version;//Initiating Version Variable to get the present version
    protected $env;//Initiating env to get all values from Env file
    protected $token = null; //Initiating token to generate token and store

    public function __construct($config)
    {
        $this->config = $config;
        $this->version = $config['version'];
        $this->env = $config['sandbox'] ? 'sbdynamic' : 'dynamic'; //Single if condition to check the environment of system
    }

    //Method for generating token in dynamic Charging
    public function getToken()
    {
        $response = Http::withHeaders([
            'username' => $this->config['username'],
            'password' => $this->config['password'],
        ])->POST($this->baseUrl() . BkashApiEndpoints::DYNAMIC_CHARGING_GRANT_TOKEN, [
            "app_key" => $this->config['app_key'],
            "app_secret" => $this->config['app_secret']
        ]);

        if ($response->successful()) {
            return [
                'token' => $response->json()['id_token'],
                'expires_in' => $response->json()['expires_in']
            ];
        } else {
            return [
                'statusCode' => $response->status(),
                'statusMessage' => $response->body()
            ];
        }
    }

    //Method for Set the token value 
    public function setToken($token)
    {
        if( empty($token) && !is_string($token) && $token != ""){
            throw new ErrorException("Unauthorized access", 401);
        }
        $this->token = $token;

    }
    
    
    //Dynamic Method for Calling API from Merchant System to bKash server
    public function callApi($PaymentResponse,$token){
       
        $method = $PaymentResponse[0]; //Mehtod Name like "POST" or "GET"
        $POST_URL = $PaymentResponse[1]; //POST URL is API URL where all value will be submitted
        $data = $PaymentResponse[2];  //All Request Parameter will be stored here
      
        //Using For Sending Request to bKash Server
        $response =  Http::withHeaders([
            'x-app-key' => $this->config['app_key'],
            'Authorization' => $token,
            'Content-Type' => 'application/json'
             ])->POST($this->baseUrl().$POST_URL,$data);

        return json_decode($response->body()); //Returning the response to merchant system

    }

    //Method for making dynamic base URL
    public function baseUrl()
    {
        $api = BkashApiEndpoints::DYNAMIC_CHARGING_BASE_URL;
        return "https://".$this->env. $api . $this->version;
    }

    private function unauthorized()
    {
        return [
            'statusCode' => 401,
            'statusMessage' => "Unauthorized access."
        ];
    }
}