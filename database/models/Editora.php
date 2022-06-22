<?php

namespace ConexaoPHPPostgres;

class EditoraModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Cod_editora", "Nome", "Endereco", "Telefone" FROM "Editora"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_editora' => $row['Cod_editora'],
                'Nome' => $row['Nome'],
                'Endereco' => $row['Endereco'],
                'Telefone' => $row['Telefone']
            ];
        }
        return $stocks;
    }

    public function ddelete($Cod_editora)
    {
        $sql = "DELETE from \"Editora\" WHERE \"Cod_editora\"=$Cod_editora";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
       
    }

    public function insert($Nome, $Endereco, $Telefone)
    {
        $sql = "INSERT INTO \"Editora\" (\"Nome\",\"Endereco\",\"Telefone\") VALUES ('$Nome', '$Endereco', '$Telefone')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function update($Cod_editora, $Nome, $Endereco, $Telefone){
        $sql = "UPDATE \"Editora\" SET \"Nome\"='$Nome', \"Endereco\"='$Endereco', \"Telefone\"='$Telefone' WHERE \"Cod_editora\"=$Cod_editora";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

}
