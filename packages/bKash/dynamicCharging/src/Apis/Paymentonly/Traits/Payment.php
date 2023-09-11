<?php

namespace Bkash\Dynamiccharging\Apis\Paymentonly\Traits;

use Bkash\Dynamiccharging\Consts\BkashApiEndpoints;
use Bkash\Dynamiccharging\Apis\AbstractPaymentOnly;
use Illuminate\Support\Facades\Http;


trait Payment
{
    /*Create Payment Method for Calling Create Payment API in Dynamic Charging. */
    public function create($amount, $merchantInvoiceNumber, $intent, $currency = 'BDT', $merchantAssociationInfo = null,$token)
    {
        
        $data = ['POST',BkashApiEndpoints::DYNAMIC_CHARGING_CREATE_PAYMENT,[
                'amount' => $amount,
                'agreementId'=> '',
                "callbackURL"=> "http://localhost:8000/bkash_callback", 
                'currency' => $currency,
                'intent' => $intent,
                "merchantAssociationInfo"=> "",
                'merchantInvoiceNumber' => $merchantInvoiceNumber,
                "mode"=>"1011",
                "payerReference"=>"anything",
                "platformInfo"=> "local"
            ]];
       

        $data = $this->callApi($data,$token); //Calling Another Method- CallAPI from AbstractClass to Send request to bKash API
        return $data;   
    }

    /* Execute Metod for Calling Executing the Payment using PaymentID in Dynamic Charging.*/
    public function execute($paymentID,$token)
    {
        
        $data = ['POST',BkashApiEndpoints::DYNAMIC_CHARGING_EXECUTE_PAYMENT,[
                'agreementId'=> '',
                'paymentId' => $paymentID
            ]];
          

        $data = $this->callApi($data,$token);//Calling Another Method- CallAPI from AbstractClass to Send request to bKash API
        return $data;   
    }

    /* Query Payment Method for getting the details of PaymentID in Dynamic Charging.*/
    public function queryPayment($paymentID,$token)
    {
        $data = ['GET',BkashApiEndpoints::DYNAMIC_CHARGING_QUERY_PAYMENT,[
            'paymentId' => $paymentID
        ]];

        $data = $this->callApi($data,$token);//Calling Another Method- CallAPI from AbstractClass to Send request to bKash API
        return $data;   
                
    }

    /* Refund Method for Doing Refund to Customer in Dynamic Charging.*/
    public function refund($response,$token){
        $data = ['POST',BkashApiEndpoints::DYNAMIC_CHARGING_REFUND_PAYMENT,$response];

        $data = $this->callApi($data,$token); //Calling Another Method- CallAPI from AbstractClass to Send request to bKash API
        return $data;   
     
    }
    /* Method of Refund to know the Status of Refunded transaction in Dynamic Charging*/
    public function refundStatus($response,$token){
        $data = ['POST',BkashApiEndpoints::DYNAMIC_CHARGING_REFUND_STATUS,$response];

        $data = $this->callApi($data,$token);//Calling Another Method- CallAPI from AbstractClass to Send request to bKash API
        return $data;   
     
    }
    
    /* Method for Searching Transaction Details by using transaction ID in Dynamic Charging */
    public function searchTransaction($response,$token){
        $data = ['POST',BkashApiEndpoints::DYNAMIC_CHARGING_SEARCH_TRAN,$response];

        $data = $this->callApi($data,$token);//Calling Another Method- CallAPI from AbstractClass to Send request to bKash API
        return $data;   
     
    }



}