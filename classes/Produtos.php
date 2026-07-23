<?php

class Produtos{
    private PDO $pdo;
    
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

public function listar(){

        $listar = $pdo->prepare("SELECT nome_produtos, 
                                preco_produtos 
                                FROM produtos");
        
        $listar->execute();
        
        return $listar->fetchALL(PDO::FETCH_ASSOC);

    }
}
?>