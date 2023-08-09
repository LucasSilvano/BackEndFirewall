<?php

namespace App\Helpers;
ini_set('display_errors', 'on');
error_reporting(E_ALL);

class URI {
    public static function get() {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }
}

?>