<?php 
    
require_once '../../config/Conexao.php';
require_once '../../classes/Produtos.php';

$conexao = new Conexao();
$pdo = $conexao->conectar();
$produto = new Produtos($pdo);


    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        
        if(!empty($_GET['q'])){
            $produtos = $produto->buscar($_GET['q']);

        } else {
            $produtos = $produto->listar();
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <?php foreach ($produtos as $item): ?>
        <div class="produto">
            <h3> <?= htmlspecialchars($item['nome_produtos']); ?> </h3>
            
            <?php if(isset($item['nome_categorias'])): ?>
                <p>Categoria: <?= htmlspecialchars($item['nome_categorias'])?> </p>

            <?php endif; ?>

            <p>R$ <?= number_format($item['preco_produtos'], 2,',','.') ?> 
            
        </p> 
        </div>
        <?php endforeach; ?>
</body>
</html>


