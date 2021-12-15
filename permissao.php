<?php
	session_start();
	error_reporting(0);
	if($_SESSION['logado'] != 1){
		echo "<script>alert('Você deve entrar no sistema para acessar esta área.')</script>";
		echo "<script>window.location.href = 'index.php';</script>";	
		exit();
		// e se eu tirar
	}
?>