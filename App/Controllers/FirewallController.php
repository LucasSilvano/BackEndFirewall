<?php
declare(strict_types=1);

namespace App\Controllers;

require __DIR__ . ('../../../vendor/autoload.php');


class FirewallController extends Controller
{
    public function index() {
        $userManager = new UserManager();
        $table = 'Rules';
        $columns = ['id', 'rule_type', 'source_ip', 'source_port', 'dest_ip', 'dest_port', 'protocol', 'connection_state', 'action'];
        
        $rules = $userManager->readAllData($table, implode(', ', $columns));
    
        $this->view('firewall', ['rules' => $rules]);
    }
    public function addRuler() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ruleData = [
                'rule_type' => $_POST['rule_type'],
                'source_ip' => $_POST['source_ip'],
                'source_port' => $_POST['source_port'],
                'dest_ip' => $_POST['dest_ip'],
                'dest_port' => $_POST['dest_port'],
                'protocol' => $_POST['protocol'],
                'connection_state' => $_POST['state'],
                'action' => $_POST['action']
            ];
    
            // Remove campos vazios do array $ruleData
            $ruleData = array_filter($ruleData, function($value) {
                return $value !== '';
            });
    
            // Verifica se há campos válidos para inserção
            if (!empty($ruleData)) {
                $userManager = new UserManager();
                $table = 'Rules';
                $success = $userManager->createData($table, $ruleData);
    
                if ($success) {
                    header('Location: /');
                    exit;
                } else {
                    echo "Erro ao adicionar regra no firewall.";
                }
            } else {
                echo "Nenhum campo preenchido. A regra não foi adicionada.";
            }
        }
    }
    public function removeRuler() {
        // Verifique se o método é POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();
            
            // Certifique-se de que a chave "id" existe no array $_POST
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $table = 'Rules';
                $where = ['id' => $id];
                
                $userManager->deleteData($table, $where);
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