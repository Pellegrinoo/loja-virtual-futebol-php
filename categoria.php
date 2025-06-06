<?php
session_start();

if (isset($_GET['add_carrinho'])) {
    $idProduto = $_GET['add_carrinho'];
    $quantidade = 1;

    if(!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if(isset($_SESSION['carrinho'][$idProduto])) {
        $_SESSION['carrinho'][$idProduto] += $quantidade;
    } else {
        $_SESSION['carrinho'][$idProduto] = $quantidade;
    }

    header("Location: categoria.php?id=" . $_GET["id"]);
    exit;
}


require_once 'ConexaoBD.php';
$conn = ConexaoBD::getConexao();

$id = (int) $_GET["id"];

$categoriaQuery = $conn->query("SELECT nome FROM categorias WHERE id = $id");
$categoria = $categoriaQuery->fetch_assoc();

$produtosQuery = $conn->query("SELECT * FROM produtos WHERE categoria_id = $id");

$categorias = $conn->query("SELECT * FROM categorias");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>LojaFut - Categoria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/categoria.css">
</head>
<body>
<?php include 'headers/header.php'; ?>
<div class="container">
    <h1>Produtos da Categoria: <?= $categoria["nome"] ?></h1>
    
    <div class="produtos-list">
        <?php while ($produto = $produtosQuery->fetch_assoc()): ?>
        <div class="produto">
            <div class="produto-img">
                <img src="<?= $produto["imagem"] ?>" alt="<?= $produto["nome"] ?>">
            </div>
            <div class="produto-info">
                <p class="nome"><?= $produto["nome"] ?></p>
                <p class="preco">R$ <?= number_format($produto["preco"], 2, ',', '.') ?></p>
            </div>
            <form method="get" action="categoria.php">
                <input type="hidden" name="add_carrinho" value="<?= $produto['id'] ?>">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <button type="submit" style="all: unset; cursor: pointer;">
                    <i class="fas fa-shopping-cart"></i>
                </button>
            </form>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
