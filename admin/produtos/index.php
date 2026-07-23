<?php session_start(); ?>
    
    <?php if (isset($_SESSION['usuario'])): ?> 

        <p>Bem-vindo <?= htmlspecialchars($_SESSION['usuario'])?></p>

    <?php else: 

        header("Location: /ecommerce-php/index.php");
        exit;

    endif ?>

<?php 
    
require_once '../../db_connect/Conexao.php';
$conexao = new Conexao();
$pdo = $conexao->conectar();


?>




