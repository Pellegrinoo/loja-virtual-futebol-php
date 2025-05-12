<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<style>
    body { margin: 0; font-family: Arial, sans-serif; } 
    .top-bar, .bottom-bar { background: #c00; color: white; padding: 5px 20px; font-size: 14px; } 
    .middle-bar { background: #e60000; display: flex; align-items: center; justify-content: space-between; padding: 10px 20px; } 
    .middle-bar input { width: 50%; padding: 8px; border-radius: 5px; border: none; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); } 
    .middle-bar .actions { display: flex; gap: 20px; color: white; align-items: center; } 
    .middle-bar .actions a { color: white; text-decoration: none; font-weight: bold; padding: 8px 15px; border-radius: 5px; transition: background-color 0.3s ease; } 
    .middle-bar .actions a:hover { background-color: #d50000; } 
    .middle-bar a { text-decoration: none; } 
    .logo { color: white; font-size: 24px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; } 

</style>
<div class="top-bar">Trabalho PHP Escobar</div>
<div class="middle-bar">
    <a href="../index.php"><div class="logo">⚽ LojaFut</div></a>
    <div class="actions">
        <?php if (isset($_SESSION['nome'])): ?>
            <div>Olá, <?php echo $_SESSION['nome']; ?> | <a href="../logout.php">Sair</a></div>
        <?php else: ?>
            <a href="login.php"><div>Entrar / Cadastrar</div></a>
        <?php endif; ?>
    </div>
</div>

