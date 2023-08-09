<?php
namespace App\Core;

use App\Helpers\URI;
use App\Helpers\RequesType;
use App\Routes\Routes;

class RoutersFilter
{
    private string $uri;
    private string $method;
    private array $routesRegistered;

    public function __construct()
    {
        $this->uri = URI::get();
        $this->method = RequesType::get();
        $this->routesRegistered = Routes::get();
    }

    private function simpleRouter() {
        if(array_key_exists($this->uri, $this->routesRegistered[$this->method])){
            return $this->routesRegistered[$this->method][$this->uri];

        }

        return null;

    }
    private function dynamicRouter() {
        foreach ($this->routesRegistered[$this->method] as $index => $route) {
            $regex = str_replace('/', '\/', ltrim($index, '/'));
            if ($index !== '/' && preg_match("/^$regex/", trim($this->uri, '/'))) {
                $routesRegisteredFound = $route;
                break;
            }else{
                $routesRegisteredFound = null;
            }
            
        };
    }

    public function get() {
        $router = $this->simpleRouter();

        if($router) {
            return $router;
        }

        $router = $this->dynamicRouter();

        if($router) {
            return $router;
        }

        return 'NotFoundController@index';
    }
}

?>