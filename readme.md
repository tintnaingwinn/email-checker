#Validate Email for Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

### Features

This package supports:

*   Validate with SMTP
*   Support for Disposable Email

### Quick Installation

```
composer require tintnaingwin/email-checker
```

For laravel >=5.5 that's all. This package supports Laravel new [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

If you are using Laravel < 5.5, you also need to add the service provider class to your project's `config/app.php` file:

##### Service Provider
```php
Tintnaingwin\EmailChecker\EmailCheckerServiceProvider::class,
```

##### Facade
```php
'EmailChecker' => Tintnaingwin\EmailChecker\Facades\EmailChecker::class,
```

#### Example
To add 'email_checker' at email rule
```php
  // [your site path]/app/Http/Requests/RegisterRequest.php
 public function rules()
     {
         return [
             'name'  => 'required|max:255',
             'email' => 'bail|required|email|max:255|unique:users|email_checker',
             'password' => 'bail|required|min:6|confirmed',
         ];
     }
```

#### Example Usage With Facade
 
 ```php
 // reture boolean
 EmailChecker::check('me@example.com');
```

## Testing

You can run the tests with:

```bash
vendor/bin/phpunit
```

### Credit
  - Disposable Email List
    * [Ilya Volodarsky](https://github.com/ivolo/disposable-email-domains/blob/master/index.json)

### License

The MIT License (MIT). Please see [License File](https://github.com/tintnaingwinn/email-checker/blob/master/LICENSE.txt) for more information.


[ico-version]: https://img.shields.io/packagist/v/tintnaingwin/email-checker.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/tintnaingwin/email-checker.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/tintnaingwin/email-checker
[link-downloads]: https://packagist.org/packages/tintnaingwin/email-checker
[link-author]: https://github.com/tintnaingwinn