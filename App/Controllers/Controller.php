<?php
declare(strict_types=1);

namespace App\Controllers;

use Exception;

abstract class Controller
{
    protected function view(string $view, array $data = [])
    {   extract($data);
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception("A view {$view} não existe");
        }
        
        require_once $viewPath;
    }
}

?>