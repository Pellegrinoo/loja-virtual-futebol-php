<?php
require_once 'ConexaoBD.php';

$conn = ConexaoBD::getConexao();

$email = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $conn->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    if ($senha === $usuario['senha']) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];

        header("Location: index.php");
        exit;
    } else {
        $_SESSION['erro_login'] = "Senha incorreta.";
    }
} else {
    $_SESSION['erro_login'] = "E-mail não encontrado.";
}

header("Location: login.php");
exit;
