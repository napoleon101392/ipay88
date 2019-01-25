<?php

namespace IPay88\Contracts;

interface PaymentGatewayInterface
{
    public function setRequestParameters(array $fields);
}
