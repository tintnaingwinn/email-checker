<?php

namespace Tintnaingwin\EmailChecker;

use Validator;
use Illuminate\Support\ServiceProvider;

class EmailCheckerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('email_checker', function($attribute, $value, $parameters, $validator) {
            $email = new EmailChecker();
            return $email->check($value);
        },'Invalid Email Address');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
