<?php
namespace App\Core;

// Inclui o arquivo de autoload do Composer para carregar as classes automaticamente
require_once __DIR__ . '/../../vendor/autoload.php';

// Classe Router responsável por iniciar o roteamento
class Router {
    // Método estático para iniciar o roteamento
    public static function run() {
        try {
            // Cria uma instância da classe RoutersFilter para gerenciar o roteamento
            $routerRegistered = new RoutersFilter;
            // Obtém a rota correspondente através do método get() da classe RoutersFilter
            $router = $routerRegistered->get();
            
            $controller = new Controller;
            $controller->execute($router);
            // Imprime no console (var_dump) a rota encontrada ou nula
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
?>
