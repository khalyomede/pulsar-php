<?php
    namespace Khalyomede;

    /**
     * This class is the response of what you will have using Pulsar get/post/put/delete methods.
     * 
     * @example
     * require(__DIR__ . '/vendor/autoload.php');
     * 
     * $response = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1');
     * 
     * $data = $response->content();
     * $code = $response->code(); // 200: Ok, > 200: Not ok
     * 
     * @see Khalyomede\Pulsar
     */
    class Response {
        /**
         * Exists only for visual convenience.
         * 
         * @var int
         */
        const PATTERN_MATCHES = 1;

        /**
         * Stores the raw result of the request to the API.
         * 
         * @var string
         */
        protected $content;

        /**
         * Stores the headers attached to the API response after a request to its endpoint.
         * 
         * @var array<array>
         */
        protected $headers;

        /**
         * If equals to true, the response will be converted to an array, else it will be converted to an object (or an array of objects).
         * 
         * @var bool
         */
        protected $convert_to_array;

        /**
         * True if the headers should be analyzed e.g. do a foreach and extract the correct parts from all the array items.
         * 
         * @var bool
         */
        protected $need_to_analyze_headers;

        /**
         * Constructor.
         * 
         * @param string        $content    The content of the response after a request to the endpoint of the API.
         * @param array<array>  $headers    The attached headers to this response.
         */
        public function __construct(string $content, array $headers) {
            $this->content = $content;
            $this->headers = $headers;
            $this->convert_to_array = false;
            $this->need_to_analyze_headers = true;
        }

        /**
         * Returns the content of the response.
         * 
         * @return array|object
         */
        public function content() {
            return json_decode(
                $this->content,
                $this->convert_to_array
            );
        }

        /**
         * Return the HTTP status code from the response of the requets to the API.
         * 
         * @return int
         */
        public function code() {
            $this->analyzeHeadersIfNeeded();

            return (int) $this->code;
        }

        /**
         * Set the response to be fetched as an array instead of an object.
         * 
         * @return Khalyomede\Response
         */
        public function toArray(): Response {
            $this->convert_to_array = true;
            
            return $this;
        }

        /**
         * Loop through each headers and extract the needed parts.
         * 
         * @return void
         */
        private function analyzeHeadersIfNeeded(): void {
            if( $this->need_to_analyze_headers === true ) {
                foreach( $this->headers as $header ) {
                    $matches = [];
    
                    // HTTP Status code
                    // HTTP response phrase
                    if( preg_match('/^HTTP\/[1-2](?:[.][\d])?\s(\d{3})\s{0,1}(\w*)$/', $header, $matches) === static::PATTERN_MATCHES ) {
                        $this->code = $matches[1];
                        $this->response_phrase = $matches[2] ?? '';
                    }
                }

                $this->need_to_analyze_headers = false;
            }
        }
    }
?>