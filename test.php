<?php session_start();?>
<?= $_SESSION['nome'];
	if($_SESSION['logado'] != 1){
		echo "<script>alert('Você deve entrar no sistema para acessar esta área.')</script>";
		echo "<script>window.location.href = 'login.php';</script>";	
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Importar dados do Excel</title>
	<head>
	<body>
		<h1>Upload Excel</h1>

		<a href="logout.php">Sair</a>
		
		<form method="POST" action="processa.php" enctype="multipart/form-data">
			<label>Arquivo</label>
			<input type="file" name="arquivo"><br><br>
			<input type="submit" value="Enviar">
		</form>
		
	</body>
</html>