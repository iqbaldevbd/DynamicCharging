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
          $bkashCallBackURL = "http://localhost:8000/bkash_callback";
          $PaymentResponse = $paymentonly->create(10,'01619777282','sale',$bkashCallBackURL,'BDT',null,$token);
          

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
        $PaymentID = 'DCPAY1011bkQIIfM1694497969231';
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
        $paymentId = 'DCPAY1011bkQIIfM1694497969231';
        $sku = '01619777282';
        $transactionID = 'AIC40DO3MC';
        $reason = "test-basis";
        
        $refundResults = $paymentonly->refund($agreementID,$amount,$paymentId,$reason,$sku,$transactionID,$token); 

        echo "<pre>";
        print_r($refundResults);
        exit();   
    }

    public function refundStatus(){
        $token = $this->token;
        $paymentonly = new PaymentOnly();
        $agreementID = "";
        $paymentId = 'DCPAY10112bCbPfr1693908894642';
        $transactionID = 'AI570D3B5Z';
        $refundStatus = $paymentonly->refundStatus($agreementID,$paymentId,$transactionID,$token); 

        echo "<pre>";
        print_r($refundStatus);
        exit();   
    }


    public function SearchTXN(){
        $token = $this->token;
        $transactionID = 'AIC40DO4DU';
       
        $paymentonly = new PaymentOnly();
        $SearchResults = $paymentonly->searchTransaction($transactionID,$token); ;

        echo "<pre>";
        print_r($SearchResults);
        exit(); 

    }


}
