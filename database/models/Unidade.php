<?php

namespace ConexaoPHPPostgres;

class novaUnidadesModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Cod_unidade", "Nome_unidade","Cidade", "Estado" FROM "Unidade_Biblioteca"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_unidade' => $row['Cod_unidade'],
                'Nome_unidade' => $row['Nome_unidade'],
                'Cidade' => $row['Cidade'],
                'Estado' => $row['Estado'],
            ];
        }
        return $stocks;
    }

    public function insert($Nome_unidade, $Cidade, $Estado)
    {
        $sql = 'INSERT INTO "Unidade_Biblioteca" ("Nome_unidade", "Cidade", "Estado") VALUES (:Nome_unidade, :Cidade, :Estado)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':Nome_unidade', $Nome_unidade);
        $stmt->bindValue(':Cidade', $Cidade);
        $stmt->bindValue(':Estado', $Estado);
        $stmt->execute();
    }


    
    public function update($Cod, $Nome_unidade, $Cidade, $Estado)
    {
        $sql = "UPDATE \"Unidade_Biblioteca\" SET \"Nome_unidade\"='$Nome_unidade', \"Cidade\"='$Cidade', \"Estado\"='$Estado' WHERE \"Cod_unidade\"=$Cod";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function ddelete($Cod_unidade)
	{
        $sql = "DELETE FROM \"Unidade_Biblioteca\" WHERE \"Cod_unidade\" = $Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $sql = "DELETE from \"Livro_copias\" WHERE \"Cod_unidade_copias\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

}
