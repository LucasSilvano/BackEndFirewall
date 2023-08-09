<?php
declare(strict_types=1);

namespace App\Model;

use FFI;

// Classe Logger para registrar mensagens de log em um arquivo
class Logger {
    private $logFile;

    // Construtor da classe que recebe o nome do arquivo de log
    public function __construct($logFile){
        $this->logFile = $logFile;
    }

    // Método para registrar uma mensagem de log no arquivo
    public function log($message) {
        // Obtém o timestamp atual no formato 'Y-m-d H:i:s'
        $timestamp = date('Y-m-d H:i:s');
        // Formata a entrada do log com timestamp e mensagem
        $logEntry = "$timestamp - $message" . PHP_EOL;
        // Escreve a entrada do log no arquivo, anexando ao conteúdo existente
        file_put_contents($this->logFile, $logEntry, FILE_APPEND);
    }
}

?>
