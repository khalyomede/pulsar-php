<?php
	namespace Khalyomede;

	class Pulsar {
		public $headers;
		public $data;
		public $url;
		public $object;
		public $duration;
		public $json;

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->headers = [];
			$this->headers['Content-type'] = 'application/x-www-form-urlencoded';
			$this->data = [];
			$this->object = false;
			$this->json = false;
		}

		/**
		 * Set the header of the API call 
		 *
		 * @param string $name they key of the header chain
		 * @param string $value the value of the header chain
		 * @example $pulsar->header("Content-type", "application/x-www-form-urlencoded")
		 * @return Pulsar
		 */
		public function header( $name, $value ) {
			$hdr = (string) $value;
			$hdr = str_replace(':', '', $hdr);
			$nme = (string) $name;

			$this->headers[ $nme ] = $hdr;

			return $this;
		}

		/**
		 * Set multiple headers for the API call 
		 *
		 * @param string $array array of key-pair containing the key and the value of a header chain
		 * @example $pulsar->headers(["Content-type" => "application/x-www-form-urlencoded", "Authorization" => "key XAR554GHG"]);
		 * @return Pulsar
		 * @see Pulsar::header
		 * @return Pulsar
		 */
		public function headers( $array ) {
			foreach( $array as $key => $value ) {
				$k = (string) $key;
				$v = (string) $value;

				$this->header( $k, $v);
			}

			return $this;
		}

		/**
		 * Fill data attribute with parameters
		 * 
		 * @param string $name the key of the data
		 * @param string $value the value of the data
		 * @example $pulsar->data("search", "constellations")
		 * @return Pulsar
		 */
		public function data( $name, $value ) {
			$nme = (string) $name;

			$this->data[ $nme ] = $value;

			return $this;
		}

		/**
		 * Fill data from an array of data
		 *
		 * @param mixed[] $array array of key-pair representing the data
		 * @return Pulsar
		 * @example $pulsar->data(["search" => "constellations", "dateSearch", "2017-12-31"]);
		 */
		public function datas( $array ) {
			foreach( $array as $key => $value ) {
				$k = (string) $key;

				$this->data( $k, $value );
			}

			return $this;
		}

		/**
		 * Cast the response in an object
		 *
		 * @return Pulsar
		 * @example $pulsar->toObject();
		 */
		public function toObject() {
			$this->object = true;

			return $this;
		}

		/**
		 * Cast the response in array (usefull only if you previously set the response to object)
		 *
		 * @return Pulsar
		 * @example $pulsar->toArray();
		 */
		public function toArray() {
			$this->object = false;

			return $this;
		}

		/**
		 * Return the sanitized URL of the root of the API
		 *
		 * @param string $value the root of the API
		 * @return Pulsar
		 * @example $pulsar->url("https://jsonplaceholder.typicode.com/");
		 */
		public function url( $value ) {
			$u = (string) $value;
			$u = trim( $u );
			$u = rtrim( $u, '/' );

			$this->url = $u;

			return $this;
		}

		/**
		 * Set the header "Content-type"
		 *
		 * @param string $value the value of the associated content type
		 * @return Pulsar
		 * @example $pulsar->contentType("application/x-www-form-urlencoded");
		 */
		public function contentType( $value ) {
			$v = (string) $value;

			$this->header('Content-type', $v);

			return $this;
		}

		/**
		 * Set the "Authorization" header
		 *
		 * @param string $value the value of the associated authorization
		 * @return Pulsar
		 * @example $pulsar->authorization("key $20$aze46aze846az8e46a8z4");
		 */
		public function authorization( $value ) {
			$v = (string) $value;

			$this->header('Authorization', $v);

			return $this;
		}

		/**
		 * Get the response of an api using HTTP/GET
		 *
		 * @param string $endpoint the last part of the URL to call an api (not the root)
		 * @return array | object
		 * @example $pulsar->url("https://jsonplaceholder.typicode.com")->get("/posts");
		 */
		public function get( $endpoint ) {			
			return $this->response('GET', $this->sanitizeEndpoint( $endpoint ));			
		}

		/**
		 * Set the resource of an api using HTTP/POST
		 *
		 * @param string $endpoint the last part of the URL to call an api (not the root)
		 * @return array | object
		 * @example $pulsar->url("https://jsonplaceholder.typicode.com")->post("/posts");
		 */
		public function post( $endpoint ) {	
			return $this->response('POST', $this->sanitizeEndpoint( $endpoint ));
		}

		/**
		 * Update the resource of an api using HTTP/PUT
		 *
		 * @param string $endpoint the last part of the URL to call an api (not the root)
		 * @return array | object
		 * @example $pulsar->url("https://jsonplaceholder.typicode.com")->put("/posts/1");
		 */
		public function put( $endpoint ) {	
			return $this->response('PUT', $this->sanitizeEndpoint( $endpoint ));
		}

		/**
		 * Delete the resource of an api using HTTP/DELETE
		 *
		 * @param string $endpoint the last part of the URL to call an api (not the root)
		 * @return array | object
		 * @example $pulsar->url("https://jsonplaceholder.typicode.com")->delete("/posts/1");
		 */
		public function delete( $endpoint ) {	
			return $this->response('DELETE', $this->sanitizeEndpoint( $endpoint ));
		}	

		/**
		 * Remove all the data stored
		 * 
		 * @return Khalyomede\Pulsar
		 * @example $pulsar->clean();
		 * @return Khalyomede\Pulsar
		 */
		public function clean() {
			$this->data = [];

			return $this;
		}

		private function startDuration() {
			return microtime(true);
		}

		private function endDuration( $start ) {
			return microtime(true) - $start;
		}

		public function dataTypeText() {
			$this->json = false;

			return $this;
		}

		public function dataTypeJson() {
			$this->json = true;

			return $this;
		}

		private function sanitizeEndpoint( $endpoint ) {
			$point = (string) $endpoint;
			$point = trim( $point );
			$point = $point[0] != '/' ? '/' . $point : $point;

			return $point;
		}

		private function response( $method, $endpoint ) {	
			$start = $this->startDuration();

			$response = $this->content( $this->target( $endpoint ), $this->streamContext( $this->StreamContextOptions( $method ) ) );

			$this->duration = $this->endDuration( $start );

			return $response;
		}

		private function streamContext( $options ) {
			return stream_context_create( $options );
		}

		private function target( $endpoint ) {
			return $this->url . $endpoint;
		}

		private function streamContextOptions( $method ) {
			$data = $this->json ? json_encode( $this->buildData() ) : http_build_query( $this->buildData() );

			return [
				'http' => [
			        'header'  => $this->buildHeaders(),
			        'method'  => $method,
        			'content' => $data
			    ]
			];
		}

		private function buildData() {
			$data = [];

			foreach( $this->data as $key => $value ) {
				$data[ $key ] = $value;
			}

			return $data;
		}

		private function buildHeaders() {
			$headers = "";

			foreach( $this->headers as $key => $value ) {
				$headers .= $key . ': ' . $value . "\r\n";
			}

			return $headers;
		}

		private function content( $url, $context ) {
			$responseContent = [];			

			if( $this->object ) {
				$responseContent = (object) json_decode(file_get_contents( $url, false, $context ));	
			}
			else {
				$responseContent = json_decode(file_get_contents( $url, false, $context ), true);	
			}
			
			return $responseContent;			
		}
	}
?>