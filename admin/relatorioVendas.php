<?php
include '../headers/header_admin.php'; 

require_once '../ConexaoBD.php';
$conn = ConexaoBD::getConexao();

$sql = $conn->query("SELECT
    u.nome AS nome,
    v.vlr_total AS vlr_total,
    v.id AS id,
    DATE_FORMAT(v.data_venda, '%d/%m/%Y às %H:%i') AS data_compra
    FROM vendas v
    INNER JOIN usuarios u
    ON v.id_usuario = u.id"
);

$resultado = $sql;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .div-geral{margin-top:20px;}
        .voltarButton{
            justify_content: flex;
            display: flex;
            padding:5px;
        }
    </style>
</head>
<body>
<div class="div-geral">
    <div class="voltarButton">
        <a href="admin.php" class="btn btn-danger me-2">Voltar</a>
    </div>
    <h2 class="text-center mb-4">Relatório de Vendas</h2>
    

    <div>
        <table class='table table-bordered table-striped'>
            <thead class='thead-dark'>
                <tr>
                    <th>ID(venda)</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($resultado)): ?>
                <?php while ($linha = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $linha['id'] ?></td>
                        <td><?= $linha['nome'] ?></td>
                        <td><?= $linha['data_compra'] ?> </td>
                        <td>R$<?= number_format($linha['vlr_total'], 2) ?> </td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>