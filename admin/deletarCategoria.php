<?php

require_once '../ConexaoBD.php';

$conn = ConexaoBD::getConexao();

$id_categoria = $_GET['id'];

$sql = $conn->prepare(
    "DELETE FROM categorias WHERE id = ?"
);

$sql->bind_param("i", $id_categoria);
$sql->execute();

header("Location: editarCategorias.php");

?>