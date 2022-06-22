<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\EmprestimoModel as EmprestimoModel;
use ConexaoPHPPostgres\LivroModel as LivroModel;

try {
	$EmprestimoModel = new EmprestimoModel($pdo);
	$Emprestimo = $EmprestimoModel->all();
	$LivroModel = new LivroModel($pdo);
	$Livro = $LivroModel->all();
} catch (\PDOException $e) {
	echo $e->getMessage();
}



$Data_emprestimo = null;
$Data_devolucao = null;
$Cod_unidade = null;
$Cod_livro = null;
$Numero_cartao = null;



if ($_POST['submit'] == 'INSERIR') {
	if (empty($_POST['Cod_livro'])) {
		header("Location: ../../pages/Emprestimo.php?MSGERROR=Livro em branco!");
		die();
	} elseif (empty($_POST['Cod_unidade'])) {
		header("Location: ../../pages/Emprestimo.php?MSGERROR=Unidade em branco!");
		die();
	} elseif (empty($_POST['Num_cartao'])) {
		header("Location: ../../pages/Emprestimo.php?MSGERROR=Aluno em branco!");
		die();
	} elseif (empty($_POST['Data_emprestimo'])) {
		header("Location: ../../pages/Emprestimo.php?MSGERROR=Data em branco!");
		die();
	} else {
		$Numero_cartao = $_POST['Num_cartao'];
		$Cod_livro = $_POST['Cod_livro'];
		$Cod_unidade = $_POST['Cod_unidade'];
		$Data_emprestimo = $_POST['Data_emprestimo'];
		$ano = substr($Data_emprestimo, 0, 4);
		$ano = intval($ano) + 1;
		$Data_devolucao = $ano . substr($Data_emprestimo, 4);

		try {
			$EmprestimoModel->insert($Cod_livro, $Cod_unidade, $Numero_cartao, $Data_emprestimo, $Data_devolucao);
			$EmprestimoModel->atualizarCopias($Cod_livro, $Cod_unidade);
			header("Location: ../../pages/Emprestimo.php?MSG=Cadastrado com sucesso!");
		} catch (\PDOException $e) {
			echo $e->getMessage();
			header("Location: ../../pages/Emprestimo.php?MSGERROR=Usuário Já Possuí Este Título");
		}
	}
} elseif ($_POST['submit'] == 'Devolver') {
	$Numero_cartao = $_POST['Num_cartao'];
	$Cod_livro = $_POST['Cod_livro'];
	$Cod_unidade = $_POST['Cod_unidade'];
	$EmprestimoModel->ddelete($Numero_cartao, $Cod_livro, $Cod_unidade);
	$EmprestimoModel->devolverCopias($Cod_livro, $Cod_unidade);
	header("Location: ../../pages/Emprestimo.php?MSG=Operação sucedida");
}
