<?php

namespace Napoleon\IPay88\Tests\Unit;

use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @test
     * @group Positive
     */
    public function it_should_echo_receive_ok()
    {
        $_REQUEST = ['Status' => 1];

        $response = new \Napoleon\IPay88\Response($_REQUEST);

        $this->assertEquals('RECEIVEOK', $response->init());
    }
}
