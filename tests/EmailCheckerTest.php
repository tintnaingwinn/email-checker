<?php
/**
 * Created by PhpStorm.
 * User: tintnaingwin
 * Date: 4/17/18
 * Time: 2:47 PM
 */
use Tintnaingwin\EmailChecker\EmailChecker;
use PHPUnit\Framework\TestCase;

class EmailCheckerTest extends TestCase
{
    public $email_checker;

    /**
     * EmailCheckerTest constructor.
     */

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->email_checker = new EmailChecker();
    }

    public function testEmailCheckerIsTrue()
    {
        $this->assertTrue($this->email_checker->check('amigo.k8@gmail.com'));
    }

    public function testEmailCheckerIsFalse()
    {
        $this->assertFalse($this->email_checker->check('example@example.com'));
    }

    public function testDisposableMailIsFalse()
    {
        $this->assertFalse($this->email_checker->check('amigo.k8@0-mail.com'));
    }

}