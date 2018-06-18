<?php
    require(__DIR__ . '/../vendor/autoload.php');

    $array = pulsar()->toArray()->get('https://jsonplaceholder.typicode.com/posts/1');

    print_r($array);
?>