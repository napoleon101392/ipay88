<?php

namespace Napoleon\IPay88;

use Napoleon\IPay88\Utils\Form;
use Napoleon\IPay88\IPay88Request;
use Napoleon\IPay88\Contracts\PaymentGatewayInterface;
use Napoleon\IPay88\Exceptions\BadMethodCallException;

class IPay88 implements PaymentGatewayInterface
{
    protected $form;

    protected $request;

    public function __construct()
    {
        $this->form = new Form;

        $this->request = new IPay88Request;
    }

    /**
     * Filling up fields in array
     *
     * @todo:: automatically float the amount
     * @return $this
     */
    public function setRequestParameters(array $fields)
    {
        $this->request->setParameters($fields)->validate();

        return $this;
    }

    /**
     * Generate a form with fields
     *
     * @return string
     */
    public function render()
    {
        return $this->form->create($this->request->getParams())->html();
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
