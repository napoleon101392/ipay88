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
<?php

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

___

To be able the IPay88 to do an action for your record, it needs an API comming from you.
You can use the `Response::class` to initiate. see example below.

``` php
<?php

use Napoleon\IPay88\Response;

$response = new Response;

$response->run( function($success) {
    if (! $success) {
        return # Do something if it success
    }
    
    return # Do something if it fails
});
```

`$response->run()` function expects 1 parameter to be a callback function.

`$success` variable is the `boolean` status of the transaction record made by the user.

`$response->getFields()` will return `ALL` the `data` available from IPay88, the function optionally wants an string data, to be specify what field you want to get.

