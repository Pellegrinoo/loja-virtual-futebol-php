<?php
include '../headers/header_admin.php'; 
require_once '../ConexaoBD.php';

$conn = ConexaoBD::getConexao();
$id = $_GET["id"];

$sql = $conn->prepare("SELECT nome, preco, imagem FROM produtos WHERE id = ?");
$sql->bind_param("i", $id);
$sql->execute();

$resultado = $sql->get_result();

if ($row = $resultado->fetch_assoc()) {
    $nomeAtual = $row['nome'];
    $precoAtual = $row['preco'];
    $imagemAtual = $row['imagem'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Editar Produto</h3>
        <form action="salvarProduto.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 500px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($nomeAtual) ?>" required>
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" name="preco" id="preco" class="form-control" value="<?= $precoAtual ?>" step="0.01" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Imagem Atual</label><br>
                <img src="../<?= $imagemAtual ?>" alt="<?= htmlspecialchars($nomeAtual) ?>" width="100">
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Nova Imagem (opcional)</label>
                <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
            </div>

            <div class="text-center">
                <a href="javascript:history.back()" class="btn btn-secondary me-2">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</body>
</html>
