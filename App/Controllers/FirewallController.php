<?php
declare(strict_types=1);

namespace App\Controllers;
require __DIR__ . ('../../../vendor/autoload.php');

use App\Model\Logger;
use App\Utils\IpSanitizerValidator;

// Carrega automaticamente as classes do Composer (autoload)

// Declaração da classe FirewallController, que estende a classe Controller
class FirewallController extends Controller
{
    // Método público que lida com a exibição das regras de firewall
    public function index()
    {
        // Criação de uma instância do UserManager
        $userManager = new UserManager();
        $table = 'Rules';
        $columns = ['id', 'rule_type', 'source_ip', 'source_port', 'dest_ip', 'dest_port', 'protocol', 'action'];

        // Lê todos os dados da tabela 'Rules' e colunas específicas
        $rules = $userManager->readAllData($table, implode(', ', $columns));

        // Chama o método view da classe pai (Controller) para exibir a visualização 'firewall'
        $this->view('firewall', ['rules' => $rules]);
    }

    // Método público para adicionar uma nova regra de firewall
    public function addRuler()
    {
        // Verifica se a requisição é do tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitiza e valida os dados da regra recebidos via POST
            $ruleData = [
                'rule_type' => $_POST['rule_type'],
                'source_ip' => IpSanitizerValidator::sanitizeAndValidateIp($_POST['source_ip']),
                'source_port' => $_POST['source_port'],
                'dest_ip' => IpSanitizerValidator::sanitizeAndValidateIp($_POST['dest_ip']),
                'dest_port' => $_POST['dest_port'],
                'protocol' => $_POST['protocol'],
                'action' => $_POST['action']
            ];

            // Filtra elementos vazios do array $ruleData
            $ruleData = array_filter($ruleData, function($value) {
                return $value !== '';
            });

            // Verifica se há dados para adicionar
            if (!empty($ruleData)) {
                $userManager = new UserManager();
                $table = 'Rules';

                // Cria a nova regra na tabela 'Rules'
                $success = $userManager->createData($table, $ruleData);

                // Registra um log de sucesso ou erro e redireciona para a página principal
                if ($success) {
                    (new Logger('successCreate'))->log("Regra adicionada com sucesso.");
                    header('Location: /');
                    exit;
                } else {
                    (new Logger('errorCreate'))->log("Erro ao adicionar regra no firewall.");
                    echo "Erro ao adicionar regra no firewall.";
                }
            } else {
                echo "Nenhum campo preenchido. A regra não foi adicionada.";
            }
        }
    }

    // Método público para remover uma regra de firewall
    public function removeRuler()
    {
        // Verifica se a requisição é do tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();

            // Verifica se o parâmetro 'id' foi recebido via POST
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $table = 'Rules';
                $where = ['id' => $id];

                // Remove os dados com base no 'id' fornecido
                $userManager->deleteData($table, $where);
                (new Logger('dataRemoved'))->log("Dados removidos com sucesso.");
                header('Location: /');
            } else {
                echo "Erro: 'id' não encontrado nos dados do POST.";
            }
        } else {
            echo "Erro: Esta função requer uma requisição POST.";
        }
    }
}
?>