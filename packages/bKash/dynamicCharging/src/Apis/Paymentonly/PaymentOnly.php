<?php

namespace Bkash\Dynamiccharging\Apis\Paymentonly;

use Bkash\Dynamiccharging\Apis\AbstractPaymentOnly;
use Bkash\Dynamiccharging\Apis\Paymentonly\Traits\Payment;
use Bkash\Dynamiccharging\Consts\BkashApiEndpoints;

class PaymentOnly extends AbstractPaymentOnly
{

    use Payment; //Calling the payment Trait for accessing the Method

    public function __construct()
    {
        parent::__construct(config(BkashApiEndpoints::PAYMENT_ONLY));
    }

    
}