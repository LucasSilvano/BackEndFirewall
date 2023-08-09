<?php
declare(strict_types=1);

namespace App\Model;

require __DIR__ . ('../../../vendor/autoload.php');

use PDO;
use PDOException;
ini_set('display_errors', 'on');
error_reporting(E_ALL);


class CRUD extends  \App\Model\Connection{
    private \App\Model\Connection  $db;
    private \App\Model\QueryManager $queryManager;

    public function __construct()
    {
        // Cria uma instância da classe Database para gerenciar a conexão com o banco de dados
        $this->db = new Connection();
        $this->db->connect();
        // Cria uma instância da classe QueryManager, passando a conexão com o banco de dados
        $this->queryManager = new \App\Model\QueryManager($this->db->getConnection());
    }
    public function create(string $table, array $data): bool {

        //Monta uma lista de colunas e placeholders para inserção de dados
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        try {
            // Constrói a consulta SQL para inserção de dados
            $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $this->queryManager->executeQuery($query, $data);
            echo "Inserção de registro com sucesso!";
            return true;
        } catch (PDOException $e) {
            //Em caso de erro, exibe uma mensagem de erro.
            echo "Erro ao criar registro: " . $e->getMessage(). "<br>";
            return false;
        }
        
    }

    public function read(string $table,string $column, string $where = null): array|false {
        //Constrói a consulta SQL para leitura de registros
        $query = "SELECT $column FROM $table";  
        // Verificar se existe algum parametro
        if ($where !== null) {
            $query .= " WHERE $where";
        }
    
        try {
            //Executa a consulta SQL
            $stmt = $this->queryManager->executeQuery($query);
            // Obtém os registros retornados
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;
    
        } catch (PDOException $e) {
            //Em caso de erro, exibe uma mensagem de erro
            echo "Erro ao ter registros: " . $e->getMessage();
            return false;
        }  
        
    }

    public function readAll(string $table,string $column, string $where = null): array|false {
        //Constrói a consulta SQL para leitura de registros
        $query = "SELECT $column FROM $table";  
        // Verificar se existe algum parametro
        if ($where !== null) {
            $query .= " WHERE $where";
        }
    
        try {
            //Executa a consulta SQL
            $stmt = $this->queryManager->executeQuery($query);
            // Obtém os registros retornados
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
    
        } catch (PDOException $e) {
            //Em caso de erro, exibe uma mensagem de erro
            echo "Erro ao ter registros: " . $e->getMessage();
            return false;
        }  
    }


    public function update(string $table,array $data,string $where): bool {
        $setColumns = [];
        $parameters = [];
    
        foreach ($data as $key => $value) {
            $setColumns[] = "$key = :$key";
            $parameters[":$key"] = $value;
        }
    
        try {
            $query = "UPDATE $table SET " . implode(", ", $setColumns) . " WHERE $where";
            $stmt = $this->queryManager->executeQuery($query, $parameters);
            echo "Atualização realizada com sucesso!";
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar registro: " . $e->getMessage();
        }
    }

    public function delete(string $table,array $where): void {
        try {
            $query = "DELETE FROM $table WHERE $where";
            $stmt = $this->queryManager->executeQuery($query);
            echo "Registro deletado com sucesso!";

        } catch (PDOException $e) {
            echo "Erro ao deletar: " . $e->getMessage();
        }
    }
}

?>