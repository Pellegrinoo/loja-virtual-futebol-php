<?php 

include 'headers/header_admin.php'; 

require_once 'ConexaoBD.php';

$conn = ConexaoBD::getConexao();

$categoria = $_GET['categoria'];

$sql = $conn->prepare(
    "SELECT * FROM produtos WHERE categoria_id = ?"
);

$sql->bind_param("i", $categoria);
$sql->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div>
        <h2 class="text-center mb-4">Gestão dos produtos</h2>

        <form action="" method="GET" class="mb-4 text-center">
            <label for="categoria">Filtrar por categoria:</label>
            <select name="categoria" id="categoria" class="form-select d-inline w-auto mx-2">
                <option value="">-- Selecione --</option>
                <?php
                $categorias = $conn->query("SELECT * FROM categorias");
                while ($cat = $categorias->fetch_assoc()):
                ?>
                    <option value="<?= $cat['id'] ?>" <?= (isset($_GET['categoria']) && $_GET['categoria'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= $cat['nome'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="btn btn-danger">Filtrar</button>
        </form>

    </div>
</body>
</html>

