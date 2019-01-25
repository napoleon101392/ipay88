<?php

namespace IPay88;

class PaymentGateway
{
    /** @var string posting url used for production */
    protected $production_url = 'https://payment.ipay88.com.ph/epayment/entry.asp';

    /** @var string posting url used for staging */
    protected $staging_url = 'https://sandbox.ipay88.com.ph/epayment/entry.asp';

    /** @var array available fields in a form */
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
