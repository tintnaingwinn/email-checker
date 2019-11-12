<?php

namespace Tintnaingwin\EmailChecker;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Tintnaingwin\EmailCheckerPHP\EmailChecker as EmailCheckerPHP;
use Tintnaingwin\EmailChecker\Facades\EmailChecker;

class EmailCheckerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/emailChecker'),
        ]);

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'emailChecker');

        Validator::extend('email_checker', function ($attribute, $value, $parameters, $validator) {
            return EmailChecker::check($value);
        }, __('emailChecker::messages.email'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('email-checker-php', function ($app) {
            return new EmailCheckerPHP();
        });

        $this->app->singleton('email-checker', function ($app) {
            return new EmailCheckerManager($app['email-checker-php']);
        });
    }
}
