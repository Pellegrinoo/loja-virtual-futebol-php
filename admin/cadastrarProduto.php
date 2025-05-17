<?php
include '../headers/header_admin.php'; 
require_once '../ConexaoBD.php';

$conn = ConexaoBD::getConexao();
$id_categoria = $_GET["categoria"];

$sql = $conn->prepare("SELECT id, nome FROM categorias");
$sql->execute();

$categorias = $sql->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Cadastrar novo produto</h3>
        <form action="salvarNovoProduto.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 500px;">
            <div>
                <input type="hidden" name="categoria_id" value="<?= $id_categoria ?>"
            </div>
            
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" name="preco" id="preco" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*" required>
            </div>

            <div class="text-center">
                <a href="admin.php?categoria=<?= $id_categoria ?>" class="btn btn-secondary me-2">Voltar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>
