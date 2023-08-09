<?php
declare(strict_types=1);

namespace App\Model;
ini_set('display_errors', 'on');
error_reporting(E_ALL);
use PDOException;
use PDO;
use PDOStatement;

class QueryManager {
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function executeQuery(string $query, array $parameters = []): PDOStatement|false {
        try{
         // Prepara e executa a consulta SQL com os parâmetros fornecidos
        $stmt = $this->connection->prepare($query);
        $stmt->execute($parameters);
        return $stmt;
        } catch (PDOException $e) {
        // Em caso de erro, exibe uma mensagem de erro
        echo "Erro ao executar consulta: " . $e->getMessage();
         return false;
        }
    }

    
}

?>