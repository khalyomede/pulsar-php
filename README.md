# Pulsar-php

API request and response, without using CURL.

![Packagist](https://img.shields.io/packagist/v/khalyomede/pulsar-php.svg)
![PHP from Packagist](https://img.shields.io/packagist/php-v/khalyomede/pulsar-php.svg)
![Packagist](https://img.shields.io/packagist/l/khalyomede/pulsar-php.svg)

## Summary

- [Installation](#installation)
- [PHP support](#php-support)
- [Examples](#examples)

## Installation

In your project, add the following dependency:

```bash
composer require khalyomede/pulsar-php:2.*
```

## PHP support

To use this library for PHP 5.3+ until 5.6, use the version `1.*` of this library. Note the version 1 is no longer maintainted.

## Examples

- [Fetch an API content throught GET](#fetch-an-api-content-through-get)
- [Get the response as an array](#get-the-response-as-an-array)

### Fetch an API content throught GET

```php
require(__DIR__ . '/../vendor/autoload.php');

$content = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1')->content();

print_r($content);
```

```php
stdClass Object
(
    [userId] => 1
    [id] => 1
    [title] => sunt aut facere repellat provident occaecati excepturi optio reprehenderit
    [body] => quia et suscipit
suscipit recusandae consequuntur expedita et cum
reprehenderit molestiae ut ut quas totam
nostrum rerum est autem sunt rem eveniet architecto
)
```

### Get the response as an array

You can do so by using `->toArray()` modifier:

```php
require(__DIR__ . '/../vendor/autoload.php');
```

### Get the response as an array

You can use the `toArray()` modifier for this purpose:

```php
require(__DIR__ . '/../vendor/autoload.php');

$array = pulsar()->toArray()->get('https://jsonplaceholder.typicode.com/posts/1')->content();

print_r($array);
```

```php
Array
(
    [userId] => 1
    [id] => 1
    [title] => sunt aut facere repellat provident occaecati excepturi optio reprehenderit
    [body] => quia et suscipit
suscipit recusandae consequuntur expedita et cum
reprehenderit molestiae ut ut quas totam
nostrum rerum est autem sunt rem eveniet architecto
)
```