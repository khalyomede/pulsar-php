<?php
	require __DIR__ . '/../vendor/autoload.php';

	use Khalyomede\Pulsar;

	$pulsar = new Pulsar();

	$pulsar->url('http://jsonplaceholder.typicode.com')
		->toArray(); // optionnal

	$response = $pulsar->get('/posts');

	echo '<pre>';
	print_r( $response );
	echo '</pre>';
?>