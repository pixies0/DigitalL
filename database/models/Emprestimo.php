<?php

namespace ConexaoPHPPostgres;

class EmprestimoModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function atualizarCopias($Cod_livro, $Cod_unidade)
    {
        $sql = "UPDATE \"Livro_copias\" SET \"Qt_copia\" = \"Qt_copia\" - 1 WHERE \"Cod_livro_copias\"=$Cod_livro AND \"Cod_unidade_copias\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function devolverCopias($Cod_livro, $Cod_unidade)
    {
        $sql = "UPDATE \"Livro_copias\" SET \"Qt_copia\" = \"Qt_copia\" + 1 WHERE \"Cod_livro_copias\"=$Cod_livro AND \"Cod_unidade_copias\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Cod_livro_emprestimo", "Cod_unidade_emprestimo", "Nr_cartao_emprestimo", to_char("Data_emprestimo", \'DD-MM-YYYY\')"Data_emprestimo", to_Char("Data_devolucao", \'DD-MM-YYYY\')"Data_devolucao" FROM "Livro_emprestimo"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_livro_emprestimo' => $row['Cod_livro_emprestimo'],
                'Cod_unidade_emprestimo' => $row['Cod_unidade_emprestimo'],
                'Nr_cartao_emprestimo' => $row['Nr_cartao_emprestimo'],
                'Data_emprestimo' => $row['Data_emprestimo'],
                'Data_devolucao' => $row['Data_devolucao']
            ];
        }
        return $stocks;
    }



    public function ddelete($Numero_cartao)
    {
        $sql = "DELETE FROM \"Livro_emprestimo\" WHERE \"Nr_cartao_emprestimo\"=$Numero_cartao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insert($Cod_livro, $Cod_unidade, $Numero_cartao, $Data_emprestimo, $Data_devolucao)
    {
        $sql = "INSERT INTO \"Livro_emprestimo\" (\"Cod_livro_emprestimo\", \"Cod_unidade_emprestimo\", \"Nr_cartao_emprestimo\", \"Data_emprestimo\", \"Data_devolucao\") VALUES ($Cod_livro, $Cod_unidade, $Numero_cartao, TO_DATE('$Data_emprestimo','YYYY-MM-DD'), TO_DATE('$Data_devolucao','YYYY-MM-DD'))";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function update($Data_emprestimo, $Data_devolucao, $Cod_livro, $Cod_unidade)
    {
        $ano = substr($Data_emprestimo, 0, 4);
        $ano = $ano + (1);
        $Data_devolucao = $ano . substr($Data_emprestimo, 4);
        $sql = "UPDATE \"Livro_emprestimo\" SET \"Data_emprestimo\"=TO_DATE ('$Data_emprestimo','DD-MM-YYYY'), \"Data_devolucao\"=TO_DATE ('$Data_devolucao','DD-MM-YYYY') WHERE \"Cod_livro_emprestimo\"=$Cod_livro AND \"Cod_unidade_emprestimo\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function Copias($Cod_unidade, $Cod_livro)
    {
        $stmt = $this->pdo->query('SELECT DISTINCT "Qt_copia" FROM "Unidade_Biblioteca" INNER JOIN "Livro_copias" ON "Cod_unidade_copias"=$Cod_unidade INNER JOIN "Livro" ON "Cod_livro_copias"=$Cod_livro');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_unidade_copias' => $row['Cod_unidade_copias'],
                'Cod_livro_copias' => $row['Cod_livro_copias'],
            ];
        }
        return $stocks;
    }

    public function getUnidadeLivroAluno()
    {
        $stmt = $this->pdo->query('SELECT "Num_cartao", "Nome", "Cod_livro", "Titulo", "Cod_unidade", "Nome_unidade", to_char("Data_emprestimo", \'DD-MM-YYYY\')"Data_emprestimo", to_Char("Data_devolucao", \'DD-MM-YYYY\')"Data_devolucao" FROM "Livro_emprestimo" INNER JOIN "Livro" ON "Cod_livro"="Cod_livro_emprestimo" INNER JOIN "Usuario" ON "Num_cartao"="Nr_cartao_emprestimo" INNER JOIN "Unidade_Biblioteca" ON "Cod_unidade"="Cod_unidade_emprestimo";');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Num_cartao' => $row['Num_cartao'],
                'Nome' => $row['Nome'],
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Cod_unidade' => $row['Cod_unidade'],
                'Nome_unidade' => $row['Nome_unidade'],
                'Data_emprestimo' => $row['Data_emprestimo'],
                'Data_devolucao' => $row['Data_devolucao']
            ];
        }
        return $stocks;
    }
}
