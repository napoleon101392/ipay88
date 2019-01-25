<?php

namespace Napoleon\IPay88\Contracts;

interface PaymentGatewayInterface
{
    public function setRequestParameters(array $fields);
}
