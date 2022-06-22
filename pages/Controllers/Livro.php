<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\AutorModel as AutorModel;

$AutorModel = new AutorModel($pdo);
$LivroModel = new LivroModel($pdo);


$Cod_livro = null;
$Titulo = null;
$Nome_autor = null;
$Nome_editora = null;

if ($_POST['submit'] == 'Cadastrar') {
	if (empty($_POST['Titulo'])) {
		header("Location: ../../pages/Livro.php?MSGERROR=Campo Titulo em Branco");
		die();
	} elseif (empty($_POST['Nome_autor'])) {
		header("Location: ../../pages/Livro.php?MSGERROR=Campo Autor em Branco");
		die();
	} elseif (empty($_POST['Nome_editora'])) {
		header("Location: ../../pages/Livro.php?MSGERROR=Campo Editora em Branco");
		die();
	} else {
		$Titulo = $_POST['Titulo'];
		$Nome_autor = $_POST['Nome_autor'];
		$Nome_editora = $_POST['Nome_editora'];
		$LivroModel->insert($Titulo, $Nome_editora);
		$AutorModel->insert($Nome_autor);
		header("Location: ../../pages/Livro.php?MSG=Cadastrado com Sucesso");
	}
} elseif ($_POST['submit'] == 'Alterar') {
	if (empty($_POST['Cod_livro'])) {
		header("Location: ../../pages/Livro.php?MSGERROR=Campo Livro em Branco");
		die();
	} elseif (empty($_POST['Titulo'])) {
		header("Location: ../../pages/Livro.php?MSGERROR=Campo Titulo em Branco");
		die();
	} elseif (empty($_POST['Nome_autor'])) {
		header("Location: ../../pages/Livro.php?MSGERROR=Campo Autor em Branco");
		die();
	} elseif (empty($_POST['Nome_editora'])) {
		header("Location: ../../pages/Livro.php?MSGERROR=Campo Editora em Branco");
		die();
	} else {
		$Cod_livro = $_POST['Cod_livro'];
		$Titulo = $_POST['Titulo'];
		$Nome_autor = $_POST['Nome_autor'];
		$Nome_editora = $_POST['Nome_editora'];
		$LivroModel->update($Cod_livro, $Titulo, $Nome_editora);
		header("Location: ../../pages/Livro.php?MSG=Alterado com Sucesso");
	}
} elseif ($_POST['submit'] == 'Deletar') {
	$Cod_livro = $_POST['Cod_livro'];
	$LivroModel->ddelete($Cod_livro);
	header("Location: ../../pages/Livro.php?MSG=Deletado com Sucesso");
}
