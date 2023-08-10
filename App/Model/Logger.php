<?php
declare(strict_types=1);

namespace App\Model;

class Logger {
    private $logFile;
    private $logDirectory;

    public function __construct($logFile) {
        $this->logFile = $logFile;
        $this->logDirectory = __DIR__ . '/../../logs/'. $logFile; // Defina o diretório padrão aqui
    }

    public function log($message) {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "$timestamp - $message" . PHP_EOL;
        $logPath = $this->logDirectory . DIRECTORY_SEPARATOR . $this->logFile;

        file_put_contents($logPath, $logEntry, FILE_APPEND);
    }
}
?>