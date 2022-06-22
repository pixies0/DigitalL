<?php

namespace ConexaoPHPPostgres;

class LivroModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function innerJoinLA()
    {
        $stmt = $this->pdo->query('SELECT "Cod_livro", "Titulo", "Nome_autor", "Nome_editora" FROM "Livro_autor" INNER JOIN "Livro" ON "Cod_livro"="Cod_livro_autor";');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Nome_autor' => $row['Nome_autor'],
                'Nome_editora' => $row['Nome_editora'],
            ];
        }
        return $stocks;
    }

    public function innerJoinBig()
    {
        $stmt = $this->pdo->query('SELECT "Cod_livro", "Titulo", "Nome_autor", "Nome_unidade", "Qt_copia" FROM "Livro_copias" INNER JOIN "Livro_autor" ON "Cod_livro_autor"="Cod_livro_copias" INNER JOIN "Livro" ON "Cod_livro"="Cod_livro_copias" INNER JOIN "Unidade_Biblioteca" ON "Cod_unidade"="Cod_unidade_copias";');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Nome_autor' => $row['Nome_autor'],
                'Nome_unidade' => $row['Nome_unidade'],
                'Qt_copia' => $row['Qt_copia'],
            ];
        }
        return $stocks;
    }

    public function Copias($Cod_unidade, $Cod_livro)
    {
        $stmt = $this->pdo->query('SELECT DISTINCT "Qt_copia" FROM "Unidade_Biblioteca" INNER JOIN "Livro_copias" ON "Cod_unidade_copias"= $Cod_unidade INNER JOIN "Livro" ON "Cod_livro_copias"=$Cod_livro');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Qt_copia' => $row['Qt_copia'],
            ];
        }
        return $stocks;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Cod_livro", "Titulo", "Nome_editora" FROM "Livro"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Nome_editora' => $row['Nome_editora'],
            ];
        }
        return $stocks;
    }

    public function teste()
    {
        $stmt = $this->pdo->query('SELECT DISTINCT "Titulo","Cod_livro" FROM "Livro"
        INNER JOIN "Livro_copias" ON "Cod_livro_copias" = "Cod_livro"
        INNER JOIN "Unidade_Biblioteca" ON "Cod_unidade_copias" = "Cod_unidade"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
            ];
        }
        return $stocks;
    }

    public function insert($Titulo, $Nome_editora)
    {
        $sql = "INSERT INTO \"Livro\" (\"Titulo\",\"Nome_editora\") VALUES ('$Titulo', '$Nome_editora')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function update($Cod_livro, $Titulo, $Nome_editora)
    {
        $sql = "UPDATE \"Livro\" SET \"Titulo\"='$Titulo', \"Nome_editora\"='$Nome_editora' WHERE \"Cod_livro\"=$Cod_livro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function ddelete($Cod_livro)
    {
        $sql = "DELETE from \"Livro\" WHERE \"Cod_livro\"=$Cod_livro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $sql = "DELETE from \"Livro_copias\" WHERE \"Cod_livro_copias\"=$Cod_livro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insertInLivroCopias($Cod_livro_copias, $Cod_unidade_copias, $Quantidade)
    {
        $sql = "INSERT INTO \"Livro_copias\" (\"Cod_livro_copias\",\"Cod_unidade_copias\",\"Qt_copia\") VALUES ($Cod_livro_copias, $Cod_unidade_copias, $Quantidade)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function ddeleteFromCopias($Cod_livro)
    {
        $sql = "DELETE from \"Livro_copias\" WHERE \"Cod_livro_copias\"=$Cod_livro";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
    }

    public function updateCopias($Cod_livro, $Quantidade)
    {
        $sql = "UPDATE \"Livro_copias\" SET \"Qt_copia\"='$Quantidade' WHERE \"Cod_livro_copias\"=$Cod_livro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}
