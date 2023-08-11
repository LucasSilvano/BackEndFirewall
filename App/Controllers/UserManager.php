<?php
declare(strict_types=1);

namespace App\Controllers;

// Configurações para exibir erros
ini_set('display_errors', 'on');
error_reporting(E_ALL);

// Inclui o arquivo de autoload do Composer para carregar as classes automaticamente
require __DIR__ . ('../../../vendor/autoload.php');

// Classe UserManager para gerenciar operações relacionadas ao usuário
class UserManager {
    private \App\Model\CRUD $crud;

    public function __construct()
    {
        // Cria uma instância da classe CRUD para gerenciar as operações de CRUD no banco de dados
        $this->crud = new \App\Model\CRUD();
    }

    // Método para criar dados na tabela
    public function createData(string $table, array $userData): bool {
        return $this->crud->create($table, $userData);
    }
    // Método para ler todos os dados da tabela com possibilidade de filtro WHERE
    public function readAllData(string $table, string $column, string $where = null): array|false {
        return $this->crud->readAll($table, $column, $where);
    }
    // Método para deletar dados da tabela com base em uma condição WHERE
    public function deleteData(string $table, array $where): void {
        $this->crud->delete($table, $where);
    }
}
?>
