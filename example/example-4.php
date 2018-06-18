<?php
    require(__DIR__ . '/../vendor/autoload.php');

    $response = pulsar()->data([
        'title' => 'Test your PHP libraries with Matcha',
        'userId' => 1,
        'body' => 'Lorem ipsum'
    ])->post('https://jsonplaceholder.typicode.com/posts');

    print_r($response->content());
?>