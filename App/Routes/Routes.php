<?php

namespace App\Routes;

class Routes {
    public static function get() {
        return [
            'get' => [
                '/' => 'TesteController@testNoParams'
            ]
        ];
    }
}

?>