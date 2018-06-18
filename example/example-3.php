<?php
    require(__DIR__ . '/../vendor/autoload.php');

    $response = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1');

    print_r($response->code());
?>