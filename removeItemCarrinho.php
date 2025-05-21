<?php

session_start();

$idProduto = $_GET['idProduto'];

unset($_SESSION['carrinho'][$idProduto]);

header("Location: carrinho.php");

?>