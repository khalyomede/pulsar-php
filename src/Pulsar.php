<?php
	namespace Khalyomede;

	use InvalidArgumentException;
	use Khalyomede\Response;

	/**
	 * Fetch or send data to an JSON API endpoint.
	 * 
	 * @example
	 * require(__DIR__ . '/vendor/autoload.php');
	 * 
	 * $data = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1')->content();
	 */
	class Pulsar {
		/**
		 * GET Protocol.
		 * 
		 * @var string
		 */
		const PROTOCOL_GET = 'GET';

		/**
		 * Mime type JSON
		 * 
		 * @var string
		 */
		const MIME_JSON = 'application/json';

		/**
		 * Exists only for visual convenience.
		 * 
		 * @var bool
		 */
		const DO_NOT_USE_INCLUDE_PATH = false;

		/**
		 * Get the response of an API endpoint.
		 * 
		 * @param string	$endpoint	The URL to ask for data.
		 * @return Khalyomede\Response
		 * @throws InvalidArgumentException
		 */
		public function get(string $endpoint) {
			return $this->request(static::PROTOCOL_GET, $endpoint);
		}

		/**
		 * Return the formatted result of a request with the given HTTP protocol.
		 * 
		 * @param string 	$protocol	The HTTP protocol.
		 * @param string	$endpoint	The URL to send or get data from.
		 * @return mixed
		 */
		private function request(string $protocol, string $endpoint) {
			$response = $this->response($protocol, $endpoint);
			
			return new Response(
				$response['content'],
				$response['headers']
			);
		}

		/**
		 * Return the raw result of the request with the given HTTP protocol.
		 * 
		 * @param string	$protocol	The HTTP protocol.
		 * @param string	$endpoint	The URL to send or get data from.
		 * @return array<array>
		 */
		private function response(string $protocol, string $endpoint) {
			return [
				'content' => file_get_contents($endpoint, static::DO_NOT_USE_INCLUDE_PATH, $this->context($protocol)),
				'headers' => $http_response_header
			];
		}

		/**
		 * Return a resource representing the flux of the context needed by file_get_contents.
		 * 
		 * @param string	$protocol	The HTTP protocol to use.
		 * @return resource
		 */
		private function context(string $protocol) {
			return stream_context_create([
				'http' => [
					'method' => $protocol,
					'header' => $this->headers()
				]
			]);
		}

		/**
		 * Return a string containing the necessary headers.
		 * 
		 * @return string
		 */
		private function headers() {
			$headers = [
				'Accept' => static::MIME_JSON
			];

			return implode("\r\n", array_map(function($key, $value) {
				return "$key: $value";
			}, array_keys($headers), $headers));
		}
	}
?>