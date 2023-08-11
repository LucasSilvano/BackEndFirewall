<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firewall Rules (beta)</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="bg-secondary p-3 rounded text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            Adicionar Regra
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#filterModal">Filter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">
                <h3 class="text-center">Regras do Firewall</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID da Regra</th>
                            <th>Tipo de Regra</th>
                            <th>IP de Origem</th>
                            <th>Porta de Origem</th>
                            <th>IP de Destino</th>
                            <th>Porta de Destino</th>
                            <th>Protocolo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rules as $rule) : ?>
                            <tr>
                                <td><?= $rule['id'] ?></td>
                                <td><?= $rule['rule_type'] ?></td>
                                <td><?= $rule['source_ip'] ?></td>
                                <td><?= $rule['source_port'] ?></td>
                                <td><?= $rule['dest_ip'] ?></td>
                                <td><?= $rule['dest_port'] ?></td>
                                <td><?= $rule['protocol'] ?></td>
                                <td><?= $rule['action'] ?></td>
                                <td>
                                    <form method="post" action="/firewall/removeruler/<?= $rule['id'] ?>">
                                        <input type="hidden" name="id" value="<?= $rule['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta regra?')">Excluir</button>
                                    </form>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modals for Add Rule -->
        <!-- Conteúdo do modal Filter -->
        <?php require __DIR__ . '/partials/Filter/FormFilterIpTable.php' ?>


        <!-- Include Bootstrap JS (Optional, if you need dropdowns, modals, etc.) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>