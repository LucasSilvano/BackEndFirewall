<?php
declare(strict_types=1);

namespace App\Model;

require __DIR__ . ('../../../vendor/autoload.php');
ini_set('display_errors', 'on');
error_reporting(E_ALL);
use PDO;
use PDOException;


class Connection {

    private string $host= DB_HOST;
    private string $database_name = DB_NAME;
    private string $user = DB_USER;
    private string $password= DB_PASS;
    private string $charset= DB_CHARSET;
    private  ?PDO $connection = null;

    protected function connect (): bool {
        try {
            // Estabelece a conexão com o banco de dados usando a extensão PDO
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database_name . ';charset=' . $this->charset, $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            // Em caso de falha na conexão, exibe uma mensagem de erro e encerra a execução
            die("Falha na conexão com o banco de dados: " . $e->getMessage());
        }
    }
    public function getConnection(): ?PDO {
        // Retorna a instância da conexão PDO
            $this->connect();
        // Retorna a conexão estabelecida
        return $this->connection;
    }
    public function closeConnection(): void {
        //Verifica se existe uma conexão
        if ($this->connection !== null) {
            // Fecha a conexão
            $this->connection = null;
        }
    }
};

?>