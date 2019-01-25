<?php

namespace Napoleon\IPay88\Traits;

use Napoleon\IPay88\Exceptions\BadMethodCallException;

trait PaymentFormFields
{
    protected function formOpen()
    {
        $action = $this->endPoint($_ENV['IPAY88_PRODUCTION']);

        return "<form method='POST' action='{$action}' name='my-form-name'>";
    }

    public function endPoint($status)
    {
        if (true === $status) {
            return $this->production_url;
        }

        return $this->staging_url;
    }

    public function setField($field, $value)
    {
        return $this->fillable[$field] = $value;
    }

    protected function setPreDefinedFields()
    {
        $this->fillable['MerchantCode'] = $_ENV['IPAY88_MERCHANT_CODE'];
        $this->fillable['Currency'] = $_ENV['IPAY88_CURRENCY'];
        $this->fillable['Lang'] = $_ENV['IPAY88_LANG'];
        $this->fillable['Signature'] = $this->generateSignature();
    }

    protected function generateSignature()
    {
        $source = implode('', [
            $_ENV['IPAY88_MERCHANT_KEY'],
            $_ENV['IPAY88_MERCHANT_CODE'],
            $this->fillable['RefNo'],
            $this->trimAmount($this->fillable['Amount']),
            $this->fillable['Currency']
        ]);

        return base64_encode(hex2bin(sha1($source)));
    }

    protected function trimAmount($subject)
    {
        return preg_replace('/[.,]/', '', $subject);
    }

    /**
     * Trigger when calling a function not exists
     *
     * @param  String $method
     * @param  Array $parameter
     * @throws \IPay88\Exceptions\BadMethodCallException;
     */
    public function __call($method, $parameter)
    {
        throw new BadMethodCallException(sprintf('Method %s does not exist.', $method), true);
    }
}
