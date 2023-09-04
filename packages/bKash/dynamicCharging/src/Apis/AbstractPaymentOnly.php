<?php

namespace Bkash\Dynamiccharging\Apis;

use Bkash\Dynamiccharging\Consts\BkashApiEndpoints;
use ErrorException;
use Illuminate\Support\Facades\Http;

abstract class AbstractPaymentOnly
{
	protected $config;
    protected $version;
    protected $env;
    protected $token = null;

    public function __construct($config)
    {
        $this->config = $config;
        $this->version = $config['version'];
        $this->env = $config['sandbox'] ? 'sbdynamic' : 'dynamic';
        // dd($this->config['sandbox']);
    }

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

    public function setToken($token)
    {
        if( empty($token) && !is_string($token) && $token != ""){
            throw new ErrorException("Unauthorized access", 401);
        }
        $this->token = $token;

    }
    
    

    public function callApi($PaymentResponse,$token){

        // echo "<pre>";
        // print_r($PaymentResponse);
        // exit();


        $method = $PaymentResponse[0]; 
        $POST_URL = $PaymentResponse[1];
        $data = $PaymentResponse[2];
      
        $response =  Http::withHeaders([
            'x-app-key' => $this->config['app_key'],
            'Authorization' => $token,
            'Content-Type' => 'application/json'
             ])->POST($this->baseUrl().$POST_URL,$data);

        return json_decode($response->body());

    }


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

    // abstract protected function subDomain();

    // abstract protected function urlPrefix();
}