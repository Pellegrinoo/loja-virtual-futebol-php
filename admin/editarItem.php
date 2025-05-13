<?php

include '../headers/header_admin.php'; 

require_once '../ConexaoBD.php';
$conn = ConexaoBD::getConexao();

$id = $_GET["id"];

$sql = $conn->prepare("SELECT nome, preco, imagem FROM produtos where id = ?");

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar item</title>
    
</head>
<body>
    <div>
        <form action="salvarProduto.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Nome</label>
            <input type="text" name="nome" value="<?= $nomeAtual ?>" required>
            <label>Preço</label>
            <input type="number" name="preco" value="<?= $precoAtual ?>" required>
            <label>Imagem produto</label>
            <img src="../<?= $imagemAtual ?>" alt="<?= $linha["nome"] ?>" width="40">
            <input type="file" name="imagem" accept="image/*" required>
            <button type="submit">Salvar</button>  
        </form>
    </div>
</body>
</html>