<?php

namespace Tintnaingwin\EmailChecker\Tests;

use Tintnaingwin\EmailChecker\Facades\EmailChecker;

class EmailCheckerTest extends TestCase
{
    public $email_checker;

    /** @test */
    public function it_can_validate_email_address()
    {
        $this->assertTrue(EmailChecker::check('amigo.k8@gmail.com'));
        $this->assertFalse(EmailChecker::check('example@example.com'));
    }

    /** @test */
    public function it_will_fail_if_email_address_is_disposable_mail()
    {
        $this->assertFalse(EmailChecker::check('amigo.k8@0-mail.com'));
    }

}
