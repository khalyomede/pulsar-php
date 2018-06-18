<?php
    require(__DIR__ . '/../vendor/autoload.php');

    $response = pulsar()->data([
        'name' => 'morpheus',
        'job' => 'zion resident'
    ])->patch('https://reqres.in/api/users/2');

    print_r($response->content());
?>