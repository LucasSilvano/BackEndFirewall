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
        // Obtém a URI da solicitação atual
        $this->uri = URI::get();
        // Obtém o método da solicitação (GET, POST, etc.)
        $this->method = RequesType::get();
        // Obtém as rotas registradas no aplicativo
        $this->routesRegistered = Routes::get();
    }

    // Função para lidar com roteamento simples
    private function simpleRouter() {
        if(array_key_exists($this->uri, $this->routesRegistered[$this->method])){
            // Retorna a rota correspondente, se encontrada
            return $this->routesRegistered[$this->method][$this->uri];
        }

        return null; // Retorna nulo se não houver rota correspondente
    }

    // Função para lidar com roteamento dinâmico
    // Função para lidar com roteamento dinâmico
    private function dynamicRouter() {
        foreach ($this->routesRegistered[$this->method] as $index => $route) {
            $regex = str_replace('/', '\/', ltrim($index, '/'));
            if ($index !== '/' && preg_match("/^$regex/", trim($this->uri, '/'))) {
                $routesRegisteredFound = $route; // Armazena a rota encontrada
                return $routesRegisteredFound;  // Adicione este retorno
            }
        }
        
        return null; // Retorne nulo se nenhuma rota for encontrada
    }


    // Função principal para obter a rota correspondente
    public function get() {
        $router = $this->simpleRouter();

        if($router) {
            return $router; // Retorna a rota encontrada
        }

        $router = $this->dynamicRouter();

        if($router) {
            return $router; // Retorna a rota dinâmica encontrada
        }

        return 'NotFoundController@index'; // Retorna o controlador padrão se nenhuma rota for encontrada
    }
}

?>
