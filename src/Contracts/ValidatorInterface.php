<?php

namespace Napoleon\IPay88\Contracts;

interface ValidatorInterface
{
    public function check($parameters, $comparison);
}
