<?php 

session_start();
    
require_once 'config/Conexao.php';
require_once 'classes/Produtos.php';
$conexao = new Conexao();
$pdo = $conexao->conectar();

$produto = new Produtos($pdo);

    // pesquisando somente a categoria, melhorar o sql
        if(!empty($_GET['q'])){
            
            $query = http_build_query([
                'q' => $_GET['q']
            ]);
            header("Location: admin/produtos/index.php?$query");
            exit;

        } else{
            
            $produtos = $produto->listar();

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
            <input type="text" name="q" placeholder="O que você procura?">
            <button type="submit">Buscar</button>
        </form>
    
    <?php if (isset($_SESSION['usuario'])): ?>

        <p>Olá, <?= htmlspecialchars($_SESSION['usuario']) ?> </p>
        <a href="login/logout.php">Sair</a>
        <br>
        <a href="admin/produtos/Carrinho.php">Meu carrinho</a>
    <?php else: ?>
    
        <a href="login/login.php">
        <button type="button">Login</button>
        </a>
    <?php endif; ?>
    
    

    <?php foreach ($produtos as $item): ?>
        <div class="produto">
            <h3> <?= htmlspecialchars($item['nome_produtos']); ?> </h3>
            
            <?php if(isset($item['nome_categorias'])): ?>
                <p>Categoria: <?= htmlspecialchars($item['nome_categorias'])?> </p>

            <?php endif; ?>

            <p>R$ <?= number_format($item['preco_produtos'], 2,',','.') ?>

            <form action="admin/produtos/Produto.php" method="GET">
                <input 
                type="hidden" 
                name="id" 
                value="<?= $item['id_produtos'] ?>"
            >
                <button type="submit">Comprar</button>
            </form>
                
        </p> 
        </div>
        <?php endforeach; ?>
</body>
</html>