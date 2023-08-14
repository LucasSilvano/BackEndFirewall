<?php

namespace App\Core;
require __DIR__ . ('../../../vendor/autoload.php');
use Exception;

// Declaração da classe Controller
class Controller {
    // Método para executar uma rota específica
    public function execute(string $router) {
        // Verifica se a rota está no formato esperado (controller@method)
        if (!str_contains($router, '@')) {
            throw new Exception("A rota está registrada com o formato errado");
        }

        // Divide a rota nos elementos controller e method
        list($controller, $method) = explode('@', $router);

        // Namespace base para os controladores
        $namespace = "App\Controllers\\";
        $controllerNamespace = $namespace.$controller;

        // Verifica se a classe do controlador existe
        if (!class_exists($controllerNamespace)) {
            throw new Exception("O controller {$controllerNamespace} não existe");
        }

        // Cria uma instância do controlador
        $controller = new $controllerNamespace;

        // Verifica se o método existe no controlador
        if (!method_exists($controller, $method)) {
            throw new Exception("O método {$method} não existe no controller {$controllerNamespace}");
        }

        // Obtém os parâmetros da rota usando a classe ControllerParams
        $params =  new ControllerParams;
        $params = $params->get($router);

        // Chama o método do controlador com os parâmetros
        $controller->$method($params);
    }
}

?>