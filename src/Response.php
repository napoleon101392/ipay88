<?php

namespace Napoleon\IPay88;

use Napoleon\IPay88\Exceptions\BadMethodCallException;

class Response
{
    /** @var array the data comming from the gateway */
    protected $fields;

    public function __construct()
    {
        $this->fields = $_POST;
    }

    /**
     * Initialize the API, so that the
     * gateway can understand the situation xD
     *
     * @return String
     */
    public function init()
    {
        return "RECEIVEOK";
    }

    /**
     * Get the responses of Ipay88
     *
     * @return
     */
    public function run(callable $callback)
    {
        echo $this->init();

        $status = (int) $this->getFields('Status');

        $callback($status);

        exit;
    }

    /**
     * Display the the field requested
     *
     * @param  string $field
     * @return $field
     */
    public function getFields($field = null)
    {
        if (!is_null($field)) {
            return $this->fields[$field];
        }

        return $this->fields;
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
        throw new BadMethodCallException(sprintf('Method %s does not exist.', $method), 1);
    }
}
