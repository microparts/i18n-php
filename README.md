This package deprecated and abandoned.
--------------------------------------

I18n For PHP
============

[![CircleCI](https://circleci.com/gh/microparts/i18n-php.svg?style=svg)](https://circleci.com/gh/microparts/i18n-php)
[![codecov](https://codecov.io/gh/microparts/i18n-php/branch/master/graph/badge.svg)](https://codecov.io/gh/microparts/i18n-php)

A small instrument for help us use internalization company standard.
Have a hard dependency from [configuration package](https://github.com/microparts/configuration-php).

## Installation

```bash
composer install microparts/i18n-php
```

## Usage

Basic:
```php
$manager = new Manager($conf); // $conf is a our default configuration module
$i18n = $manager->load();

$i18n->getDisplayLang();
$i18n->isTranslateList();
$i18n->getFallbackLang();
$i18n->getSecondLang();
```

With headers, but headers from PSR `MessageInterface`:
```php
$manager = new Manager($conf); // $conf is a our default configuration module
$i18n = $manager->withMessage($request)->load();

$i18n->getDisplayLang();
$i18n->isTranslateList();
$i18n->getFallbackLang();
$i18n->getSecondLang();
```

With headers, but headers from other source:
```php
$manager = new Manager($conf); // $conf is a our default configuration module
$i18n = $manager->withHeaders($headers)->load(); // where $headers is a key => value array of headers

$i18n->getDisplayLang();
$i18n->isTranslateList();
$i18n->getFallbackLang();
$i18n->getSecondLang();
```

## Depends

* \>= PHP 7.2
* Composer for install package

## License

GNU GPL v3
