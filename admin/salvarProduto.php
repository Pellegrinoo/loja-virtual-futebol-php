<?php

require_once '../ConexaoBD.php';
$conn = ConexaoBD::getConexao();


$id = $_POST['id'];
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$imagem = $_FILES['imagem'];
$id_categoria = $_POST['id_categoria'];

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $nomeArquivo = basename($_FILES['imagem']['name']);

    $caminhoImagem = "image/" . $nomeArquivo;

    move_uploaded_file($_FILES['imagem']['tmp_name'], "../" . $caminhoImagem);

    $sql = $conn->prepare(
        "UPDATE produtos SET nome = ?, preco = ?, imagem = ? WHERE id = ?"
    );
    $sql->bind_param("sdsi", $nome, $preco, $caminhoImagem, $id);
} else {

    $sql = $conn->prepare(
        "UPDATE produtos SET nome = ?, preco = ? WHERE id = ?"
    );
    $sql->bind_param("sdi", $nome, $preco, $id);
}

$sql->execute();

header("Location: admin.php?categoria=" . $id_categoria);


?>