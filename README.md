# Validate Email for Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]  

**Notice** -  That extracts the MX records from the email address and connect with the mail server to make sure the mail address accurately exist. So it may be slow loading time in local and some co-operate MX records take a long time.

You can install the package via composer:

```
composer require tintnaingwin/email-checker
```
The package will automatically register itself.

### Translations

If you wish to edit the package translations, you can run the following command to publish them into your `resources/lang` folder

```bash
php artisan vendor:publish --provider="Tintnaingwin\EmailChecker\EmailCheckerServiceProvider"
```

### Features

This package supports:

*   Validate with SMTP
*   Support for Disposable Email

## Usage

### `Form Request Validation`
To add 'email_checker' at email attribute

```php
    // [your site path]/app/Http/Requests/RegisterRequest.php
    public function rules()
    {
        return [
               'name' => 'required|string|max:255',
               'email' => 'required|string|email|max:255|unique:users|email_checker',
               'password' => 'required|string|min:6|confirmed',
        ];
    }
```

### `In a RegisterController`

```php
    // [your site path]/app/Http/Controllers/Auth/RegisterController.php
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users|email_checker',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
```

### `Using Rule Objects`

```php
    use TintNaingWin\EmailChecker\Rules\EmailExist;

    $request->validate([
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new EmailExist],
    ]);
```

### `Usage With Facade`
You can also check check email manually: 
 
 ```php
 // reture boolean
 EmailChecker::check('me@example.com');
```

## Testing
Run the tests with:

``` bash
composer test
```

### Credit
  - Disposable Email List
    * [Ilya Volodarsky](https://github.com/ivolo/disposable-email-domains/blob/master/index.json)

### Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.    
    
## Security
If you discover any security-related issues, please email amigo.k8@gmail.com instead of using the issue tracker.    

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


[ico-version]: https://img.shields.io/packagist/v/tintnaingwin/email-checker.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/tintnaingwin/email-checker.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/tintnaingwin/email-checker
[link-downloads]: https://packagist.org/packages/tintnaingwin/email-checker
[link-author]: https://github.com/tintnaingwinn
