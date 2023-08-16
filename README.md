# Laravel Link Shortener

<!-- BADGES_START -->
[![Latest Version][badge-release]][packagist]
[![PHP Version][badge-php]][php]
[![Tests][badge-tests]][tests]
[![Total Downloads][badge-downloads]][downloads]

[badge-tests]: https://github.com/orlovtech/short-link/actions/workflows/ci-tests.yml/badge.svg
[badge-release]: https://img.shields.io/packagist/v/orlovtech/short-link.svg?style=flat-square&label=release
[badge-php]: https://img.shields.io/packagist/php-v/orlovtech/short-link.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/orlovtech/short-link.svg?style=flat-square&colorB=mediumvioletred

[packagist]: https://packagist.org/packages/orlovtech/short-link
[php]: https://php.net
[downloads]: https://packagist.org/packages/orlovtech/short-link
[tests]: https://github.com/orlovtech/short-link/actions/workflows/ci-tests.yml
<!-- BADGES_END -->

## Table of Contents

- [Overview](#overview)
- [Installation](#installation)
    - [Requirements](#requirements)
    - [Install the Package](#install-the-package)
    - [Publish the Config and Migrations](#publish-the-config-and-migrations)
    - [Migrate the Database](#migrate-the-database)
- [Generate the Link](#generate-the-link)
- [Testing](#testing)
- [License](#license)

## Overview

A Laravel package that can be used for adding shortened URLs to your existing web app.

## Installation

### Requirements
The package has been developed and tested to work with the following minimum requirements:

- PHP 8.0
- Laravel 9.0

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

### Generate the Link
The fastest way to generate new link is to use the facade `OrlovTech\ShortLink\Facades\ShortLink` like this:

```php
ShortLink::generate('https://yourlink.com');
```

This method will return you short version of your link.

Method `generate` also has the second parameter `singleUse` as an option.
With this parameter you can specify that your link should be deleted after it was used for the first time.

So the full view might be:

```php
ShortLink::generate(
    'https://yourlink.com',
    singleUse: true,
);
```

To show ready link use param `default_short_url` like so:

```php
$link = ShortLink::generate('https://yourlink.com');

echo config('app.url') . $link->default_short_url;
```

## Testing

To run the package's unit tests, run the following command:

``` bash
vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
