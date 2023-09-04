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


   

    // public function baseUrl()
    // {
    //     $api = BkashApiEndpoints::DYNAMIC_CHARGING_BASE_URL;
    //     return "https://".$this->env. $api . $this->version;
    // }

   

    // public function queryPayment($paymentID)
    // {
    //     return $this->callApi(
    //         BkashConstant::METHOD_GET,
    //         EndPoints::CHECKOUT_QUERY_PAYMENT . $paymentID
    //     );
    // }

}