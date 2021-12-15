<?php
include_once 'conexao.php';

$SendCadCont = filter_input(INPUT_POST, 'SendCadCont', FILTER_SANITIZE_STRING);
if($SendCadCont) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $ide = filter_input(INPUT_POST, 'ide', FILTER_SANITIZE_STRING);
    $terminal = filter_input(INPUT_POST, 'terminal', FILTER_SANITIZE_STRING);

    $nome = $_SESSION['nome'];
    $result = "INSERT INTO ficha_intervencao (tecnico, ide, terminal) VALUES(:nome, :ide, :terminal)";
    $result = $conexao->prepare($result);
    $result->bindParam(':ide', $ide);
    $result->bindParam(':terminal', $terminal);
    $result->bindParam(':nome', $_SESSION['nome']);
    
    //update na tabela de solictações 
    try {
        $sql = "UPDATE solicitacoes SET status = 'concluido' WHERE id = $id";
        
          $stmt = $conexao->prepare($sql);
        
          // execute the query
          $stmt->execute();
          echo $stmt->rowCount() . " records UPDATED successfully";
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
  

    if($result->execute()) {
     $_SESSION['msg'] = "<p style='color:green;'>Enviado com sucesso</p>";
     header("location: consulta.php");
    }else{
     $_SESSION['msg'] = "<p style='color:red;'>Não foi possível enviar</p>";
     header("location: consulta.php");
    }
}else{
    $_SESSION['msg'] = "<p style='color:red;'>Não foi possível enviar</p>";
    header("location: consulta.php");
}
