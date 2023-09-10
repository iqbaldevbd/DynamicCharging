<?php

namespace Bkash\Dynamiccharging\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;


use Bkash\Dynamiccharging\Consts\BkashApiEndpoints;
use Bkash\Dynamiccharging\Apis\Paymentonly\PaymentOnly;
use Bkash\Dynamiccharging\Apis\Paymentonly\Traits\Payment;


class PaymentController
{
    public $paymentonly;
    use Payment;
    protected $token;

    public function __construct()
    {
         $this->token = $this->token();
   
    }

    public function token()
    {
        $paymentonly = new PaymentOnly();
        $token = $paymentonly->getToken();
        
        $paymentonly->setToken($token);
        return $token['token'];
    }

    public function CreatePayment(){
          $paymentonly = new PaymentOnly();
          $token = $this->token;
          $PaymentResponse = $paymentonly->create(10,'01619777282','sale','BDT',null,$token);
          

          if ($PaymentResponse->transactionStatus == 'Initiated') {
            return redirect($PaymentResponse->bkashURL);
        } else {
            echo "<pre>";
            print_r($response);
            exit();
           }


    }
  

    public function bkash_callback(Request $request){
      
        $token = $this->token;
        $PaymentID = $request->paymentId;
        $paymentonly = new PaymentOnly();
        $PaymentResponse = $paymentonly->execute($PaymentID,$token); 

        echo "<pre>";
        print_r($PaymentResponse);
        exit();
       

    }
    public function queryPayment(Request $request)
    {
        $token = $this->token;
        // $PaymentID = $request->paymentId;
        $PaymentID = 'DCPAY10112bCbPfr1693908894642';
        $paymentonly = new PaymentOnly();
        $queryResponse = $paymentonly->queryPayment($PaymentID,$token);

        echo "<pre>";
        print_r($queryResponse);
        exit();   
    }

    public function refund(){
        $token = $this->token;
        $paymentonly = new PaymentOnly();
        $agreementID = "";
        $amount = 10;
        $paymentId = 'DCPAY10112bCbPfr1693908894642';
        $sku = '01619777282';
        $transactionID = 'AI570D3B5Z';
        $reason = "test-basis";
        
        $data = [
            "agreementId" => $agreementID,
            "amount" => $amount,
            "paymentId" => $paymentId,
            "reason" => $reason,
            "sku" => $sku,
            "trxID"=> $transactionID
        ];
        $queryResponse = $paymentonly->refund($data,$token); 

        echo "<pre>";
        print_r($queryResponse);
        exit();   
    }

    public function refundStatus(){
         $token = $this->token;
        $paymentonly = new PaymentOnly();
        $agreementID = "";
        $paymentId = 'DCPAY10112bCbPfr1693908894642';
        $transactionID = 'AI570D3B5Z';
        
        $data = [
            "agreementId" => $agreementID,
            "paymentId" => $paymentId,
            "trxID"=> $transactionID
        ];
        $refundStatus = $paymentonly->refundStatus($data,$token); 

        echo "<pre>";
        print_r($refundStatus);
        exit();   
    }


    public function SearchTXN(){
        $token = $this->token;
        $transactionID = 'AI570D3B5Z';
        $data = [
            "trxID"=> $transactionID
        ];
        $paymentonly = new PaymentOnly();
        $SearchResults = $paymentonly->searchTransaction($data,$token); ;

        echo "<pre>";
        print_r($SearchResults);
        exit(); 

    }


}
