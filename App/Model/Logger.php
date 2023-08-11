<?php
declare(strict_types=1);

namespace App\Model;

// Classe Logger para registrar mensagens de log
class Logger {
    private $logFile;
    private $logDirectory;

    // Construtor da classe
    public function __construct($logFile) {
        // Define o nome do arquivo de log
        $this->logFile = $logFile . '.txt';
        // Define o diretório onde os arquivos de log serão armazenados
        $this->logDirectory = __DIR__ . '/logs'; // Defina o diretório padrão aqui

        // Verifica se o diretório existe ou cria-o se não existir
        if (!is_dir($this->logDirectory)) {
            mkdir($this->logDirectory, 0777, true);
        }
    }

    // Método para registrar uma mensagem de log
    public function log($message) {
        // Obtém o timestamp atual no formato desejado
        $timestamp = date('Y-m-d H:i:s');
        // Formata a mensagem de log
        $logEntry = "$timestamp - $message" . PHP_EOL;
        // Caminho completo para o arquivo de log
        $logPath = $this->logDirectory . DIRECTORY_SEPARATOR . $this->logFile;

        // Adiciona a mensagem de log ao arquivo de log
        file_put_contents($logPath, $logEntry, FILE_APPEND);
    }
}
?>