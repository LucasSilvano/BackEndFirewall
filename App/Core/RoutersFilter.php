<?php
namespace App\Core;
require __DIR__ . ('../../../vendor/autoload.php');
use App\Helpers\URI;
use App\Helpers\RequesType;
use App\Routes\Routes;

// Declaração da classe RoutersFilter
class RoutersFilter
{
    private string $uri;
    private string $method;
    private array $routesRegistered;

    // Construtor da classe
    public function __construct()
    {
        // Obtém a URI da solicitação atual
        $this->uri = URI::get();
        // Obtém o método da solicitação (GET, POST, etc.)
        $this->method = RequesType::get();
        // Obtém as rotas registradas no aplicativo
        $this->routesRegistered = Routes::get();
    }

    // Função privada para lidar com roteamento simples
    private function simpleRouter() {
        if (array_key_exists($this->uri, $this->routesRegistered[$this->method])) {
            // Retorna a rota correspondente, se encontrada
            return $this->routesRegistered[$this->method][$this->uri];
        }

        return null; // Retorna nulo se não houver rota correspondente
    }

    // Função privada para lidar com roteamento dinâmico
    private function dynamicRouter() {
        foreach ($this->routesRegistered[$this->method] as $index => $route) {
            $regex = str_replace('/', '\/', ltrim($index, '/'));
            if ($index !== '/' && preg_match("/^$regex/", trim($this->uri, '/'))) {
                // Armazena a rota encontrada
                $routesRegisteredFound = $route;
                // Retorna a rota dinâmica encontrada
                return $routesRegisteredFound;
            }
        }
        
        return null; // Retorna nulo se nenhuma rota dinâmica for encontrada
    }

    // Função principal para obter a rota correspondente
    public function get() {
        // Tenta obter uma rota correspondente usando roteamento simples
        $router = $this->simpleRouter();

        if ($router) {
            return $router; // Retorna a rota encontrada
        }

        // Tenta obter uma rota correspondente usando roteamento dinâmico
        $router = $this->dynamicRouter();

        if ($router) {
            return $router; // Retorna a rota dinâmica encontrada
        }

        // Retorna o controlador padrão se nenhuma rota for encontrada
        return 'NotFoundController@index';
    }
}

?>