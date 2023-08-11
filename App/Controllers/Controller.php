<?php
declare(strict_types=1);

namespace App\Controllers;

use Exception;

abstract class Controller
{
    protected function view(string $view, array $data = [])
    {   
        // Extrai os elementos do array $data em variáveis individuais
        extract($data);

        // Define o caminho completo para o arquivo de visualização
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        // Verifica se o arquivo de visualização existe
        if (!file_exists($viewPath)) {
            throw new Exception("A view {$view} não existe");
        }
        
        // Inclui (requer) o arquivo de visualização
        require_once $viewPath;
    }
}
?>
