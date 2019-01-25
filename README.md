[![Latest Stable Version](https://poser.pugx.org/napoleon/ipay88/v/stable)](https://packagist.org/packages/napoleon/ipay88)
[![Total Downloads](https://poser.pugx.org/napoleon/ipay88/downloads)](https://packagist.org/packages/napoleon/ipay88)
[![License](https://poser.pugx.org/napoleon/ipay88/license)](https://packagist.org/packages/napoleon/ipay88)

#### Installation
``` sh
composer install napoleon\ipay88 dev-master
```

#### Example code

``` php
<?php

namespace Your\Namespace;

use Napoleon\IPay88\IPay88;

class Controller
{
  const PAYMENT_METHOD = 1;

  protected $payment;

  public function __construct()
  {
    $this->payment = new IPay88;
  }

  public function index()
  {
    $this->payment->setRequestParamaters([
        'PaymentId' => self::PAYMENT_METHOD,
        'RefNo' => 'your-unique-ref-code',
        'Amount' => 15,
        'ProdDesc' => ,
        'UserName',
        'UserEmail',
        'UserContact',
        'ResponseURL',
        'BackendURL'
    ]);

    return $this->payment->render();
  }
}

```
