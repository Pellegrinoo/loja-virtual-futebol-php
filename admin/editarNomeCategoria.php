<?php

include '../headers/header_admin.php'; 

require_once '../ConexaoBD.php';

$conn = ConexaoBD::getConexao();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeCategoria = $_POST['nome'];
    $id_categoria = $_POST['id'];

    $sql = $conn->prepare("UPDATE categorias SET nome = ? WHERE id = ?");
    $sql->bind_param("si", $nomeCategoria, $id_categoria);
    $sql->execute();

    header("Location: editarCategorias.php");
    exit;
}

$id_categoria = $_GET['id'];

if ($id_categoria) {
    $stmt = $conn->prepare("SELECT nome FROM categorias WHERE id = ?");
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($row = $resultado->fetch_assoc()) {
        $nomeAtual = $row['nome'];
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Editar Categoria</h3>
        <form method="POST" class="mx-auto" style="max-width: 400px;">
            <input type="hidden" name="id" value="<?= $id_categoria ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Categoria</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $nomeAtual ?>" required>
            </div>
            <div class="text-center">
                <a href="editarCategorias.php" class="btn btn-secondary me-2">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</body>
</html>