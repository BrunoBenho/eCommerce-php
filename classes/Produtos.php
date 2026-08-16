<?php

class Produtos{
    private PDO $pdo;
    
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

public function listar(){

        $listar = $this->pdo->prepare("SELECT 
                                id_produtos,
                                nome_produtos, 
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

public function buscaPorId(int $id)
{
    $sql = "SELECT
                p.id_produtos,
                p.nome_produtos,
                p.preco_produtos,
                c.nome_categorias
            FROM produtos p
            INNER JOIN categorias c
                ON p.fk_categorias_id = c.id_categorias
            WHERE p.id_produtos = ?";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}



}
?>