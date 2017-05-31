<?php
	require __DIR__ . '/../vendor/autoload.php';

	use Khalyomede\Pulsar;

	$pulsar = new Pulsar();

	$pulsar->url('https://us13.api.mailchimp.com/3.0/')
		->authorization('key 6e8a7d9ddbcad31f86e4f11dd25fe5ed-us13')
		->toArray(); // optionnal

	$response = $pulsar->get('/lists');

	echo '<pre>';
	print_r( $response );
	echo '</pre>';
?>