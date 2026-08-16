<?php

require_once '../../config/Conexao.php';
require_once '../../classes/Produtos.php';

$conexao = new Conexao();
$pdo = $conexao->conectar();

$produto = new Produtos($pdo);

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ../../index.php');
    exit;
}

$dadosProduto = $produto->buscaPorId($id);

if (!$dadosProduto) {
    echo "Produto não encontrado.";
    exit;
}
?>

<h1>
    <?= htmlspecialchars($dadosProduto['nome_produtos']) ?>
</h1>

<p>
    Categoria:
    <?= htmlspecialchars($dadosProduto['nome_categorias']) ?>
</p>

<p>
    Preço:
    R$ <?= number_format(
        $dadosProduto['preco_produtos'],
        2,
        ',',
        '.'
    ) ?>
</p>

<button type="button">
    Comprar
</button>