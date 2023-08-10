<?php

namespace App\Core;
use App\Helpers\URI;
use App\Helpers\RequesType;
use App\Routes\Routes;

class ControllerParams {

    private function filterParams(string $router) {
        $uri = URI::get();
        $explodeURI = explode('/', $uri);
        $explodeRouter = explode('/', $router);
    
        $params = []; // Inicialize a variável $params
    
        foreach ($explodeRouter as $index => $routerSegment) {
            if ($routerSegment !== $explodeURI[$index]) {
                $params[$index] = $explodeURI[$index];
            }
        }
        return $params;
    }

    public function get(string $router) {
        $routes = Routes::get();
        $requestMethod = RequesType::get();
    
        $router = array_search($router, $routes[$requestMethod]);
    
        $params = $this->filterParams($router);
    
        if ($params === null) {
            $params = [];
        }
    
        return array_values($params);
    }
}


?>