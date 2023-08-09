<?php

namespace App\Helpers;

// Configurações para exibir erros
ini_set('display_errors', 'on');
error_reporting(E_ALL);

// Classe RequesType para obter o tipo de requisição HTTP (GET, POST, etc.)
class RequesType {
    // Método estático para obter o tipo de requisição
    public static function get(): string {
        // Retorna o método de requisição em letras minúsculas (ex: "get", "post")
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }
}

?>
