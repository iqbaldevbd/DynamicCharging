<?php

namespace Bkash\Dynamiccharging\Consts;

final class BkashApiEndpoints
{
    public const DYNAMIC_CHARGING_BASE_URL = '.pay.bka.sh/';

    public const DYNAMIC_CHARGING_GRANT_TOKEN = '/auth/grant-token';
    public const DYNAMIC_CHARGING_CREATE_PAYMENT = '/payment/create';
    public const DYNAMIC_CHARGING_EXECUTE_PAYMENT = '/payment/execute';
    public const DYNAMIC_CHARGING_QUERY_PAYMENT = '/query/payment';

    public const DYNAMIC_CHARGING_SEARCH_TRAN = '/search/transaction';

    public const DYNAMIC_CHARGING_REFUND_PAYMENT = '/payment/refund';
    public const DYNAMIC_CHARGING_REFUND_STATUS = '/payment/refund/status';

    public const PAYMENT_ONLY = 'bkash.payment_only';
}