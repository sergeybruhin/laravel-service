# Laravel Service Package (Command and Stubs)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sergeybruhin/laravel-service.svg?style=flat-square)](https://packagist.org/packages/sergeybruhin/laravel-service)
[![Total Downloads](https://img.shields.io/packagist/dt/sergeybruhin/laravel-service.svg?style=flat-square)](https://packagist.org/packages/sergeybruhin/laravel-service)

This package brings to laravel command to create custom service with service provider and straightforward folder
structure.

## Installation

You can install the package via composer:

```bash
composer require sergeybruhin/laravel-service
```

### Create Service

```php
php artisan create:service Delivery
```

## ToDo

- [ ] Add ability to create Actions for specific service
- [ ] Add ability to create Handlers for specific service
- [ ] Add ability to create Jobs for specific service
- [ ] Add ability to create Events for specific service
- [ ] Add ability to create Listeners for specific service
- [ ] Add ability to create Commands for specific service

### Testing (Not yet 💁‍♂️)

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email sundaycreative@gmail.com instead of using the issue tracker.

## Credits

- [Sergey Bruhin](https://github.com/sergeybruhin)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
