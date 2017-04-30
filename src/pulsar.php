<?php
	namespace Khalyomede;

	class Pulsar {
		public static function post( $url, $data = [] ) {
			return self::response( 'POST', $url, $data );
		}

		public static function get( $url, $data = [] ) {			
			return self::response( 'GET', self::encodeUrl( $url, $data ), $data );
		}

		public static function put( $url, $data = [] ) {
			return self::response( 'PUT', $url, $data );
		}

		public static function delete( $url, $data = [] ) {
			return self::response( 'DELETE', $url, $data );
		}

		private static function options( $method, $data ) {
			return [
				'http' => [
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => $method,
        			'content' => http_build_query($data)
			    ]
			];
		}

		private static function streamContext( $options ) {
			return stream_context_create( $options );
		}

		private static function content( $url, $context ) {
			return json_decode(file_get_contents( $url, false, $context ));
		}

		private static function response( $method, $url, $data ) {
			return self::content( $url, self::streamContext( self::options( $method, $data ) ) );
		}

		private static function encodeUrl( $url, $data ) {
			return $url . (self::hasInterrogationMark( $url ) ? '' : '?') . http_build_query( $data );
		}

		private static function hasInterrogationMark( $url ) {
			return $url[strlen($url) - 1] == '?';
		}
	}
?>