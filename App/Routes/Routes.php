<?php
/*
namespace App\Routes;

class Routes {
    private static $routes = [
        'get' => [],
        'post' => [],
        'put' => [],
        'delete' => []
    ];

    public static function addRoute($method, $route, $controllerMethod) {
        self::$routes[$method][$route] = $controllerMethod;
    }

    public static function get() {
        return self::$routes;
    }
}

*/

namespace App\Routes;



// Classe Routes para definir as rotas da aplicação
class Routes {
    public static function get() {
        // Retorna um array associativo contendo as rotas mapeadas para métodos e controladores
        return [
            'get' => [
                '/' => 'FirewallController@index',
                '/hello/[a-z]+/age/[1-9]+' => 'TesteController@testWithParams'
                
            ],
            'post' => [
                '/firewall/addruler' => 'FirewallController@addRuler',
                '/firewall/removeruler/(\d+)' => 'FirewallController@removeRuler',
                '/firewall/editruler' => '/firewall/addruler@editRuler'

            ]
        ];
    }

}

?>
