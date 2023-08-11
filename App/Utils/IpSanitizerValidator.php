<?php

namespace App\Utils;

// Classe IpSanitizerValidator para sanitizar e validar endereços IP
class IpSanitizerValidator
{
    // Método estático para sanitizar e validar um endereço IP
    public static function sanitizeAndValidateIp($ip)
    {
        // Remove espaços em branco do início e do fim do endereço IP
        $ip = trim($ip);

        // Verifica se o endereço IP é válido usando a função filter_var() com a opção FILTER_VALIDATE_IP
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip; // Retorna o endereço IP se for válido
        }

        return false; // Retorna falso se o endereço IP não for válido
    }
}
?>
