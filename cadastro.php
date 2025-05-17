<?php
require_once 'ConexaoBD.php';
$conn = ConexaoBD::getConexao();

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];

    $verificacao = $conn->prepare("SELECT * FROM USUARIOS WHERE email = ?");
    $verificacao->bind_param("s", $email);
    $verificacao->execute();

    $resultado = $verificacao->get_result();

    if($resultado->num_rows > 0) {
        $erro = "E-mail já cadastrado";
    } else {
        if ($senha !== $senha2) {
            $erro = "As senhas não coincidem.";
        } else {
            $sql = $conn->prepare("INSERT INTO USUARIOS (nome, email, senha) VALUES (?, ?, ?)");
            $sql->bind_param("sss", $nome, $email, $senha);
            $sql->execute();
    
            header("Location: login.php");
            exit;
        }
    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - LojaFut</title>
    <link rel="stylesheet" href="style/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'headers/header_login.php'; ?>

<div class="login-container">
    <h2>Entrar na LojaFut</h2>
    <form action="" method="post">
        <?php if(!empty($erro)): ?>
            <p style="color: red;"><?= $erro ?></p>
        <?php endif; ?>

        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>E-mail</label>
        <input type="email" name="email" required>

        <label>Senha</label>
        <input type="password" name="senha" required>

        <label>Confirmar senha</label>
        <input type="password" name="senha2" required>

        <div class="text-center">
            <a href="login.php" class="btn btn-secondary me-2">Voltar</a>
            <button type="submit" class="btn btn-danger">Cadastrar</button>
        </div>
    </form>
</div>

</body>
</html>
