<?php

include 'headers/header.php';

if(!isset($_SESSION)) {
    session_start();
}

require_once 'ConexaoBD.php';
$conn = ConexaoBD::getConexao();

$sqlCat = $conn->query("SELECT * FROM categorias");

$sqlItem = $conn->query("SELECT * FROM produtos limit 3");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div class="titulo">
        <h3>Principais produtos</h3>
    </div>
    <div class="container-geral">
        <?php while ($cat = $sqlCat->fetch_assoc()): ?>
            <div class="container-categoria">
                <div class="galeria-cabecalho">
                    <span><?php echo $cat['nome']; ?></span>
                    <a href="">Ver mais...</a>
                </div>
                <div class="galeria-itens">
                    <ul>
                        <?php 
                        $sqlItem = $conn->query("SELECT * FROM produtos WHERE categoria_id = " . $cat['id'] . " LIMIT 3");

                        while ($item = $sqlItem->fetch_assoc()): ?>
                            <p> <?php echo $item['nome']; ?> </p>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>