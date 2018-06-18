<?php
    require(__DIR__ . '/../vendor/autoload.php');

    describe('pulsar', function() {
        describe('get', function() {
            it('should return an object by default', function() {
                expect(pulsar()->get('https://jsonplaceholder.typicode.com/posts/1')->content())->toBe()->an('object');
            });

            it('should return the object representing the json response', function() {
                $expected = json_decode('{
                    "userId": 1,
                    "id": 1,
                    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
                    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
                }');
    
                $actual = pulsar()->get('https://jsonplaceholder.typicode.com/posts/1')->content();
    
                expect($actual)->tobe()->equalTo($expected);
            });

            it('should return array if the option has been set', function() {
                expect(pulsar()->get('https://jsonplaceholder.typicode.com/posts/1')->toArray()->content())->toBe()->an('array');
            });
        });
    });
?>