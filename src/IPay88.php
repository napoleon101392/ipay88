<?php

namespace Napoleon\IPay88;

use Napoleon\IPay88\Exceptions\FieldNotAcceptableException;
use Napoleon\IPay88\Exceptions\RequiredFieldsException;

use Napoleon\IPay88\PaymentGateway;
use Napoleon\IPay88\Traits\PaymentFormFields;
use Napoleon\IPay88\Contracts\PaymentGatewayInterface;

class IPay88 extends PaymentGateway implements PaymentGatewayInterface
{
    use PaymentFormFields;

    /**
     * Filling up fields in array
     *
     * @todo:: automatically float the amount
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
     * @todo :: Remove FORM related in this class | Create FORM class for segregation instead of Traits
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
