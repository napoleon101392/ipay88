[![Latest Stable Version](https://poser.pugx.org/napoleon/ipay88/v/stable)](https://packagist.org/packages/napoleon/ipay88)
[![Total Downloads](https://poser.pugx.org/napoleon/ipay88/downloads)](https://packagist.org/packages/napoleon/ipay88)
[![License](https://poser.pugx.org/napoleon/ipay88/license)](https://packagist.org/packages/napoleon/ipay88)

#### Installation
``` sh
composer install napoleon\ipay88 dev-master
```

#### Example code

To generate form fields that are hidden.

``` php
use Napoleon\IPay88\IPay88;

$payment = new IPay88;

$payment->setRequestParameters([
    'PaymentId' => 1,
    'RefNo' => 'your-unique-ref-code',
    'Amount' => 15,
    'ProdDesc' => 'The description',
    'UserName' => 'John Doe',
    'UserEmail' => 'john@example.com',
    'UserContact' => '09123456789',
    'ResponseURL' => 'www.your-response-url.com',
    'BackendURL' => 'www.your-backend-url.com'
]);

$payment->render();

```
Or you can simply chain `$payment->setRequestParamaters([...])->render()`
