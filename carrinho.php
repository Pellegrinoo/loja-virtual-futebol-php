<?php
session_start();
require_once 'ConexaoBD.php';
$conn = ConexaoBD::getConexao();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$carrinho = $_SESSION['carrinho'];
$produtos = [];

$total = 0;

if (!empty($carrinho)) {
    $ids = implode(",", array_keys($carrinho));
    $sql = $conn->query("SELECT * FROM produtos WHERE id IN ($ids)");
    $resultado = $sql;

    while($linha = $resultado->fetch_assoc()) {
        $id =$linha['id'];
        $linha['quantidade'] = $carrinho[$id];
        $linha['subtotal'] = $linha['preco'] * $linha['quantidade'];
        $produtos[] = $linha;
        $total += $linha['subtotal'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho - LojaFut</title>
    <link rel="stylesheet" href="style/carrinho.css">
</head>
<body>
<?php include 'headers/header_carrinho.php'; ?>

    <div class="container">
        <h2>Meu Carrinho</h2>

        <?php if (empty($_SESSION['carrinho'])): ?>
            <p>O carrinho está vazio.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><img src="<?= $produto["imagem"] ?>" alt="<?= $produto["nome"] ?>" width=60px></td>
                            <td><?php echo $produto['nome']; ?></td>
                            <td>R$ <?php echo $produto['preco']; ?></td>
                            <td><?php echo $produto['quantidade']; ?></td>
                            <td>R$ <?php echo $produto['subtotal']; ?></td>
                            <td><a href="removeItemCarrinho.php?idProduto=<?= $produto['id'] ?>">Excluir</a></A></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="text-end total">Total:</td>
                        <td class="total">R$ <?php echo $total; ?></td>
                    </tr>   
                </tbody>
            </table>
            <form action="finalizar.php" method="post">
                <div class="finalizar-container">
                    <button type="submit" class="btn-finalizar">Finalizar Compra</button>
                </div>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>
