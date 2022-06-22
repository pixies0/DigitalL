<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\novaUnidadesModel as nUnidadesModel;

$nUnidadesModel = new nUnidadesModel($pdo);

$Cod = null;
$NomeUnidade = null;
$Cidade = null;
$Estado = null;

if ($_POST['submit'] == 'Cadastrar') {
	if (empty($_POST['Nome_unidade'])) {
		header("Location: ../../pages/Unidade.php?MSGERROR=Nome Em Branco");
		die();
	} elseif (empty($_POST['Cidade'])) {
		header("Location: ../../pages/Unidade.php?MSGERROR=Cidade Em Branco");
		die();
	} elseif (empty($_POST['Estado'])) {
		header("Location: ../../pages/Unidade.php?MSGERROR=Estado Em Branco");
		die();
	} else {
		$NomeUnidade = $_POST['Nome_unidade'];
		$Cidade = $_POST['Cidade'];
		$Estado = $_POST['Estado'];
		$nUnidadesModel->insert($NomeUnidade, $Cidade, $Estado);
		header("Location: ../../pages/Unidade.php?MSG=Cadastrado com Sucesso");
	}
} elseif ($_POST['submit'] == 'Alterar') {
	if (empty($_POST['Nome_unidade'])) {
		header("Location: ../../pages/Unidade.php?MSGERROR=Campo Nome Em Branco");
		die();
	} elseif (empty($_POST['Cidade'])) {
		header("Location: ../../pages/Unidade.php?MSGERROR=Campo Cidade Em Branco");
		die();
	} elseif (empty($_POST['Estado'])) {
		header("Location: ../../pages/Unidade.php?MSGERROR=Campo Estado Em Branco");
		die();
	} else {
		$NomeUnidade = $_POST['Nome_unidade'];
		$Cidade = $_POST['Cidade'];
		$Estado = $_POST['Estado'];
		$Cod = $_POST['Cod_unidade'];
		$nUnidadesModel->update($Cod, $NomeUnidade, $Cidade, $Estado);
		header("Location: ../../pages/Unidade.php?MSG=Alterado com Sucesso");
	}
} elseif ($_POST['submit'] == 'Deletar') {
	$Cod = $_POST['Cod_unidade'];
	$nUnidadesModel->ddelete($Cod);
	header("Location: ../../pages/Unidade.php?MSG=Deletado com Sucesso");
}
