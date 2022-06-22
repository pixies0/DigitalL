<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\EditoraModel as EditoraModel;

$EditoraModel = new EditoraModel($pdo);

$Nome = null;
$Endereco = null;
$Telefone = null;
$Cod_editora = null;

if ($_POST['submit'] == 'Cadastrar') {
	if (empty($_POST['Nome'])) {
		header("Location: ../../pages/Editora.php?MSGERROR=Campo Nome em Branco");
		die();
	} elseif (empty($_POST['Telefone'])) {
		header("Location: ../../pages/Editora.php?MSGERROR=Campo Telefone em Branco");
		die();
	} else {
		$Nome = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];
		$EditoraModel->insert($Nome, $Endereco, $Telefone);
		header("Location: ../../pages/Editora.php?MSG=Cadastrado com Sucesso");
	}
} elseif ($_POST['submit'] == 'Alterar') {
	if (empty($_POST['Nome'])) {
		header("Location: ../../pages/Editora.php?MSGERROR=Campo Nome em Branco");
		die();
	} elseif (empty($_POST['Telefone'])) {
		header("Location: ../../pages/Editora.php?MSGERROR=Campo Telefone em Branco");
		die();
	} else {
		$Cod_editora = $_POST['Cod_editora'];
		$Nome = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];
		$EditoraModel->update($Cod_editora, $Nome, $Endereco, $Telefone);
		header("Location: ../../pages/Editora.php?MSG=Alterado com Sucesso");
	}
} elseif ($_POST['submit'] == 'Deletar') {
	$Nome = $_POST['Cod_editora'];
	$EditoraModel->ddelete($Nome);
	header("Location: ../../pages/Editora.php?MSG=Deletado com Sucesso");
}
