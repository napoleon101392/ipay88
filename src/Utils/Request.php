<?php

namespace Napoleon\IPay88\Utils;

use Napoleon\IPay88\Exceptions\FieldNotAcceptableException;
use Napoleon\IPay88\Exceptions\RequiredFieldsException;

class Request
{
    const PRODUCTION_POST_URL = 'https://payment.ipay88.com.ph/epayment/entry.asp';

    const SANDBOX_POST_URL = 'https://sandbox.ipay88.com.ph/epayment/entry.asp';

    protected $fillable;

    protected $required_fields;

    protected $posting_url;

    protected $parameters;

    /**
     * @todo :: Create exception
     * @return [type] [description]
     */
    public function postUrl()
    {
        if (is_null(env('IPAY88_PRODUCTION'))) {
            throw new \Exception("Environment file should be set first", true);
        }

        if (env('IPAY88_PRODUCTION')) {
            $this->posting_url = self::PRODUCTION_POST_URL;
        } else {
            $this->posting_url = self::SANDBOX_POST_URL;
        }

        return $this;
    }

    public function setParameters($fields)
    {
        $this->parameters = $fields;

        return $this;
    }

    public function validate()
    {
        foreach ($this->parameters as $field => $value) {
            if (!array_key_exists($field, $this->fillable)) {
                throw new FieldNotAcceptableException("Field: {$field} not acceptable", true);
            }

            $this->setField($field, $value);
        }

        foreach ($this->required_fields as $required_field) {
            if (!array_key_exists($required_field, $this->parameters)) {
                throw new RequiredFieldsException("Refer to the IPay88 documentation for the required fields", true);
            }
        }

        $this->fillable['MerchantCode'] = env('IPAY88_MERCHANT_CODE');
        $this->fillable['Currency']     = env('IPAY88_CURRENCY');
        $this->fillable['Lang']         = env('IPAY88_LANG');
        $this->fillable['Signature']    = $this->generateSignature();
    }

    public function getPostingUrl()
    {
        return $this->posting_url;
    }

    public function setField($field, $value)
    {
        return $this->fillable[$field] = $value;
    }

    public function getParams($field = null)
    {
        if (!is_null($field)) {
            return $this->fillable[$field];
        }

        return $this->fillable;
    }

    private function generateSignature()
    {
        $source = implode('', [
            env('IPAY88_MERCHANT_KEY'),
            env('IPAY88_MERCHANT_CODE'),
            $this->fillable['RefNo'],
            trimAmount($this->fillable['Amount']),
            $this->fillable['Currency'],
        ]);

        return base64_encode(hex2bin(sha1($source)));
    }
}
