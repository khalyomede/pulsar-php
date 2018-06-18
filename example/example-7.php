<?php
    require(__DIR__ . '/../vendor/autoload.php');

    $response = pulsar()->delete('https://reqres.in/api/users/2');

    echo $response->code();
?>