<?php
declare(strict_types=1);

namespace App\Controllers;

// Carrega automaticamente as classes do Composer (autoload)
require __DIR__ . ('../../../vendor/autoload.php');

// Declaração da classe TesteController, que estende a classe Controller
class TesteController extends Controller
{
    // Método público para teste sem parâmetros
    public function testNoParams()
    {
        // Chama o método view da classe pai (Controller) para exibir a visualização 'firewall'
        $this->view('firewall');
    }

    // Método público para teste com parâmetros
    public function testWithParams($params)
    {
        // Cria um array de dados a partir dos parâmetros fornecidos
        $data = [
            'name' => $params[0],
            'age' => $params[1]
        ];

        // Chama o método view da classe pai (Controller) para exibir a visualização 'firewallsem' com os dados fornecidos
        $this->view('firewallsem', $data);
    }
}
?>