<?php

    require_once 'ConexaoBD.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = ConexaoBD::getConexao();

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = $conn->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ? and senha = ?");
        $sql->bind_param("ss", $email, $senha);
        $sql->execute();

        $result = $sql->get_result();

        if($result->num_rows == 1) {

            $usuario = $result->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: index.php");
            exit;

        } else {
            echo "Falha ao logar! Email ou senha incorreto(s)";
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

        <label>E-mail</label>
        <input type="email" name="email" required>
        
        <label>Senha</label>
        <input type="password" name="senha" required>

        <div class="text-center">
            <button type="submit" class="btn btn-danger">Entrar</button>
        </div>
    </form>
    <div class="register-link">
        Não tem conta? <a href="cadastro.php">Cadastre-se</a>
    </div>
</div>

</body>
</html>
