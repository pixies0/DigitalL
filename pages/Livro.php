<?php

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\EditoraModel as EditoraModel;
// use ConexaoPHPPostgres\AutorModel as AutorModel;

try {
    $LivroModel = new LivroModel($pdo);
    $Livros = $LivroModel->innerJoinLA();

    $EditoraModel = new EditoraModel($pdo);
    $Editoras = $EditoraModel->all();
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
            <th>Título</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Cadastrar</th>
        </tr>
        <form action="./Controllers/Livro.php" method="POST">
            <tr>
                <td>
                    <center><input type="text" name="Titulo" value="" placeholder="Titulo do livro" class="input-group-text"></center>
                </td>
                <td>
                    <center><input type="text" name="Nome_autor" value="" placeholder="Nome do autor" class="input-group-text"></center>
                </td>
                <td>
                    <center><select class="input-group-text" name="Nome_editora">
                            <?php foreach ($Editoras as $Editora) : ?>
                                <option value="<?php echo ($Editora['Nome']) ?>"><?php echo htmlspecialchars($Editora['Nome']) ?></option>
                            <?php endforeach; ?>
                        </select></center>
                </td>
                <td><input class="btn btn-primary" type="submit" name="submit" value="Cadastrar"></td>
            </tr>
        </form>
    </table>
    <table class="table">
        <tr>
            <th>Livros Cadastrados</th>
        </tr>
        <tr>
            <th>Codigo</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Comandos</th>

        </tr>

        <?php foreach ($Livros as $Livro) : ?>
            <tr>
                <form action="./Controllers/Livro.php" method="POST">
                    <td>
                        <center><input type="text" name="Cod_livro" class="input-group-text" value="<?php echo htmlspecialchars($Livro['Cod_livro']) ?>" readonly></center>
                    </td>
                    <td>
                        <center><input type="text" name="Titulo" class="input-group-text" value="<?php echo htmlspecialchars($Livro['Titulo']) ?>"></center>
                    </td>
                    <td>
                        <center><input type="text" name="Nome_autor" class="input-group-text" value="<?php echo htmlspecialchars($Livro['Nome_autor']) ?>" readonly></center>
                    </td>
                    <td>
                        <center><input type="text" name="Nome_editora" value="<?php echo htmlspecialchars($Livro['Nome_editora']) ?>" class="input-group-text" readonly></center>
                    </td>
                    <td><input class="btn btn-success" type="submit" name="submit" value="Alterar" style="margin-right: 16px;"><input class="btn btn-danger" type="submit" name="submit" value="Deletar"></td>
                </form>
            </tr>

        <?php endforeach; ?>

    </table>

</div>

<?php
include('../templates/footer.php');
?>