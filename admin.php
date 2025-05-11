<?php 

include 'headers/header_admin.php'; 

require_once 'ConexaoBD.php';

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
</head>
<body>
    <div>
        <h2 class="text-center mb-4">Gestão dos produtos</h2>

        <form action="" method="GET" class="mb-4 text-center">
            <label for="categoria">Filtrar por categoria:</label>
            <select name="categoria" id="categoria" class="form-select d-inline w-auto mx-2">
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
                        <td><?= $linha['preco'] ?></td>
                        <td><img src="<?= $linha["imagem"] ?>" alt="<?= $linha["nome"] ?>" width="40"></td>
                        <td>
                            <a href='#' class='btn btn-warning btn-sm'>
                                <i class='fas fa-edit'></i> Editar
                            </a>
                            <a href='#' class='btn btn-danger btn-sm'>
                                <i class='fas fa-trash-alt'></i> Excluir
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
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

