<?php
include 'headers/header.php';

if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja - Página Inicial</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>

    <div class="container">
        <h2>Projeto CRUD - Loja Virtual</h2>

        <p>
            Este sistema foi desenvolvido como trabalho da disciplina de Linguagem de Programação Web. O objetivo principal foi construir uma loja virtual com uma área pública para exibir produtos e uma área administrativa protegida por login.
        </p>

        <p>
            O projeto inclui:
        </p>

        <ul>
            <li>CRUD completo de categorias e produtos</li>
            <li>Controle de vendas (simulação de compra)</li>
            <li>Login com sessão para acessar o painel administrativo</li>
            <li>Carrinho de compras usando sessão PHP</li>
        </ul>

        <p>
            As tecnologias utilizadas foram:
        </p>

        <ul>
            <li>PHP (puro)</li>
            <li>MySQL</li>
            <li>HTML + CSS</li>
        </ul>

        <div class="assinatura">
            Desenvolvido por Lucas Rios e Lucas André<br>
            Curso de Sistema de Informação – ITE Bauru
        </div>
    </div>

</body>
</html>
