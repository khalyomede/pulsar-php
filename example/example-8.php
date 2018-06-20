<?php
    require(__DIR__ . '/../vendor/autoload.php');

    $response = pulsar()->data([
        'name' => 'neo',
        'job' => 'developer at Metacortex'
    ])->put('https://reqres.in/api/users/2');

    print_r($response->content());
?>