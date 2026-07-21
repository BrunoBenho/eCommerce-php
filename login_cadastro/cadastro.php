<?php

require_once '../db_connect/Conexao.php';
$conexao = new Conexao();
$pdo = $conexao->conectar();


    if ($_SERVER['REQUEST_METHOD'] === 'POST'){ 
            $usuario = $_POST['user'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
        
        $verifica_email = $pdo->prepare("SELECT id_cadastro FROM cadastro WHERE email = ?");
        $verifica_email->execute([$email]);
        
        if ($verifica_email->rowCount() > 0) {
            $mensagem = "E-mail já cadastrado.";
        } else {

            $insert = $pdo->prepare("
                INSERT INTO cadastro (email, usuario, senha)
                VALUES (?, ?, ?)
            ");

            if ($insert->execute([$email, $usuario, $senha])) {
                $mensagem = "Cliente cadastrado com sucesso!";
            } else {
                $mensagem = "Erro ao cadastrar cliente.";
            }
        }
    }

        
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../assets/css/style_cadastro.css"> 
</head>
<body>
<form action="" method="post">

    <h2>Cadastro</h2>

    <?php if (!empty($mensagem)): ?>
        <div class="mensagem <?= str_contains($mensagem, 'sucesso') ? 'sucesso' : 'erro' ?>">
            <?= htmlspecialchars($mensagem) ?>
        </div>
    <?php endif; ?>

    <input type="text"
           name="user"
           id="user"
           placeholder="Digite seu usuário">

    <input type="email"
           name="email"
           id="email"
           placeholder="Digite seu e-mail">

    <input type="password"
           name="senha"
           id="senha"
           placeholder="Digite sua senha">

    <button type="submit">
        Cadastrar
    </button>
    
    <div class="cadastro">
        <p>
            
            <a href="../login_cadastro/login.php">Já possuo cadastro</a>
        </p>
    </div>

</form>
       
</body>
</html>