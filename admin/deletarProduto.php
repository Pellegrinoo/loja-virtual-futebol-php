<?php

require_once '../ConexaoBD.php';

$conn = ConexaoBD::getConexao();

$id_produto = $_GET['id'];
$id_categoria = $_GET['categoria'];

$sql = $conn->prepare(
    "DELETE FROM produtos WHERE id = ?"
);

$sql->bind_param("i", $id_produto);
$sql->execute();

header("Location: admin.php?categoria=" . $id_categoria);

?>