<?php
    require(__DIR__ . '/../vendor/autoload.php');

    $content = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1')->content();

    print_r($content);
?>