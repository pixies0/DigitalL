<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;

$LivroModel = new LivroModel($pdo);


$Cod_livro_copias = null;
$Cod_unidade_copias = null;
$Quantidade = null;
$Nome_editora = null;
$Cod_livro = null;

if ($_POST['submit'] == 'Cadastrar') {
	if (empty($_POST['Cod_livro'])) {
		header("Location: ../../pages/Copias.php?MSGERROR=Campo Titulo em Branco");
		die();
	} elseif (empty($_POST['Cod_unidade'])) {
		header("Location: ../../pages/Copias.php?MSGERROR=Campo Unidade em Branco");
		die();
	} elseif (empty($_POST['Qt_copias'])) {
		header("Location: ../../pages/Copias.php?MSGERROR=Campo Quantidade em Branco");
		die();
	} else {
		$Cod_livro_copias = $_POST['Cod_livro'];
		$Cod_unidade_copias = $_POST['Cod_unidade'];
		$Quantidade = $_POST['Qt_copias'];
		$LivroModel->insertInLivroCopias($Cod_livro_copias, $Cod_unidade_copias, $Quantidade);
		header("Location: ../../pages/Copias.php?MSG=Cadastrado com Sucesso");
	}
} elseif ($_POST['submit'] == 'Alterar') {
	if (empty($_POST['Qt_copias'])) {
		header("Location: ../../pages/Copias.php?MSGERROR=Campo Quantidade em Branco");
		die();
	} else {
		$Cod_livro = $_POST['Cod_livro'];
		$Quantidade = $_POST['Qt_copias'];
		$LivroModel->updateCopias($Cod_livro, $Quantidade);
		header("Location: ../../pages/Copias.php?MSG=Alterado com Sucesso");
	}
} elseif ($_POST['submit'] == 'Deletar') {
	$Cod_livro = $_POST['Cod_livro'];
	$LivroModel->ddeleteFromCopias($Cod_livro);
	header("Location: ../../pages/Copias.php?MSG=Deletado com Sucesso");
}
