<?php
    use Khalyomede\Pulsar;

    if( function_exists('pulsar') === false ) {
        function pulsar() {
            return new Pulsar;
        }
    }
?>