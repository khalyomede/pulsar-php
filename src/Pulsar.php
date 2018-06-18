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
		 * POST protocol.
		 * 
		 * @var string
		 */
		const PROTOCOL_POST = 'POST';

		/**
		 * PATCH protocol.
		 * 
		 * @var string
		 */
		const PROTOCOL_PATCH = 'PATCH';

		/**
		 * DELETE protocol.
		 * 
		 * @var string
		 */
		const PROTOCOL_DELETE = 'DELETE';

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
		 * Stores data that will be sent along with the request.
		 * 
		 * @var array<array>
		 */
		protected $data;

		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->data = [];
		}

		/**
		 * Get the response of an API endpoint.
		 * 
		 * @param string	$endpoint	The URL to ask for data.
		 * @return Khalyomede\Response
		 */
		public function get(string $endpoint) {
			return $this->request(static::PROTOCOL_GET, $endpoint);
		}

		/**
		 * Send a request et get the response of an endpoint that accept POST protocol.
		 * 
		 * @param string	$endpoint	The URL to request.
		 * @return Khalyomede\Response
		 */
		public function post(string $endpoint) {
			return $this->request(static::PROTOCOL_POST, $endpoint);
		}

		/**
		 * Send a PATCH request to the endpoint.
		 * 
		 * @param string	$endpoint	The URL to request.
		 * @return Khalyomede\Response
		 */
		public function patch(string $endpoint): Response {
			return $this->request(static::PROTOCOL_PATCH, $endpoint);
		}

		/**
		 * Send a DELETE request to the endpoint.
		 * 
		 * @param string	$endpoint	The URL to request.
		 * @return Khalyomede\Response
		 */
		public function delete(string $endpoint): Response {
			return $this->request(static::PROTOCOL_DELETE, $endpoint);
		}

		/**
		 * Stores some data to be sent along with the request (useful with POST for instance).
		 * 
		 * @param array<array>
		 * @return Khalyomede\Pulsar
		 */
		public function data(array $array): Pulsar {
			$this->data = $array;

			return $this;
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
			$content = @file_get_contents($endpoint, static::DO_NOT_USE_INCLUDE_PATH, $this->context($protocol));

			return [
				'content' => $content ?: '{}',
				'headers' => $http_response_header ?? []
			];
		}

		/**
		 * Return a resource representing the flux of the context needed by file_get_contents.
		 * 
		 * @param string	$protocol	The HTTP protocol to use.
		 * @return resource
		 */
		private function context(string $protocol) {
			$context = [
				'http' => [
					'method' => $protocol,
					'header' => $this->headers($protocol),
					'ignore_errors' => true
				],
				'ssl' => [
					'verify_peer' => false,
					'verify_peer_name' => false
				]
			];

			if( $protocol === static::PROTOCOL_POST || $protocol === static::PROTOCOL_PATCH ) {
				$context['http']['content'] = http_build_query($this->data);
			}

			return stream_context_create($context);
		}

		/**
		 * Return a string containing the necessary headers.
		 * 
		 * @param string	$protocol	The HTTP protocol to send the request through.
		 * @return string
		 */
		private function headers(string $protocol) {
			$headers = [
				'Accept' => static::MIME_JSON
			];

			if( $protocol === static::PROTOCOL_POST || $protocol === static::PROTOCOL_PATCH ) {
				$data = http_build_query($this->data);

				$headers['Content-type'] = 'application/x-www-form-urlencoded';
				$headers['Content-Length'] = strlen($data);
			}

			return implode("\r\n", array_map(function($key, $value) {
				return "$key: $value";
			}, array_keys($headers), $headers));
		}
	}
?>