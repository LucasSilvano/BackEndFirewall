<?php
declare(strict_types=1);

namespace App\Model;

use FFI;

class Logger {
    private $logFile;

    public function __construct($logFile){
        $this->logFile = $logFile;
    }
    public function log($message) {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "$timestamp - $message" . PHP_EOL;
        file_put_contents($this->logFile, $logEntry, FILE_APPEND);
    }

}

?>