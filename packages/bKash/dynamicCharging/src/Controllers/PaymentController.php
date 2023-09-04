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
         
        // $paymentonly->setToken($token['token']);
        
        // $this->bkashCallback($CreateReponse);    
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
          $PaymentResponse = $paymentonly->create(10,'01619777282','sale','BDT',null,$token); //$this->Payments();
        
         // $response  = $paymentonly->CallApi($PaymentResponse,$token);
          

          if ($PaymentResponse->transactionStatus == 'Initiated') {
            return redirect($PaymentResponse->bkashURL);
        } else {
            echo "<pre>";
            print_r($response);
            exit();
           }


    }
    // public function Payments() {
        
    //     $token = $this->token;

    //     $response = $this->create(10,'01619777282','sale','BDT',null,$token); 
          
    //      return $response;
        
    // }

    public function bkash_callback(Request $request){
      
        $token = $this->token;
        $PaymentID = $request->paymentId;
        $paymentonly = new PaymentOnly();
        $PaymentResponse = $paymentonly->execute($PaymentID,$token); //$this->Payments();

        echo "<pre>";
        print_r($PaymentResponse);
        exit();
        // $PaymentResponse =  $this->execute($PaymentID);
        // $response  = $paymentonly->CallApi($PaymentResponse,$token);
        // $resultdata = $this->executepayment($PaymentID);
        // $resultdata = json_decode($resultdata);

        // $orders = Order::all();

        // return view('order.index',compact('orders'));

    }

    // public function Execute($PaymentID){

    //     $response = $this->execute($PaymentID);
    //     echo "<pre>";
    //     print_r($response);
    //     exit();
    //     return response;

    // }
}
