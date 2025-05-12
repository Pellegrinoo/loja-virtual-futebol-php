<?php 

include '../headers/header_admin.php'; 

require_once '../ConexaoBD.php';

$conn = ConexaoBD::getConexao();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['categoria']) && $_GET['categoria'] !== '') {
    $categoria = $_GET['categoria'];

    $sql = $conn->prepare(
        "SELECT * FROM produtos WHERE categoria_id = ?"
    );

    $sql->bind_param("i", $categoria);
    $sql->execute();

    $resultado = $sql->get_result();
}



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
        .add-row:hover {
            background-color: #f8f9fa;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div>
    <h2 class="text-center mb-4">Gestão dos produtos</h2>

    <form action="" method="GET" class="mb-4 d-flex justify-content-center align-items-center gap-3 flex-wrap">
        <div class="d-flex align-items-center gap-2">
            <label for="categoria" class="mb-0">Filtrar por categoria:</label>
            <select name="categoria" id="categoria" class="form-select w-auto">
                <option value="">-- Selecione --</option>
                <?php
                $categorias = $conn->query("SELECT * FROM categorias");
                while ($cat = $categorias->fetch_assoc()):
                ?>
                    <option value="<?= $cat['id'] ?>" <?= (isset($_GET['categoria']) && $_GET['categoria'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= $cat['nome'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="btn btn-danger">Filtrar</button>
        </div>
        <a href="editarCategorias.php" class="btn btn-warning">
            <i class="bi bi-plus-circle"></i> Editar Categorias
        </a>
    </form>
</div>
    <div>
        <table class='table table-bordered table-striped'>
            <thead class='thead-dark'>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Foto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($resultado)): ?>
                <?php while ($linha = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $linha['nome'] ?></td>
                        <td>R$<?= $linha['preco'] ?></td>
                        <td><img src="../<?= $linha["imagem"] ?>" alt="<?= $linha["nome"] ?>" width="40"></td>
                        <td>
                            <a href='#' class='btn btn-warning btn-sm'>
                                <i class='fas fa-edit'></i> Editar
                            </a>
                            <a href='deletarProduto.php?id=<?= $linha['id'] ?>&categoria=<?= $_GET['categoria'] ?>' class='btn btn-danger btn-sm' onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                <i class='fas fa-trash-alt'></i> Excluir
                            </a>

                        </td>
                    </tr>
                <?php endwhile; ?>
                <tr class="add-row" onclick="window.location.href='cadastrarProduto.php?categoria=<?= $_GET['categoria'] ?? '' ?>'">
                    <td colspan="4" class="text-muted text-center">
                        <i class="bi bi-plus-circle"></i> Adicionar novo produto
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Nenhuma categoria selecionada.</td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
</body>
</html>

