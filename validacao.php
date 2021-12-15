<?php
// incluimos a conexao ao banco
require_once 'conexao.php';

// inserimos os parâmetros
$dados_entrada = array($_POST['usuario'], $_POST['senha'], $_POST['nivel']);
$consulta = $conexao->prepare('SELECT * FROM funcionario WHERE usuario = ? AND senha = ? AND nivel = ?');
$consulta->execute($dados_entrada);
$total_usuarios = $consulta->rowCount();

// obtemos resultados
$resultados = $consulta->fetchAll();

// realizando ações
	// reprovado
	if($total_usuarios == 0){
		echo "<script>alert('Usuário/Senha incorreto. Tente novamente.')</script>";
		echo "<script>window.location.href = 'login.php';</script>";	
	} else {
		// listando resultados
		foreach ($resultados as $usuario) {
			$_SESSION['nome'] = $usuario['nome'];
			$_SESSION['nivel'] = $usuario['nivel'];
		}
		$_SESSION['logado'] = 1;
		//echo "<script>window.location.href = 'index.php';</script>";
		$nivel = $_SESSION['nivel'];
		if ($nivel == 'Administração') {
			header("Location: index.php");
		} elseif ($nivel) {
			header("Location: consulta.php");
		} else {
			header("Location: login.php");
		}
	}
	
?>