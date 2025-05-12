<?php

include '../headers/header_admin.php'; 

require_once '../ConexaoBD.php';

$conn = ConexaoBD::getConexao();

if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

    $nomeCategoria = $_POST['nome'];

    $sql = $conn->prepare("INSERT INTO categorias(nome) VALUES (?)");

    $sql->bind_param("s", $nomeCategoria);
    $sql->execute();

    header("Location: editarCategorias.php");
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
        <h3 class="text-center mb-4">Cadastrar Nova Categoria</h3>
        <form method="POST" class="mx-auto" style="max-width: 400px;">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Categoria</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="text-center">
                <a href="editarCategorias.php" class="btn btn-secondary me-2">Voltar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>