<?php

namespace Tintnaingwin\EmailChecker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method bool check(string $email)
 *
 * @see \Tintnaingwin\EmailChecker\EmailCheckerManager
 */
class EmailChecker extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'email-checker';
    }
}
