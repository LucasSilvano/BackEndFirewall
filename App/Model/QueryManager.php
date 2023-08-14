<?php
declare(strict_types=1);

namespace App\Model;
require __DIR__ . ('../../../vendor/autoload.php');
// Configurações para exibir erros
ini_set('display_errors', 'on');
error_reporting(E_ALL);

use PDOException;
use PDO;
use PDOStatement;

// Classe QueryManager para preparar e executar consultas SQL usando uma conexão PDO
class QueryManager {
    private PDO $connection;

    // Construtor da classe que recebe uma instância de conexão PDO
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    // Método para preparar e executar uma consulta SQL com parâmetros
    public function executeQuery(string $query, array $parameters = []): PDOStatement|false {
        try {
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
