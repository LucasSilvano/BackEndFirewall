<?php
declare(strict_types=1);

namespace App\Model;

// Inclui o arquivo de autoload do Composer para carregar as classes automaticamente
require __DIR__ . ('../../../vendor/autoload.php');

use PDO;
use PDOException;

// Configurações para exibir erros
ini_set('display_errors', 'on');
error_reporting(E_ALL);

// Classe CRUD para realizar operações CRUD no banco de dados
class CRUD extends \App\Model\Connection {
    private \App\Model\Connection $db;
    private \App\Model\QueryManager $queryManager;

    // Construtor da classe
    public function __construct()
    {
        // Cria uma instância da classe Database para gerenciar a conexão com o banco de dados
        $this->db = new Connection();
        $this->db->connect();
        // Cria uma instância da classe QueryManager, passando a conexão com o banco de dados
        $this->queryManager = new \App\Model\QueryManager($this->db->getConnection());
    }

    // Método para criar um registro na tabela
    public function create(string $table, array $data): bool {
        // Monta uma lista de colunas e placeholders para inserção de dados
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        try {
            // Constrói a consulta SQL para inserção de dados
            $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $this->queryManager->executeQuery($query, $data);
            echo "Inserção de registro com sucesso!";
            return true;
        } catch (PDOException $e) {
            // Em caso de erro, exibe uma mensagem de erro
            echo "Erro ao criar registro: " . $e->getMessage() . "<br>";
            return false;
        }
    }

    // Método para ler todos os registros da tabela com possível filtro WHERE
    public function readAll(string $table, string $column, string $where = null): array|false {
        // Constrói a consulta SQL para leitura de registros
        $query = "SELECT $column FROM $table";
        // Verifica se existe algum parâmetro WHERE
        if ($where !== null) {
            $query .= " WHERE $where";
        }

        try {
            // Executa a consulta SQL
            $stmt = $this->queryManager->executeQuery($query);
            // Obtém os registros retornados
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;

        } catch (PDOException $e) {
            // Em caso de erro, exibe uma mensagem de erro
            echo "Erro ao ter registros: " . $e->getMessage();
            return false;
        }
    }

    // Método para deletar um registro da tabela com base em uma condição WHERE
    public function delete(string $table, array $where): void {
        try {
            $conditions = [];
            foreach ($where as $column => $value) {
                $conditions[] = "$column = :$column"; // Monta as condições da cláusula WHERE
            }
            $whereClause = implode(' AND ', $conditions); // Combina as condições com 'AND'
            
            $query = "DELETE FROM $table WHERE $whereClause"; // Monta a consulta DELETE
            $stmt = $this->queryManager->executeQuery($query, $where); // Executa a consulta com os parâmetros
            echo "Registro deletado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao deletar: " . $e->getMessage(); // Em caso de erro, exibe a mensagem
        }
    }
}
?>