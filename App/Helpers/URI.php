<?php

namespace App\Helpers;

// Configurações para exibir erros
ini_set('display_errors', 'on');
error_reporting(E_ALL);

// Classe URI para obter a parte do caminho da URL da requisição
class URI {
    // Método estático para obter a parte do caminho da URL
    public static function get() {
        // Obtém a parte do caminho da URL da requisição usando parse_url e PHP_URL_PATH
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }
}

?>
