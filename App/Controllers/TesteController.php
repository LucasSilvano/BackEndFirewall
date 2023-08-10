<?php
declare(strict_types=1);

namespace App\Controllers;

require __DIR__ . ('../../../vendor/autoload.php');


class TesteController extends Controller
{
    public function testNoParams()
    {
        $this->view('firewall');
    }
    public function testWithParams($params)
    {
        $data = [
            'name' => $params[0],
            'age' => $params[1]
        ];

    
        $this->view('firewallsem', $data);
    }
}

?>