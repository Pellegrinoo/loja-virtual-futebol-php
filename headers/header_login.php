<?php
require_once 'ConexaoBD.php';
$conn = ConexaoBD::getConexao();
$categorias = $conn->query("SELECT * FROM categorias");
?>
<style>
    body { margin: 0; font-family: Arial, sans-serif; }
    .top-bar, .bottom-bar { background: #c00; color: white; padding: 5px 20px; font-size: 14px; }
    .middle-bar { background: #e60000; display: flex; align-items: center; justify-content: space-between; padding: 10px 20px; }
    .middle-bar input { width: 50%; padding: 8px; border-radius: 5px; border: none; }
    .middle-bar .actions { display: flex; gap: 20px; color: white; }
    .middle-bar a {text-decoration: none}
    .logo { color: white; font-size: 24px; font-weight: bold; }
    .nav-bar { background: #fff; display: flex; padding: 10px 20px; gap: 15px; font-weight: bold; border-top: 2px solid #e60000; }
    .nav-bar a { text-decoration: none; color: #000; transition: 0.2s; }
    .nav-bar a:hover { color: #e60000; }
</style>
<div class="top-bar">Trabalho PHP Escobar</div>
<div class="middle-bar">
    <a href="index.php"><div class="logo">Sport Store</div></a>
    <a href="login.php"><div class="actions"><div>Entrar / Cadastrar</div></div></a>
</div>
