<?php

namespace IPay88;

use IPay88\Exceptions\FieldNotAcceptableException;
use IPay88\Exceptions\RequiredFieldsException;

use IPay88\PaymentGateway;
use IPay88\Traits\PaymentFormFields;
use IPay88\Contracts\PaymentGatewayInterface;

class IPay88 extends PaymentGateway implements PaymentGatewayInterface
{
    use PaymentFormFields;

    /**
     * Filling up fields in array
     *
     * @return this
     */
    public function setRequestParameters(array $fields)
    {
        foreach ($fields as $field => $value) {
            if (! array_key_exists($field, $this->fillable)) {
                throw new FieldNotAcceptableException("Field: {$field} not acceptable", true);
            }

            foreach($this->required_fields as $required_field){
                if (! array_key_exists($required_field, $fields)) {
                    throw new RequiredFieldsException("Refer to the IPay88 documentation for the required fields", true);
                }
            }

            $this->setField($field, $value);
        }

        $this->setPreDefinedFields();

        return $this;
    }

    /**
     * Generate a form with fields
     *
     * @return string
     */
    public function render()
    {
        $html = $this->formOpen();

        foreach ($this->fillable as $field => $value) {
            $html .= "<input type='hidden' name='{$field}' value='{$value}'>";
        }

        $html .= "</form>";

        return $html;
    }
}
