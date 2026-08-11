<?php 

class Conexao{
    private $host = "127.0.0.1";
    private $dbname = "ecommerce";
    private $user = "root";
    private $senha = "";

    public function conectar(){
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->senha
                        );
                                 
        return $pdo;
        
        } catch (PDOException $e){
            die("Erro: " . $e->getMessage());
        } 
    }

}


?>