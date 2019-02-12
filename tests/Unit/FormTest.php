<?php

namespace Napoleon\IPay88\Tests\Unit;

use Napoleon\IPay88\Utils\Form;
use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{
    /**
     * @test
     * @group Positive
     */
    public function it_should_generate_form_in_form_class()
    {
        $form = new Form;

        $fields = [
            'RefNo'       => '175640054e84404ca35cd5f',
            'Amount'      => (float) 129.03,
            'PaymentId'   => 1,
            'ProdDesc'    => 'Dummy Product Description',
            'UserName'    => 'napoleoncarino',
            'UserEmail'   => 'napoleon@example.com',
            'UserContact' => '09123456789',
            'ResponseURL' => 'www.your-response-url.com',
            'BackendURL'  => 'www.your-backend-url.com',
        ];

        $html = $form->create($fields)->html();

        $expected = "<form method='POST' action='https://sandbox.ipay88.com.ph/epayment/entry.asp' name='my-form-name'><input type='hidden' name='RefNo' value='175640054e84404ca35cd5f'><input type='hidden' name='Amount' value='129.03'><input type='hidden' name='PaymentId' value='1'><input type='hidden' name='ProdDesc' value='Dummy Product Description'><input type='hidden' name='UserName' value='napoleoncarino'><input type='hidden' name='UserEmail' value='napoleon@example.com'><input type='hidden' name='UserContact' value='09123456789'><input type='hidden' name='ResponseURL' value='www.your-response-url.com'><input type='hidden' name='BackendURL' value='www.your-backend-url.com'></form>";

        $this->assertEquals($expected, $html);
    }

    /**
     * @test
     * @todo:: add constant on paymentid for redability
     * @group Positive
     */
    public function it_should_generate_a_form()
    {
        $payment = new \Napoleon\IPay88\IPay88;

        $html = $payment->setRequestParameters([
            'Amount'      => 15.00,
            'PaymentId'   => 1,
            'RefNo'       => 'A00000001',
            'ProdDesc'    => 'Dummy Product Description',
            'UserName'    => 'napoleoncarino',
            'UserEmail'   => 'napoleon@example.com',
            'UserContact' => '09123456789',
            'ResponseURL' => 'www.your-response-url.com',
            'BackendURL'  => 'www.your-backend-url.com',
        ])->render();

        $expected = "<form method='POST' action='https://sandbox.ipay88.com.ph/epayment/entry.asp' name='my-form-name'><input type='hidden' name='MerchantCode' value='PH00001'><input type='hidden' name='RefNo' value='A00000001'><input type='hidden' name='Amount' value='129.03'><input type='hidden' name='PaymentId' value='1'><input type='hidden' name='Currency' value='PHP'><input type='hidden' name='Lang' value='ISO-8859-1'><input type='hidden' name='ProdDesc' value='Dummy Product Description'><input type='hidden' name='UserName' value='napoleoncarino'><input type='hidden' name='UserEmail' value='napoleon@example.com'><input type='hidden' name='UserContact' value='09123456789'><input type='hidden' name='Remark' value=''><input type='hidden' name='Signature' value='f53pzql3p1gIRvoLZgBmadpcenE='><input type='hidden' name='ResponseURL' value='www.your-response-url.com'><input type='hidden' name='BackendURL' value='www.your-backend-url.com'></form>";

        $this->assertEquals($expected, $html);
    }
}
