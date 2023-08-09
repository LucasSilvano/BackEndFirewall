<?php
declare(strict_types=1);
namespace App\Utils;
ini_set('display_errors', 'on');
error_reporting(E_ALL);

class ErrorHandler {
    // Registra os tratadores de erros, exceções e desligamento.
    public static function register(): void {
        set_error_handler([__CLASS__, 'errorHandler']);
        set_exception_handler([__CLASS__, 'exceptionHandler']);
        register_shutdown_function([__CLASS__, 'shutdownHandler']);
    }

    // Converte erros em exceções para um tratamento consistente.
    public static function errorHandler($severity, $message, $file, $line): void {
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }

    // Lida com exceções lançadas no código.
    public static function exceptionHandler($exception): void {
        $code = $exception->getCode();
        $message = $exception->getMessage();
        $file = $exception->getFile();
        $line = $exception->getLine();

        // Registra a exceção em um arquivo de log.
        error_log("Exceção [$code]: $message em $file na linha $line");
        
        // Exibe uma mensagem amigável ao usuário, se necessário.
        echo "Ocorreu um erro. Por favor, tente novamente mais tarde.";

        // Você também pode renderizar uma página de erro personalizada aqui, se desejar.
    }

    // Lida com erros fatais que ocorrem durante o encerramento do script.
    public static function shutdownHandler(): void {
        $error = error_get_last();
        if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            // Registra o erro fatal em um arquivo de log.
            error_log("Erro Fatal: {$error['message']} em {$error['file']} na linha {$error['line']}");
            
            // Exibe uma mensagem amigável ao usuário, se necessário.
            echo "Ocorreu um erro fatal. Por favor, entre em contato com o suporte.";

            // Você também pode renderizar uma página de erro personalizada aqui, se desejar.
        }
    }
}
?>
