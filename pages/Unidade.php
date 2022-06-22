<?php

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\NovaUnidadesModel as NovaUnidadesModel;
use ConexaoPHPPostgres\novaUnidadesModel as UnidadeModel;

try {

    $NovaUnidadesModel = new NovaUnidadesModel($pdo);
    $NovaUnidades = $NovaUnidadesModel->all();
    $UnidadeModel = new UnidadeModel($pdo);
    $Unidades = $UnidadeModel->all();
} catch (\PDOException $e) {
    echo $e->getMessage();
}

?>
<?php
include('../templates/header.php');
?>
<div id="bb1" style="min-height: 100vh;">

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

    <?php
    if (isset($_GET['MSGERROR'])) {
        echo '<h2 style="color:red"><center>' . $_GET['MSGERROR'] . '</h2></center>';
    }
    if (isset($_GET['MSG'])) {
        echo '<h2 style="color:green"><center>' . $_GET['MSG'] . '</h2></center>';
    }
    ?>

    <table class="table">
        <tr>
            <th>Unidade</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Cadastrar</th>
        </tr>
        <form action="./Controllers/Unidade.php" method="POST">
            <tr>
                <td>
                    <center><input type="text" class="input-group-text" name="Nome_unidade" value="" placeholder="Nome da unidade"></center>
                </td>
                <td>
                    <center><input type="text" class="input-group-text" name="Cidade" value="" placeholder="Nome da cidade"></center>
                </td>
                <td>
                    <center><input type="text" class="input-group-text" name="Estado" value="" placeholder="Sigla do estado"></center>
                </td>

                <td><input class="btn btn-primary" type="submit" name="submit" value="Cadastrar"></td>
            </tr>
        </form>
    </table>
    <table class="table">
        <tr>
            <th>Unidades Cadastradas</th>
        </tr>
        <tr>
            <th>Codigo da Unidade</th>
            <th>Nome</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Comandos</th>

        </tr>
        <?php foreach ($Unidades as $Unidade) : ?>
            <tr>
                <form action="./Controllers/Unidade.php" method="POST">
                    <td>
                        <center><input type="text" class="input-group-text" name="Cod_unidade" value="<?php echo $Unidade['Cod_unidade'] ?>" readonly></center>
                    </td>
                    <td>
                        <center><input type="text" name="Nome_unidade" class="input-group-text" value="<?php echo htmlspecialchars($Unidade['Nome_unidade']) ?>"></center>
                    </td>
                    <td>
                        <center><input type="text" name="Cidade" value="<?php echo $Unidade['Cidade'] ?>" class="input-group-text"></center>
                    </td>
                    <td>
                        <center><input type="text" class="input-group-text" name="Estado" value="<?php echo $Unidade['Estado'] ?>" readonly></center>
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