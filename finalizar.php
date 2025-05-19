<?php
session_start();
require_once 'ConexaoBD.php';
$conn = ConexaoBD::getConexao();

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    die('Carrinho vazio.');
}

if (!isset($_SESSION['id'])) {
    die('Usuário não logado.');
}

$id_usuario = $_SESSION['id'];
$carrinho = $_SESSION['carrinho'];
$total = 0;

$ids = implode(",", array_keys($carrinho));
$sql = $conn->query("SELECT id, preco FROM produtos WHERE id IN ($ids)");

while ($row = $sql->fetch_assoc()) {
    $id = $row['id'];
    $quantidade = $carrinho[$id];
    $subtotal = $row['preco'] * $quantidade;
    $total += $subtotal;
}

$data_venda = date('Y-m-d H:i:s');
$insert_venda = $conn->prepare(
    "INSERT INTO vendas (data_venda, id_usuario, vlr_total) VALUES (?, ?, ?)"
);
$insert_venda->bind_param("sid", $data_venda, $id_usuario, $total);
$insert_venda->execute();
$venda_id = $conn->insert_id;

$insert_venItens = $conn->prepare(
    "INSERT INTO vendas_itens (venda_id, produto_id, quantidade) VALUES (?, ?, ?)"
);

foreach($carrinho as $produto_id => $quantidade) {
    $insert_venItens->bind_param("iii", $venda_id, $produto_id, $quantidade);
    $insert_venItens->execute();
}

unset($_SESSION['carrinho']);

header("Location: sucesso.php");
exit;

?>