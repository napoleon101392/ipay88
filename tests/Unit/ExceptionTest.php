<?php

namespace Napoleon\IPay88\Tests\Unit;

use Napoleon\IPay88\Exceptions\BadMethodCallException;
use Napoleon\IPay88\Exceptions\FieldNotAcceptableException;
use Napoleon\IPay88\Exceptions\RequiredFieldsException;
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    /**
     * @test
     * @group Negative
     * @expectedException \Napoleon\IPay88\Exceptions\FieldNotAcceptableException
     */
    public function it_should_throw_field_not_acceptable_exception()
    {
        $payment = new \Napoleon\IPay88\IPay88;

        $payment->setRequestParameters([
            'notexists' => 'eee',
        ]);
    }

    /**
     * @test
     * @group Negative
     * @todo :: automatically float the amount
     * @expectedException \Napoleon\IPay88\Exceptions\RequiredFieldsException
     */
    public function it_should_return_required_field_exception()
    {
        $payment = new \Napoleon\IPay88\IPay88;

        $payment->setRequestParameters([
            'Amount'      => (float) 129.03,
            'RefNo'       => '175640054e84404ca35cd5f',
            'ProdDesc'    => 'Dummy Product Description',
            'UserName'    => 'napoleoncarino',
            'UserEmail'   => 'napoleon@example.com',
            'UserContact' => '09123456789',
        ]);
    }

    /**
     * @todo:: function name should be clear
     * @test
     * @group Negative
     * @expectedException \Napoleon\IPay88\Exceptions\BadMethodCallException
     */
    public function it_should_throw_bad_method_call_exception()
    {
        $payment = new \Napoleon\IPay88\IPay88;

        $payment->methodNotExists();
    }
}
