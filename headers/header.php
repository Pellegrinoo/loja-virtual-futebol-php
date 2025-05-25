<?php
require_once 'ConexaoBD.php';
$conn = ConexaoBD::getConexao();
$categorias = $conn->query("SELECT * FROM categorias");

if (!isset($_SESSION)) {
    session_start();
}
?>
<style>
    body { margin: 0; font-family: Arial, sans-serif; } 
    .top-bar, .bottom-bar { background: #c00; color: white; padding: 5px 20px; font-size: 14px; } 
    .middle-bar { background: #e60000; display: flex; align-items: center; justify-content: space-between; padding: 10px 20px; gap: 15px} 
    .middle-bar input { width: 45%; padding: 8px; border-radius: 5px; border: none; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); } 
    .middle-bar .actions { display: flex; gap: 15px; color: white; align-items: center; } 
    .middle-bar .actions a { color: white; text-decoration: none; font-weight: bold; padding: 6px 12px; border-radius: 5px; transition: background-color 0.3s ease; } 
    .middle-bar .actions a:hover { background-color: #d50000; } 
    .middle-bar a { text-decoration: none; }
    .logo { color: white; font-size: 24px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; } 
    .nav-bar { background: #fff; display: flex; padding: 10px 20px; gap: 20px; font-weight: bold; border-top: 2px solid #e60000; justify-content: center; } 
    .nav-bar a { text-decoration: none; color: #333; font-size: 16px; transition: color 0.3s ease; padding: 10px 15px; border-radius: 5px; } 
    .nav-bar a:hover { color: #e60000; background-color: #f2f2f2; }
    .carrinho:hover svg {background-color: #d50000;}


</style>
<div class="top-bar">Trabalho PHP Escobar</div>
<div class="middle-bar">
    <a href="index.php"><div class="logo">Sport Store</div></a>
    <input type="text" placeholder="O que você procura?">
    
    <a href="carrinho.php" class="carrinho" title="Carrinho" style="display:inline-block; width:36px; height:36px;">
        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="100%" height="100%">
            <circle cx="9" cy="21" r="1.5"/>
            <circle cx="20" cy="21" r="1.5"/>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
        </svg>
    </a>

    <div class="actions">
        <?php if (isset($_SESSION['nome'])): ?>
            <?php if ($_SESSION['nome'] == "Administrador"): ?>
                <div><a href="admin/admin.php">Área Administrativa</a></div>
            <?php endif; ?>
            <div>Olá, <?php echo $_SESSION['nome']; ?> | <a href="logout.php">Sair</a></div>
        <?php else: ?>
            <a href="login.php"><div>Entrar / Cadastrar</div></a>
        <?php endif; ?>
    </div>
</div>
<div class="nav-bar">
    <?php while ($cat = $categorias->fetch_assoc()): ?>
        <a href="categoria.php?id=<?php echo $cat['id']; ?>"><?php echo $cat['nome']; ?></a>
    <?php endwhile; ?>
</div>
