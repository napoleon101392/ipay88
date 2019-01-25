<?php

namespace IPay88\Tests\Unit;

use PHPUnit\Framework\TestCase;

use IPay88\Exceptions\BadMethodCallException;
use IPay88\Exceptions\FieldNotAcceptableException;
use IPay88\Exceptions\RequiredFieldsException;

class FormTest extends TestCase
{
    /**
     * @test
     * @group Positive
     */
    public function it_should_generate_a_form()
    {
        $payment = new \IPay88\IPay88;

        $html = $payment->setRequestParameters([
            'Amount' => (float)129.03,
            'PaymentId' => 1,
            'RefNo' => '175640054e84404ca35cd5f',
            'ProdDesc' => 'Dummy Product Description',
            'UserName' => 'napoleoncarino',
            'UserEmail' => 'napoleon@example.com',
            'UserContact' => '09123456789',
            'ResponseURL' => '192.168.5.7/thank-you-for-your-donation/',
            'BackendURL' => '192.168.5.7/wp-json/unicef/v1/ipay88/hook'
        ])->render();

        $expected = "<form method='POST' action='https://sandbox.ipay88.com.ph/epayment/entry.asp' name='my-form-name'><input type='hidden' name='MerchantCode' value='PH00460'><input type='hidden' name='RefNo' value='175640054e84404ca35cd5f'><input type='hidden' name='Amount' value='129.03'><input type='hidden' name='PaymentId' value='1'><input type='hidden' name='Currency' value='PHP'><input type='hidden' name='Lang' value='ISO-8859-1'><input type='hidden' name='ProdDesc' value='Dummy Product Description'><input type='hidden' name='UserName' value='napoleoncarino'><input type='hidden' name='UserEmail' value='napoleon@example.com'><input type='hidden' name='UserContact' value='09123456789'><input type='hidden' name='Remark' value=''><input type='hidden' name='Signature' value='bUbV3I6Votzs6QUTPgJUQyTFDJQ='><input type='hidden' name='ResponseURL' value='192.168.5.7/thank-you-for-your-donation/'><input type='hidden' name='BackendURL' value='192.168.5.7/wp-json/unicef/v1/ipay88/hook'></form>";

        $this->assertEquals($expected, $html);
    }

    /**
     * @test
     * @group Negative
     * @expectedException \IPay88\Exceptions\RequiredFieldsException
     */
    public function it_should_return_required_field_exception()
    {
        $payment = new \IPay88\IPay88;

        $payment->setRequestParameters([
            'Amount' => (float)129.03,
            'RefNo' => '175640054e84404ca35cd5f',
            'ProdDesc' => 'Dummy Product Description',
            'UserName' => 'napoleoncarino',
            'UserEmail' => 'napoleon@example.com',
            'UserContact' => '09123456789'
        ]);
    }

    /**
     * @test
     * @group Negative
     * @expectedException \IPay88\Exceptions\FieldNotAcceptableException
     */
    public function it_should_throw_field_not_acceptable_exception()
    {
        $payment = new \IPay88\IPay88;

        $payment->setRequestParameters([
            'notexists' => 'eee'
        ]);
    }

    /**
     * @test
     * @group Negative
     * @expectedException \IPay88\Exceptions\BadMethodCallException
     */
    public function it_should_throw_error()
    {
        $payment = new \IPay88\IPay88;

        $payment->methodNotExists();
    }

    /**
     * @test
     * @group Positive
     */
    public function it_should_return_sandbox_endpoint()
    {
        $payment = new \IPay88\IPay88;

        $endpoint = $payment->endPoint(false);

        $expected = 'https://sandbox.ipay88.com.ph/epayment/entry.asp';

        $this->assertEquals($expected, $endpoint);
    }

    /**
     * @test
     * @group Positive
     */
    public function it_should_return_production_endpoint()
    {
        $endpoint = (new \IPay88\IPay88)->endPoint(true);

        $expected = 'https://payment.ipay88.com.ph/epayment/entry.asp';

        $this->assertEquals($expected, $endpoint);
    }
}
