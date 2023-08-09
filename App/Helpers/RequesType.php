<?php

namespace App\Helpers;
ini_set('display_errors', 'on');
error_reporting(E_ALL);

class RequesType {
    public static function get(): string {
        {
            return strtolower($_SERVER["REQUEST_METHOD"]);
        }
    }
}

?>