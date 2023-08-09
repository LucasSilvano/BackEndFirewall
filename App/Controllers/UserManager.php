<?php
declare(strict_types=1);

namespace App\Controllers;
ini_set('display_errors', 'on');
error_reporting(E_ALL);
require __DIR__ . ('../../../vendor/autoload.php');

class UserManager {
    private \App\Model\CRUD $crud;

    public function __construct()
    {
    // Cria uma instáncia da classe CRUD  para gerenciar as operações de CRUD no banco de dados
    $this->crud = new \App\Model\CRUD();
    }
    public function createData(string $table, array $userData): bool {
        
    return $this->crud->create($table, $userData);
    }

    public function readData(string $table,string $column, string $where = null): array|false {

        return $this->crud->read($table, $column, $where );
    }
    public function readAllData(string $table,string $column, string $where = null): array|false {

        return $this->crud->readAll($table, $column, $where );
    }


    public function updateData(string $table,array $data , string $where): bool {

        // Chama o método update da classe CRUD para atualizar o usuário no banco de dados
        return $this->crud->update($table, $data ,$where);
    }

    public function deleteData(string $table,array $where): void {
        $this->crud->delete($table,$where);
    }

}

?>
