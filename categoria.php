<?php
require_once 'ConexaoBD.php';
$conn = ConexaoBD::getConexao();

$id = (int) $_GET["id"];

// Buscar nome da categoria
$categoriaQuery = $conn->query("SELECT nome FROM categorias WHERE id = $id");
$categoria = $categoriaQuery->fetch_assoc();

// Buscar produtos
$produtosQuery = $conn->query("SELECT * FROM produtos WHERE categoria_id = $id");

// Buscar todas as categorias (para o menu)
$categorias = $conn->query("SELECT * FROM categorias");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>LojaFut - Categoria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>

        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .produto {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .produto:last-child {
            border-bottom: none;
        }

        .preco {
            color: green;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
    <h1>Produtos da Categoria: <?= $categoria["nome"] ?></h1>

    <?php while ($produto = $produtosQuery->fetch_assoc()): ?>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
        <img src="<?= $produto["imagem"] ?>" alt="<?= $produto["nome"] ?>" style="width: 100px; height: auto; margin-bottom: 10px;">
            <p><strong><?= $produto["nome"] ?></strong></p>
            <p class="preco">R$ <?= number_format($produto["preco"], 2, ',', '.') ?></p>
        </div>
        <i class="fas fa-shopping-cart" style="font-size: 20px; color: #333; cursor: pointer;"></i>
    </div>

    <?php endwhile; ?>
</div>

</body>
</html>
