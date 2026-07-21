<?php

require_once '../db_connect/Conexao.php';
$conexao = new Conexao();
$pdo = $conexao->conectar();


    if ($_SERVER['REQUEST_METHOD'] === 'POST'){ 
            $usuario = $_POST['user'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
        
            $insert = $pdo->prepare("
                INSERT INTO cadastro (email, usuario, senha)
                VALUES (?, ?, ?)
            ");

            if($insert->execute([$email, $usuario, $senha])) {
                $mensagem = "Cliente cadastrado com sucesso!";
                $tipo = "success";
            } else {
                $mensagem = "erro ao cadastrar cliente.";
                $tipo = "error";
            }
    }
        
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
        <form action="" method="post">
        <input type="text" name="user" id="user" placeholder="Digite seu nick">

        <input type="email" name="email" id="email" placeholder="Digite seu email">

        <input type="password" name="senha" id="senha" placeholder="Digite sua senha">
        <button type="submit">Confirmar</button>
        </form>
        
       
</body>
</html>