<?php

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\NovaUnidadesModel as NovaUnidadesModel;

try {
    $LivroModel = new LivroModel($pdo);
    $Livros = $LivroModel->innerJoinLA();
    $Books = $LivroModel->innerJoinBig();

    $NovaUnidadesModel = new NovaUnidadesModel($pdo);
    $Unidades = $NovaUnidadesModel->all();
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
            <th>Livro</th>
            <th>Unidade</th>
            <th>Quantidade</th>
            <th>Cadastrar</th>
        </tr>
        <form action="./Controllers/Copias.php" method="POST">
            <tr>
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
                    <center><input type="text" name="Qt_copias" value="" placeholder="ex.: 25" class="input-group-text"></center>
                </td>
                <td><input class="btn btn-primary" type="submit" name="submit" value="Cadastrar"></td>
            </tr>
        </form>
    </table>
    <table class="table">
        <tr>
            <th>Cópias Registradas</th>
        </tr>
        <tr>
            <th>Código Livro</th>
            <th>Livro</th>
            <th>Autor</th>
            <th>Unidade</th>
            <th>Quantidade</th>
            <th>Comandos</th>
        </tr>

        <?php foreach ($Books as $Book) : ?>
            <tr>
                <form action="./Controllers/Copias.php" method="POST">
                    <td>
                        <center><input type="text" name="Cod_livro" class="input-group-text" value="<?php echo htmlspecialchars($Book['Cod_livro']) ?>" readonly></center>
                    </td>
                    <td>
                        <center><input type="text" name="Titulo" class="input-group-text" value="<?php echo htmlspecialchars($Book['Titulo']) ?>" readonly></center>
                    </td>
                    <td>
                        <center><input type="text" name="Cod_livro_autor" class="input-group-text" value="<?php echo htmlspecialchars($Book['Nome_autor']) ?>" readonly></center>
                    </td>
                    <td>
                        <center><input type="text" name="Nome_unidade" class="input-group-text" value="<?php echo htmlspecialchars($Book['Nome_unidade']) ?>" readonly></center>
                    </td>
                    <td>
                        <center><input type="text" name="Qt_copias" value="<?php echo htmlspecialchars($Book['Qt_copia']) ?>" class="input-group-text"></center>
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