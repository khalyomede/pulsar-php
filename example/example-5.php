<?php
    require(__DIR__ . '/../vendor/autoload.php');

    $response = pulsar()->get('https://a-non-existing-domain-hopefully.com/api/v1/post');

    echo $response->code();
?>