<?php
	require __DIR__ . '/../vendor/autoload.php';

	use Khalyomede\Pulsar;

	$response = Pulsar::get('https://jsonplaceholder.typicode.com/posts/1');

	echo '<pre>';
	print_r( $response );
	echo '</pre>';
?>