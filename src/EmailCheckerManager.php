<?php

namespace Tintnaingwin\EmailChecker;

class EmailCheckerManager {

    /**
     * The email checker instance.
     *
     * @var \Tintnaingwin\EmailCheckerPHP\EmailChecker
     */
    protected $checker;

    /**
     * Create a new email checker instance.
     *
     * @param \Tintnaingwin\EmailCheckerPHP\EmailChecker $checker
     * @return void
     */
    public function __construct($checker)
    {
        $this->checker = $checker;
    }

    /**
     * To verify an email address exist.
     * @return bool
     */
    public function check($email): bool
    {
        return $this->checker->check($email);
    }
}

