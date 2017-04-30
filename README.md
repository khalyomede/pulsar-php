# pulsar-php
Let you get JSON result from an API in a breeze (without using curl)

## Why creating Pulsar ?
I did not wanted to use any curl commands, and I wanted an simple API that specificaly adress JSON API data retreiving.

## Installation

### 1. With Composer
You can both require my project via a command line command or manually.

#### Via the prompt command
Navigate to your project folder, and type :
```bash
composer require khalyomede/pulsar-php
```
This will download all the necessaries file to use my library, and reload the autoload requirer.

#### Manually (advanced user)
You can edit your `composer.json` file to require a specific version of Pulsar :
```json
{
    "name": "Johndoe/myproject",
    "description": "my project description",
    "type": "library",
    "license": "MIT",
    "minimum-stability": "dev",
    "require": {
    	"php" : ">=5.3.0",
    	"khalyomede/pulsar-php" : "0.0.1"
    }
}
```

### 2. Without Composer
If for example you design a blank PHP project (cron, ...), this section will adress your issue. Please ensure your PHP version runing is equal or above to `5.3.X`.

- Download the zip folder of my project from https://github.com/khalyomede/pulsar-php
- Copy the content of the file located at `zip/src/pulsar.php`
- Paste it on your dedicated class folder (to create one is highly recommended) to a file named `class.pulsar.php` (or any name following your class convention)
- Remove the line n°2 containing `namespace Khalyomede;`
- Include it in your files using `include_once('classfolder/class.pulsar.php)`
- You are ready to use the project using the command described below

## Usage
### Retreiving the content of a resource through a JSON API (GET)
```php
<?php
	// Do not foget to you call the autoload.php if needed

	use Khalyomede\Pulsar;
	// Or 
	include_once('classfolder/class.pulsar.php');

	$response = Pulsar::get('https://jsonplaceholder.typicode.com/posts/1');

	var_dump( $response );
?>
```

### Altering the content of a resource through a JSON API (PUT)
```php
<?php
	$updatedResource = [
		'id' => 1,
		'title' => 'foo',
		'body' => 'bar',
		'userId' => 1
	];

	$response = Api::put('https://jsonplaceholder.typicode.com/posts/1', $updatedResource);

	var_dump( $response );
?>
```

## Changelog
|Date|Issue|
|---|---|
|30 april 2017|First version online|
