<?php

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\CadastroUsuarioModel as UsuarioModel;
use ConexaoPHPPostgres\novaUnidadesModel as UnidadeModel;
use ConexaoPHPPostgres\EmprestimoModel as EmprestimoModel;

try {
    $LivroModel = new LivroModel($pdo);
    $Livros = $LivroModel->teste();
    // $Books = $LivroModel->innerJoinBig();

    $UsuarioModel = new UsuarioModel($pdo);
    $Usuarios = $UsuarioModel->all();

    $UnidadeModel = new UnidadeModel($pdo);
    $Unidades = $UnidadeModel->all();

    $EmprestimoModel = new EmprestimoModel($pdo);
    $Emprestimo = $EmprestimoModel->getUnidadeLivroAluno();
} catch (\PDOException $e) {
    echo $e->getMessage();
}

?>

<?php
include('../templates/header.php');
?>

<div id="bb1" style="min-height: 100vh;">
    <?php
    if (isset($_GET['MSGERROR'])) {
        echo '<h2 style="color:red"><center>' . $_GET['MSGERROR'] . '</h2></center>';
    }
    if (isset($_GET['MSG'])) {
        echo '<h2 style="color:green"><center>' . $_GET['MSG'] . '</h2></center>';
    }
    ?>

    <style>
        table {
            background: #FFFFFF;
            box-shadow: 0px 16px 32px rgba(5, 18, 34, 0.08);
            border-radius: 24px;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            padding: 32px;
        }

        td,
        th {
            border: 1.5px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr {
            background-color: #ffffff;
        }
    </style>
    <table class="table">
        <tr>
            <th>Aluno</th>
            <th>Livro</th>
            <th>Unidade</th>
            <th>Data do Empréstimo</th>
            <th>Adicionar</th>
        </tr>
        <form action="./Controllers/Emprestimo.php" method="POST">
            <tr>
                <td>
                    <center><select class="input-group-text" name="Num_cartao">
                            <?php foreach ($Usuarios as $Usuario) : ?>
                                <option value="<?php echo ($Usuario['Num_cartao']) ?>"><?php echo htmlspecialchars($Usuario['Nome']) ?></option>
                            <?php endforeach; ?>
                        </select></center>
                </td>

                <td>
                    <center><select class="input-group-text" name="Cod_livro">
                            <?php foreach ($Livros as $Livro) : ?>
                                <option value="<?php echo ($Livro['Cod_livro']) ?>"><?php echo htmlspecialchars($Livro['Titulo']) ?></option>
                            <?php endforeach; ?>
                        </select></center>
                </td>

                <td>
                    <center><select class="input-group-text" name="Cod_unidade">
                            <?php foreach ($Unidades as $Unidade) : ?>
                                <option value="<?php echo ($Unidade['Cod_unidade']) ?>"><?php echo htmlspecialchars($Unidade['Nome_unidade']) ?></option>
                            <?php endforeach; ?>
                        </select></center>
                </td>

                <td>
                    <center><input type="date" name="Data_emprestimo" value="" class="input-group-text"></center>
                </td>

                <td><input class="btn btn-primary" type="submit" name="submit" value="INSERIR"></td>
            </tr>
        </form>
    </table>
    <table class="table">
        <tr>
            <th>Empréstimos Pendentes</th>
        </tr>
        <tr>
            <th>Usuário</th>
            <th>Título</th>
            <th>Unidade</th>
            <th>Data do Empréstimo</th>
            <th>Data MAX. de Devolução</th>
            <th>Comandos</th>
        </tr>

        <form action="./Controllers/Emprestimo.php" method="POST">
            <?php foreach ($Emprestimo as $Emprestimo) : ?>

                <tr>
                    <td>
                        <center><input type="text" name="Nome" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Nome']) ?>" readonly></center>
                    </td>
                    <input type="hidden" name="Num_cartao" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Num_cartao']) ?>">
                    <td>
                        <center><input type="text" name="Cod_livro" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Titulo']) ?>" readonly></center>
                    </td>
                    <input type="hidden" name="Cod_livro" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Cod_livro']) ?>">
                    <td>
                        <center><input type="text" name="Cod_unidade" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Nome_unidade']) ?>" readonly></center>
                    </td>
                    <input type="hidden" name="Cod_unidade" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Cod_unidade']) ?>">
                    <td>
                        <center><input type="text" name="Data_emprestimo" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Data_emprestimo']) ?>" readonly></center>
                    </td>
                    <td>
                        <center><input type="text" name="Data_devolucao" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Data_devolucao']) ?>" readonly></center>
                    </td>
                    <td><input class="btn btn-danger" type="submit" name="submit" value="Devolver"></td>
                </tr>
            <?php endforeach; ?>
        </form>
    </table>

</div>

<?php
include('../templates/footer.php');
?>