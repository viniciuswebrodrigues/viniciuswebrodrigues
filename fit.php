<?php
include_once 'conexao.php';

if($_SESSION['logado'] != 1){
    echo "<script>alert('Você deve entrar no sistema para acessar esta área.')</script>";
    echo "<script>window.location.href = 'login.php';</script>";	
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Intervenção Técnica</title>
</head>
<body>
    <?php
    if(isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    
    <?php
    //Seleciona os registros da tabela solicitações e aloca o id na variável id
    //O input id stado como hidden recebe o id da tabela de solictações
    
    // váriavel id recebe o id do proc_metro.php 
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $result_edit = "SELECT * FROM solicitacoes WHERE id = $id";

    $resultado_edit = $conexao->prepare($result_edit);
    $resultado_edit->execute();
    $row_cont = $resultado_edit->fetch(PDO::FETCH_ASSOC);
    ?>

<form method="POST" action="proc_fit.php">
    <div class="row">
        <input type="hidden" name="id" class="form-control" value="<?php if(isset($row_cont['id'])){ echo $row_cont['id']; } ?>">

        <div class="col">
            <input type="text" name="ide" class="form-control" value="<?php if(isset($row_cont['ide'])){ echo $row_cont['ide']; } ?>">
        </div><br>

        <div class="col">
            <input type="text" name="terminal" class="form-control" value="<?php if(isset($row_cont['terminal'])){ echo $row_cont['terminal']; } ?>">
        </div><br>
        
        <input name="SendCadCont" type="submit" value="enviar">
    </div>
</form>
</body>
</html>