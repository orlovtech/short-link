# Laravel Link Shortener Package

<!-- BADGES_START -->
[![Latest Version][badge-release]][packagist]
[![PHP Version][badge-php]][php]
[![Tests][badge-tests]][tests]
[![Total Downloads][badge-downloads]][downloads]

[badge-tests]: https://github.com/orlovkn/laravel-link-shortener/actions/workflows/test.yml/badge.svg
[badge-release]: https://img.shields.io/packagist/v/orlovkn/laravel-link-shortener.svg?style=flat-square&label=release
[badge-php]: https://img.shields.io/packagist/php-v/orlovkn/laravel-link-shortener.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/orlovkn/laravel-link-shortener.svg?style=flat-square&colorB=mediumvioletred

[packagist]: https://packagist.org/packages/orlovkn/laravel-link-shortener
[php]: https://php.net
[downloads]: https://packagist.org/packages/orlovkn/laravel-link-shortener
[tests]: https://github.com/orlovkn/laravel-link-shortener/actions/workflows/test.yml
<!-- BADGES_END -->

## Table of Contents

- [Overview](#overview)
- [Installation](#installation)
    - [Requirements](#requirements)
    - [Install the Package](#install-the-package)
    - [Publish the Config and Migrations](#publish-the-config-and-migrations)
    - [Migrate the Database](#migrate-the-database)

## Overview

A Laravel package that can be used for adding shortened URLs to your existing web app.

## Installation

### Requirements
The package has been developed and tested to work with the following minimum requirements:

- PHP 8.0
- Laravel 8.0

### Install the Package
You can install the package via Composer:

```bash
composer require orlovtech/short-link
```

### Publish the Config and Migrations
You can then publish the package's config file and database migrations by using the following command:
```bash
php artisan vendor:publish --provider="OrlovTech\ShortLink\Providers\ShortLinkServiceProvider"
```

### Migrate the Database
This package contains one migration that add a new table to the database: ```short_links```. To run this migration, simply run the following command:
```bash
php artisan migrate
```

## Testing

To run the package's unit tests, run the following command:

``` bash
vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
