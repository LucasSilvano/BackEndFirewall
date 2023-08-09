<?php
declare(strict_types=1);
namespace App\Utils;
ini_set('display_errors', 'on');
error_reporting(E_ALL);
class Validator
{
        // Método para validar e sanitizar o nome do usuário
    public static function validateUsername(string $username): string
    {
        // Remover espaços em branco no início e no fim do nome
        $username = trim($username);
            
        // Validar se o nome contém apenas letras e números
        if (!preg_match('/^[a-zA-Z0-9 ]+$/', $username)) {
            throw new \Exception('O nome deve conter apenas letras e espaços.');
        }
        // Sanitizar o nome para evitar XSS
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    
        return $username;
    }
    // Método para validar e sanitizar o nome do usuário
    public static function validateName(string $nome): string
    {
        // Remover espaços em branco no início e no fim do nome
        $nome = trim($nome);
        
        // Validar se o nome contém apenas letras e espaços
        if (!preg_match('/^[a-zA-Z ]+$/', $nome)) {
            throw new \Exception('O nome deve conter apenas letras e espaços.');
        }
        // Sanitizar o nome para evitar XSS
        $nome = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');

        return $nome;
    }

    // Método para validar e sanitizar o e-mail do usuário
    public static function validateEmail(string $email): string
    {
        // Remover espaços em branco no início e no fim do e-mail
        $email = trim($email);

        // Sanitizar o e-mail para evitar XSS e outros problemas
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        // Validar o formato do e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Formato de e-mail inválido.');
        }
        
        
        return $email;
    }

    // Método para validar e sanitizar a senha do usuário
    public static function validatePassword(string $senha): string
    {
        // Remover espaços em branco no início e no fim da senha
        $senha = trim($senha);

        // Verificar se a senha atende aos critérios de validação
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/', $senha)) {
            throw new \Exception('A senha deve conter pelo menos 6 caracteres, incluindo pelo menos uma letra maiúscula, uma letra minúscula e um número.');
        }

        // Não é necessário sanitizar a senha, pois não será exibida em HTML

        return $senha;
    }
}

?>