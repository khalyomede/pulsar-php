<?php
    require(__DIR__ . '/../vendor/autoload.php');

    describe('pulsar', function() {
        describe('get', function() {
            $response = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1'); 

            it('should return an object by default', function() use($response) {
                expect($response->content())->toBe()->an('object');
            });

            it('should return the object representing the json response', function() use($response) {
                $expected = json_decode('{
                    "userId": 1,
                    "id": 1,
                    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
                    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
                }');
    
                expect($response->content())->tobe()->equalTo($expected);
            });

            it('should return array if the option has been set', function() use($response) {
                expect($response->toArray()->content())->toBe()->an('array');
            });

            it('should return a status code as an integer', function() use($response) {
                expect($response->code())->toBe()->an('int');
            });
        });

        describe('post', function() {
            $response = pulsar()->data(['title' => 'New in PHP 7.2', 'body' => 'Lorem ipsum.', 'userId' => 1])->post('https://jsonplaceholder.typicode.com/posts');
            

            it('should return a status code as an integer', function() use($response) {
                expect($response->code())->toBe()->an('int');
            });

            it('should return an object representing the response', function() use($response) {
                $expected = json_decode('{
                    "title": "New in PHP 7.2",
                    "userId": "1",
                    "body": "Lorem ipsum.",
                    "id": 101
                }');
                
                expect($response->content())->toBe()->equalTo($expected);
            });

            it('should return an array if the option has been set', function() use($response) {
                expect($response->toArray()->content())->toBe()->an('array');
            });
        });

        describe('non existing endpoint', function() {
            $response = pulsar()->get('https://non-existing.com/api/v1/post');

            it('should always return a 404 when the endpoint does not exist', function() use($response) {
                expect($response->code())->toBe()->equalTo(404);
            });

            it('should always return an empty object when the endpoint does not exist', function() use($response) {
                expect($response->content())->toBe()->equalTo(new StdClass);
            });
        });
    });
?>