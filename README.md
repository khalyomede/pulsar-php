# Pulsar-php

API request and response, without using CURL.

![Packagist](https://img.shields.io/packagist/v/khalyomede/pulsar-php.svg)
![PHP from Packagist](https://img.shields.io/packagist/php-v/khalyomede/pulsar-php.svg)
![Packagist](https://img.shields.io/packagist/l/khalyomede/pulsar-php.svg)

&nbsp;
<div style="display: table; width: 100%; height: 90px;">
    <div style="display: table-row; width: 100%; height: 100%;">
        <div style="display: table-cell; vertical-align: middle; text-align: center;">
            <img src="https://user-images.githubusercontent.com/15908747/41560722-4848ca90-7348-11e8-9918-d22340703b2c.png" height="90px" alt="Pulsar-PHP logo" />
        </div>
    </div>
</div>

## Summary

- [Installation](#installation)
- [PHP support](#php-support)
- [Examples](#examples)
- [Credits](#credits)

## Installation

In your project, add the following dependency:

```bash
composer require khalyomede/pulsar-php:3.*
```

## PHP support

To use this library for PHP 5.3+ until 5.6, use the version `1.*` of this library. Note the version 1 and 2 are no longer maintainted.

## Examples

- [Sending a GET request](#sending-a-get-request)
- [Sending a POST request](#sending-a-post-request)
- [Sending a PATCH request](#sending-a-patch-request)
- [Sending a DELETE request](#sending-a-delete-request)
- [Sending a request to a non existing endpoint](#sending-a-request-to-a-non-existing-endpoint)
- [Get the response as an array](#get-the-response-as-an-array)
- [Get the HTTP status code](#get-the-http-status-code)

### Sending a GET request

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

### Sending a POST request

```php
require(__DIR__ . '/../vendor/autoload.php');

$response = pulsar()->data([
  'title' => 'Test your PHP libraries with Matcha',
  'userId' => 1,
  'body' => 'Lorem ipsum'
])->post('https://jsonplaceholder.typicode.com/posts');

print_r($response->content());
```

```php
stdClass Object
(
  [title] => Test your PHP libraries with Matcha
  [userId] => 1
  [body] => Lorem ipsum
  [id] => 101
)
```

### Sending a PATCH request

```php
require(__DIR__ . '/../vendor/autoload.php');

$response = pulsar()->data([
  'name' => 'morpheus',
  'job' => 'zion resident'
])->patch('https://reqres.in/api/users/2');

print_r($response->content());
```

```php
stdClass Object
(
  [name] => morpheus
  [job] => zion resident
  [updatedAt] => 2018-06-18T21:29:15.334Z
)
```

### Sending a DELETE request

```php
require(__DIR__ . '/../vendor/autoload.php');

$response = pulsar()->delete('https://reqres.in/api/users/2');

echo $response->code();
```

```php
204
```

### Sending a request to a non existing endpoint

In this case, you will always get a `404` status code and an empty response.

```php
require(__DIR__ . '/../vendor/autoload.php');

$response = pulsar()->get('https://a-non-existing-domain-hopefully.com/api/v1/post');

echo $response->code();
```

```bash
404
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

$array = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1')->toArray()->content();

print_r($array);
```

Which is the same as:

```php
require(__DIR__ . '/../vendor/autoload.php');

$response = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1');

$array = $response->toArray()->content();

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

### Get the HTTP status code

```php
require(__DIR__ . '/../vendor/autoload.php');

$response = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1');

echo $response->code();
```

```bash
200
```

## Credits

- Logo by [Anthony Ledoux](https://thenounproject.com/Vntole/) from [Noun Project](https://thenounproject.com/) (the current version is modified, this is the [original version](https://thenounproject.com/search/?q=black%20hole&i=1667364))