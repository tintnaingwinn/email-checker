<?php

namespace Tintnaingwin\EmailChecker\Tests\Rules;

use Tintnaingwin\EmailChecker\Rules\EmailExist;
use Tintnaingwin\EmailChecker\Tests\TestCase;

class EmailExistTest extends TestCase
{
    /** @test */
    public function it_can_validate_email_address()
    {
        $rule = new EmailExist();
        $this->assertTrue($rule->passes('attribute', 'amigo.k8@gmail.com'));
        $this->assertFalse($rule->passes('attribute', 'example@example.com'));
    }

    /** @test */
    public function it_will_fail_if_email_address_is_disposable_mail()
    {
        $rule = new EmailExist();
        $this->assertFalse($rule->passes('attribute', 'amigo.k8@0-mail.com'));
    }
}
