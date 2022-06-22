<?php

namespace ConexaoPHPPostgres;

class AutorModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Cod_livro_autor", "Nome_autor" FROM "Livro_autor"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_livro_autor' => $row['Cod_livro_autor'],
                'Nome_autor' => $row['Nome_autor'],
            ];
        }
        return $stocks;
    }

    public function insert($Nome_autor)
    {
        $sql = "INSERT INTO \"Livro_autor\" (\"Nome_autor\") VALUES (:Nome_autor)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':Nome_autor', $Nome_autor);
        $stmt->execute();
    }

    public function update($Cod_livro, $Nome_autor)
    {
        $sql = "UPDATE \"Livro_autor\" SET \"Nome_autor\"='$Nome_autor' WHERE \"Cod_livro_autor\"=$Cod_livro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function ddelete($Cod_livro)
    {
        $sql = "DELETE from \"Livro_autor\" WHERE \"Cod_livro_autor\"=$Cod_livro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}
