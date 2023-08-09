<?php
declare(strict_types=1);

namespace App\Model;

// Inclui o arquivo de autoload do Composer para carregar as classes automaticamente
require __DIR__ . ('../../../vendor/autoload.php');

// Configurações para exibir erros
ini_set('display_errors', 'on');
error_reporting(E_ALL);

use PDO;
use PDOException;

// Classe Connection para estabelecer conexão com o banco de dados
class Connection {

    // Atributos para as informações de conexão
    private string $host = DB_HOST;
    private string $database_name = DB_NAME;
    private string $user = DB_USER;
    private string $password = DB_PASS;
    private string $charset = DB_CHARSET;
    private ?PDO $connection = null;

    // Método protegido para estabelecer a conexão com o banco de dados
    protected function connect(): bool {
        try {
            // Estabelece a conexão com o banco de dados usando a extensão PDO
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database_name . ';charset=' . $this->charset, $this->user, $this->password);
            // Define o modo de erro e exceção do PDO
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            // Em caso de falha na conexão, exibe uma mensagem de erro e encerra a execução
            die("Falha na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    // Método público para obter a instância da conexão PDO
    public function getConnection(): ?PDO {
        // Chama o método connect() para estabelecer a conexão
        $this->connect();
        // Retorna a conexão estabelecida
        return $this->connection;
    }

    // Método para fechar a conexão
    public function closeConnection(): void {
        // Verifica se existe uma conexão ativa
        if ($this->connection !== null) {
            // Fecha a conexão
            $this->connection = null;
        }
    }
};

?>
