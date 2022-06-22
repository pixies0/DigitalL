<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\CadastroUsuarioModel as UsuarioModel;

$UsuarioModel = new UsuarioModel($pdo);

$Nome = null;
$Endereco = null;
$Telefone = null;

if ($_POST['submit'] == 'Cadastrar') {
	if (empty($_POST['Nome'])) {
		header("Location: ../../pages/Usuario.php?MSGERROR=Nome em Branco");
		die();
	} elseif (empty($_POST['Telefone'])) {
		header("Location: ../../pages/Usuario.php?MSGERROR=Telefone em Branco");
		die();
	} else {
		$Nome = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];
		try {
			$UsuarioModel->insert($Nome, $Endereco, $Telefone);
			header("Location: ../../pages/Usuario.php?MSG=Cadastrado com Sucesso");
		} catch (\Throwable $th) {
			echo ($th);
			header("Location: ../../pages/Usuario.php?MSGERROR=Impossível Inserir Usuário");
		}
	}
} elseif ($_POST['submit'] == 'Alterar') {
	if (empty($_POST['Nome'])) {
		header("Location: ../../pages/Usuario.php?MSGERROR=Nome em Branco");
		die();
	} elseif (empty($_POST['Telefone'])) {
		header("Location: ../../pages/Usuario.php?MSGERROR=Data de Nascimento em Branco");
		die();
	} else {
		$Numero_cartao = $_POST['Num_cartao'];
		$Nome = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];
		$UsuarioModel->update($Numero_cartao, $Nome, $Endereco, $Telefone);
		header("Location: ../../pages/Usuario.php?MSG=Alterado com Sucesso");
	}
} elseif ($_POST['submit'] == 'Deletar') {
	$Numero_cartao = $_POST['Num_cartao'];
	$UsuarioModel->ddelete($Numero_cartao);
	header("Location: ../../pages/Usuario.php?MSG=Deletado com Sucesso");
}
