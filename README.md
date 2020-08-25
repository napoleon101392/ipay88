<p align="center">
  <img src="https://www.ipay88.com/image/ipay88_logo_wide.png" width="200" title="hover text">
  <br />
  <img class="latest_stable_version_img" src="https://poser.pugx.org/napoleon/ipay88/v/stable?format=flat-square">
  <img class="total_img" src="https://poser.pugx.org/napoleon/ipay88/downloads?format=flat-square">
  <img class="license_img" src="https://poser.pugx.org/napoleon/ipay88/license?format=flat-square">
  <img src="https://scrutinizer-ci.com/g/napoleon101392/ipay88/badges/quality-score.png?b=master">
  <img src="https://travis-ci.org/napoleon101392/ipay88.svg?branch=master">
</p>

#### Installation
``` sh
composer require napoleon/ipay88 dev-master
```

#### Example code

To generate form fields that are hidden,
this will use in `page hopping`.

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
    if ($success) {
        return # Do something if it succeed
    }
    
    return # Do something if it fails
});
```

`$response->run()` function expects 1 parameter to be a callback function.

`$success` variable is the `boolean` status of the transaction record made by the user.

`$response->getFields()` will return `ALL` the `data` available from IPay88, the function optionally wants an string data, to be specify what field you want to get.

#### Todos:
- [ ] function to send a http request.
- [ ] function that requery the transaction

#### Note:
Feel free to edit this doc and create PR for the missing todos.

