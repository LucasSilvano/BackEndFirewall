<?php

namespace App\Routes;

// Classe Routes para definir as rotas da aplicação
class Routes {
    public static function get() {
        // Retorna um array associativo contendo as rotas mapeadas para métodos e controladores
        return [
            'get' => [
                '/' => 'TesteController@testNoParams',
                '/hello/[0-9]+' => 'TesteController@testWithParams'
                
            ]
        ];
    }

}

?>
