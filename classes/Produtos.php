<?php

class Produtos{
    private PDO $pdo;
    
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

public function listar(){

        $listar = $this->pdo->prepare("SELECT nome_produtos, 
                                preco_produtos 
                                FROM produtos");
        
        $listar->execute();
        
        return $listar->fetchALL(PDO::FETCH_ASSOC);

    }


public function buscar(string $texto){

        $buscar = $this->pdo->prepare(
            "SELECT 
	            c.nome_categorias,
	            p.nome_produtos,
                p.preco_produtos
            FROM produtos p
            INNER JOIN categorias c
            ON p.fk_categorias_id = c.id_categorias 
            WHERE c.nome_categorias LIKE ? 
            OR p.nome_produtos LIKE ? "
        );

        $buscar->execute([
            "%$texto%",
            "%$texto%"
            ]);
        return $buscar->fetchALL(PDO::FETCH_ASSOC);


    }

public function selecionar(){
    
    $selecionar = $this->$pdo->prepare(
        "SELECT
            p.produtos
            p.preco
        FROM produtos as p
        "
                                      );
    $selecionar->execute();
    return $buscar->fetchALL(PDO::FETCH_ASSOC);
}

}


?>