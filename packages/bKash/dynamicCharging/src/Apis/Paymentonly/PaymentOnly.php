<?php

namespace Bkash\Dynamiccharging\Apis\Paymentonly;

use Bkash\Dynamiccharging\Apis\AbstractPaymentOnly;
use Bkash\Dynamiccharging\Apis\Paymentonly\Traits\Payment;
use Bkash\Dynamiccharging\Consts\BkashApiEndpoints;

class PaymentOnly extends AbstractPaymentOnly
{

    use Payment;

    public function __construct()
    {
        // dd(new Payment);
        parent::__construct(config(BkashApiEndpoints::PAYMENT_ONLY));
    }

    // public function subDomain()
    // {
    //     return BkashApiEndpoints::CHECKOUT_SUB_DOMAIN;
    // }
    

    // public function urlPrefix()
    // {
    //     return BkashApiEndpoints::CHECKOUT_URL_PREFIX;
    // }
}