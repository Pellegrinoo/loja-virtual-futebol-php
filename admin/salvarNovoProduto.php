<?php

include '../headers/header_admin.php'; 
require_once '../ConexaoBD.php';

$conn = ConexaoBD::getConexao();

$nome = $_POST['nome'];
$preco = $_POST['preco'];
$categoria_id = $_POST['categoria_id'];
$imagem = $_FILES['imagem'];

//tratando imagem para funcionar na lógica
$nomeArquivo = basename($_FILES['imagem']['name']);
$caminhoImagem = "image/" . $nomeArquivo;
move_uploaded_file($_FILES['imagem']['tmp_name'], "../" . $caminhoImagem);

$sql = $conn->prepare("INSERT INTO produtos (nome, preco, categoria_id, imagem) VALUES (?, ?, ?, ?)");
$sql->bind_param("sdis", $nome, $preco, $categoria_id, $caminhoImagem);
$sql->execute();

header("Location: admin.php?categoria=" . $categoria_id);

?>