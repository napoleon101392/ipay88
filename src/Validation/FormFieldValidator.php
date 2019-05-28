<?php

namespace Napoleon\IPay88\Validation;

use Napoleon\IPay88\Contracts\ValidatorInterface;
use Napoleon\IPay88\Exceptions\FieldNotAcceptableException;
use Napoleon\IPay88\Utils\Request;

class FormFieldValidator implements ValidatorInterface
{
    protected $request;

    public function __construct()
    {
        $this->request = new Request;
    }

    public function check($parameters, $comparison)
    {
        foreach ($parameters as $field => $value) {
            if (!array_key_exists($field, $comparison)) {
                throw new FieldNotAcceptableException("Field: $field not acceptable", 1);
            }

            $this->request->setField($field, $value);
        }

        return;
    }
}
