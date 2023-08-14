<?php

namespace App\Core;
require __DIR__ . ('../../../vendor/autoload.php');
use App\Helpers\URI;
use App\Helpers\RequesType;
use App\Routes\Routes;
// Declaração da classe ControllerParams
class ControllerParams {

    // Método privado para filtrar os parâmetros da rota
    private function filterParams(string $router) {
        // Obtém a URI da requisição
        $uri = URI::get();
        
        // Divide a URI e a rota em segmentos
        $explodeURI = explode('/', $uri);
        $explodeRouter = explode('/', $router);

        $params = []; // Inicializa a variável $params

        // Compara os segmentos da URI com os da rota e captura os parâmetros
        foreach ($explodeRouter as $index => $routerSegment) {
            if ($routerSegment !== $explodeURI[$index]) {
                $params[$index] = $explodeURI[$index];
            }
        }
        return $params;
    }

    // Método público para obter os parâmetros da rota
    public function get(string $router) {
        // Obtém as rotas definidas
        $routes = Routes::get();
        
        // Obtém o método da requisição (GET, POST, etc.)
        $requestMethod = RequesType::get();

        // Encontra a rota na lista de rotas definidas
        $router = array_search($router, $routes[$requestMethod]);

        // Filtra os parâmetros da rota
        $params = $this->filterParams($router);

        // Se não houver parâmetros, define como um array vazio
        if ($params === null) {
            $params = [];
        }

        // Retorna os parâmetros em formato de array numerado
        return array_values($params);
    }
}

?>