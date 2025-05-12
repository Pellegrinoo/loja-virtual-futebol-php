<?php

include '../headers/header_admin.php'; 

require_once '../ConexaoBD.php';
$conn = ConexaoBD::getConexao();
$resultado = $conn->query("SELECT * FROM categorias ORDER BY nome ASC");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .add-row:hover {
            background-color: #f8f9fa;
            cursor: pointer;
            font-weight: bold;
        }
        .voltarButton{
            justify_content: flex;
            display: flex;
            padding:20px;
        }
        
    </style>
</head>
<body>
    <div class="voltarButton">
        <a href="admin.php" class="btn btn-danger me-2">Voltar</a>
    </div>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Categorias</h2>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultado->num_rows > 0): ?>
                        <?php while ($cat = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($cat['nome']) ?></td>
                                <td>
                                    <a href="editarNomeCategoria.php?id=<?= $cat['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <a href="deletarCategoria.php?id=<?= $cat['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                        <i class="bi bi-trash"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <!-- Linha de adicionar nova categoria -->
                    <tr class="add-row" onclick="window.location.href='cadastrarCategoria.php'">
                        <td colspan="2" class="text-muted">
                            <i class="bi bi-plus-circle"></i> Adicionar nova categoria
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>