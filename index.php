<?php 

session_start();
    
require_once 'db_connect/Conexao.php';
$conexao = new Conexao();
$pdo = $conexao->conectar();

    if($_SERVER['REQUEST_METHOD'] ==='GET') {

        $categoria = $_GET['id_categoria'] ?? '';
        $busca = $pdo->prepare("SELECT *
                                 FROM categorias 
                                 WHERE nome_categorias LIKE ? ");

        $busca->execute([$categoria]);
        $resultado = $busca->fetch(PDO::FETCH_ASSOC);

        var_dump($resultado);
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel='stylesheets' href='../assets/css/style_index.css'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommercce Bauru</title>
</head>
<body>
    <div class = "titulo">
        <h2>
            eCommerce Bauru
        </h2>
        </div>

        <form action="" method="GET">
            <input type="text" name="id_categoria" placeholder="O que você procura?">
            <button type="submit">Buscar</button>
        </form>

    <?php if (isset($_SESSION['usuario'])): ?>

        <p>Olá, <?= htmlspecialchars($_SESSION['usuario']) ?> </p>
        <a href="login_cadastro/logout.php">Sair</a>
        <br>
        <a href="admin/produtos/index.php">Meus carrinho</a>
    <?php else: ?>
    
        <a href="login_cadastro/login.php">
        <button type="button">Login</button>
        </a>
    <?php endif; ?>
        

</body>
</html>