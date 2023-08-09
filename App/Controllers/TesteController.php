<?php
declare(strict_types=1);

namespace App\Controllers;
require __DIR__ . ('../../../vendor/autoload.php');

namespace App\Controllers;

class TesteController
{
    public function testNoParams()
    {
        echo "Hello!";
    }
    public function testWithParams()
    {
        echo "Hello With Params!";
    }
}

?>