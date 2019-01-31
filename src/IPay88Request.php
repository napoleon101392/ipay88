<?php

namespace Napoleon\IPay88;

use Napoleon\IPay88\Utils\Request;

class IPay88Request extends Request
{
    protected $fillable = [
        'MerchantCode' => null,
        'RefNo' => null,
        'Amount' => null,
        'PaymentId' => null,
        'Currency' => null,
        'Lang' => null,
        'ProdDesc' => null,
        'UserName' => null,
        'UserEmail' => null,
        'UserContact' => null,
        'Remark' => null,
        'Signature' => null,
        'ResponseURL' => null,
        'BackendURL' => null
    ];

    protected $required_fields = [
        'PaymentId',
        'RefNo',
        'Amount',
        'ProdDesc',
        'UserName',
        'UserEmail',
        'UserContact',
        'ResponseURL',
        'BackendURL'
    ];
}
