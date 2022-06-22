<?php

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\CadastroUsuarioModel as UsuarioModel;

try {
    $UsuarioModel = new UsuarioModel($pdo);
    $Usuarios = $UsuarioModel->all();
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
            <th>Nome</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>Cadastrar</th>
        </tr>

        <form action="./Controllers/Usuario.php" method="POST">
            <tr>
                <td>
                    <center><input type="text" name="Nome" value="" placeholder="Nome do Aluno" class="input-group-text"></center>
                </td>
                <td>
                    <center><input type="text" name="Endereco" value="" placeholder="Endereço do Aluno" class="input-group-text"></center>
                </td>
                <td>
                    <center><input type="text" name="Telefone" value="" placeholder="Telefone do Aluno" class="input-group-text"></center>
                </td>
                <td><input class="btn btn-primary" type="submit" name="submit" value="Cadastrar"></td>
            </tr>
        </form>
    </table>
    <table class="table">
        <tr>
            <th>Usuarios Cadastrados</th>
        </tr>
        <tr>
            <th>Número do Cartão</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>Comandos</th>

        </tr>
        <?php foreach ($Usuarios as $Usuario) : ?>
            <tr>
                <form action="./Controllers/Usuario.php" method="POST">
                    <td>
                        <center><input type="text" name="Num_cartao" class="input-group-text" value="<?php echo htmlspecialchars($Usuario['Num_cartao']) ?>" readonly></center>
                    </td>
                    <td>
                        <center><input type="text" name="Nome" class="input-group-text" value="<?php echo htmlspecialchars($Usuario['Nome']) ?>"></center>
                    </td>
                    <td>
                        <center><input type="text" name="Endereco" value="<?php echo htmlspecialchars($Usuario['Endereco']) ?>" class="input-group-text"></center>
                    </td>
                    <td>
                        <center><input type="text" name="Telefone" value="<?php echo htmlspecialchars($Usuario['Telefone']) ?>" class="input-group-text"></center>
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