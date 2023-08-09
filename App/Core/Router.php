<?php
namespace App\Core;

require_once __DIR__ . '/../../vendor/autoload.php';


class Router {
    public static function run() {
        $routerRegistered = new RoutersFilter;
        $router = $routerRegistered->get();
        var_dump($router);
    }
}


?>
