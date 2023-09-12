<?php

namespace Bkash\Dynamiccharging\Apis\Paymentonly;

use Bkash\Dynamiccharging\Apis\AbstractPaymentOnly;// Accessing the Abstract Class
use Bkash\Dynamiccharging\Apis\Paymentonly\Traits\Payment;//Accessing the Payment Trait
use Bkash\Dynamiccharging\Consts\BkashApiEndpoints; //Accessing the BKashAPIEndpoints to make base URL

/* This class is built only for accesing all items from AbstractClass */
class PaymentOnly extends AbstractPaymentOnly
{

    use Payment; //Calling the payment Trait for accessing the Method

    public function __construct()
    {
        parent::__construct(config(BkashApiEndpoints::PAYMENT_ONLY));
    }

    
}