<?php

namespace ConexaoPHPPostgres;

class CadastroUsuarioModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Num_cartao", "Nome", "Endereco", "Telefone" FROM "Usuario"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Num_cartao' => $row['Num_cartao'],
                'Nome' => $row['Nome'],
                'Endereco' => $row['Endereco'],
                'Telefone' => $row['Telefone']
            ];
        }
        return $stocks;
    }

    public function ddelete($Num_cartao)
    {
        $sql = "DELETE from \"Usuario\" WHERE \"Num_cartao\"=$Num_cartao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($Nome, $Endereco, $Telefone)
    {
        $sql = "INSERT INTO \"Usuario\" (\"Nome\",\"Endereco\",\"Telefone\") VALUES (:Nome, :Endereco, :Telefone)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':Nome', $Nome);
        $stmt->bindValue(':Endereco', $Endereco);
        $stmt->bindValue(':Telefone', $Telefone);
        $stmt->execute();
    }

    public function update($Num_cartao, $Nome, $Endereco, $Telefone){
        $sql = "UPDATE \"Usuario\" SET \"Nome\"='$Nome', \"Endereco\"='$Endereco', \"Telefone\"='$Telefone' WHERE \"Num_cartao\"=$Num_cartao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }


}
