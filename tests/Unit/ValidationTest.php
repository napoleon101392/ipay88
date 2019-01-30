<?php

namespace Napoleon\IPay88\Tests\Unit;

use PHPUnit\Framework\TestCase;

use Napoleon\IPay88\Contracts\ValidatorInterface;

class ValidationTest extends TestCase
{
    /**
     * @test
     * @test Positive
     */
    public function it_should_be_an_instance_of_validator_interface()
    {
        $form_field_validator = new \Napoleon\IPay88\Validation\FormFieldValidator;
        $required_field_validator = new \Napoleon\IPay88\Validation\RequiredFieldValidator;

        $this->assertInstanceOf(ValidatorInterface::class, $form_field_validator);
        $this->assertInstanceOf(ValidatorInterface::class, $required_field_validator);
    }
}
