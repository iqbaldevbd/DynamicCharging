<?php

namespace Bkash\Dynamiccharging\Apis\Paymentonly\Traits;

use Bkash\Dynamiccharging\Consts\BkashApiEndpoints;
use Bkash\Dynamiccharging\Apis\AbstractPaymentOnly;
use Illuminate\Support\Facades\Http;


trait Payment
{
    protected $CallApi;


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
       

        $data = $this->callApi($data,$token);
        return $data;   
    }

    public function execute($paymentID,$token)
    {
        
        $data = ['POST',BkashApiEndpoints::DYNAMIC_CHARGING_EXECUTE_PAYMENT,[
                'agreementId'=> '',
                'paymentId' => $paymentID
            ]];
          

        $data = $this->callApi($data,$token);
        return $data;   
    }

   
    public function queryPayment($paymentID,$token)
    {
        $data = ['GET',BkashApiEndpoints::DYNAMIC_CHARGING_QUERY_PAYMENT,[
            'paymentId' => $paymentID
        ]];

        $data = $this->callApi($data,$token);
        return $data;   
                
    }

}