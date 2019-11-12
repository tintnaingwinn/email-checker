<?php

namespace Tintnaingwin\EmailChecker\Rules;

use Illuminate\Contracts\Validation\Rule;
use Tintnaingwin\EmailChecker\Facades\EmailChecker;

class EmailExist implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return EmailChecker::check($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('emailChecker::messages.email');
    }
}
