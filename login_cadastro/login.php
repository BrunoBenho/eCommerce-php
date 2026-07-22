<?php

require_once '../db_connect/Conexao.php';
$conexao = new Conexao();
$pdo = $conexao->conectar();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $usuario_login = trim($_POST['usuario_login'] ?? '');
        $senha_login = trim($_POST['senha_login'] ?? '');

        if (empty($usuario_login) || empty($senha_login)) {

            $mensagem = "Preencha todos os campos.";

        } else {

            $verifica_login = $pdo->prepare("
                SELECT *
                FROM cadastro
                WHERE email = ?
            ");

            $verifica_login->execute([$usuario_login]);

            $usuario = $verifica_login->fetch(PDO::FETCH_ASSOC);
/*
        teste de senha
            
        echo "<pre>";
        var_dump($usuario);

        echo "<br>";

        var_dump($senha_login);

        echo "<br>";
       

        if ($usuario) {
            var_dump(password_verify($senha_login, $usuario['senha']));
        }

        exit;
*/
            if ($usuario && password_verify($senha_login, $usuario['senha'])) {

                session_start();

                $_SESSION['usuario'] = $usuario['usuario'];
                $_SESSION['id'] = $usuario['id_cadastro'];

                header("Location: ../index.php");
                exit;

            } else {

                $mensagem = "Usuário ou senha incorretos.";

            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="http://localhost/eCommerce-php/assets/css/style_login.css">
</head>
<body>

<?php if (!empty($mensagem)): ?>
    <div class="mensagem <?= str_contains($mensagem, 'sucesso') ? 'sucesso' : 'erro' ?>">
        <?= htmlspecialchars($mensagem) ?>
    </div>
<?php endif; ?>

<form action="" method="POST">
        <h2>Login</h2>        

    <input
        type="text"
        name="usuario_login"
        id="usuario_login"
        placeholder="Digite seu e-mail"
    >

    <input
        type="password"
        name="senha_login"
        id="senha_login"
        placeholder="Digite sua senha"
    >

    <div class="Entrar">
        <button type="submit">
            Entrar
        </button>
    </div>

        <div class="cadastro">
        <p>
            <a href="../login_cadastro/cadastro.php">Realizar Cadastro</a>
        </p>
    </div>
</form>

</body>
</html>