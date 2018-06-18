<?php
    require(__DIR__ . '/../vendor/autoload.php');

    $array = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1')->toArray()->content();

    print_r($array);
?>