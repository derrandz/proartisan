# :package_name

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A tiny laravel package that runs artisan commands in production, specifically made for people who do not necessarily have access to SSH and still need to run migrations for instance.

This package is made by Hamza Ouaghad, and is licensed under the MIT license.

## Install

Via Composer

``` bash
$ composer require hamzaouaghad/ProArtisan
```

## Usage

``` bash
$ composer dumpautoload
$ php artisan vendor:publish
```

The available routes to interact with the package 

```bash
/proartisan/insert_commands
```

The use is very basic, you have two input columns,

The first one is supposed to receive the command, and the second one is supposed to receive the arguments.

The format of the command is supposed to be as follows :

```php
Original command :php artisan mycommand

//The way you should put it in the input field

[Input Field] : mycommand
```

####Example

```php

Original command:

php artisan migrate --database=mydatabase

The way you should insert it :

[Input field] : migrate
[Arguments field] : --database=mydatabase
```

For the commands with no value such as `--force`, please use them as follows

```bash

--force=true

```

## Important
For migrations and other command that might prompt interactive questions, the package uses by default the '--no-interaction' 
argument.

If you in production, please use `'--force'.`

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [:author_name][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/league/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/thephpleague/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/thephpleague/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/thephpleague/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/league/:package_name.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/league/:package_name
[link-travis]: https://travis-ci.org/thephpleague/:package_name
[link-scrutinizer]: https://scrutinizer-ci.com/g/thephpleague/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/thephpleague/:package_name
[link-downloads]: https://packagist.org/packages/league/:package_name
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
