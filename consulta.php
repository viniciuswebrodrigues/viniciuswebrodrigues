<?php
require_once 'conexao.php';

if($_SESSION['logado'] != 1){
    echo "<script>alert('Você deve entrar no sistema para acessar esta área.')</script>";
    echo "<script>window.location.href = '../index.php';</script>";	
    exit();
}

    $pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
    //calcular o inicio visualização
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    //consultar no banco de dados
    $result_usuario = "SELECT * FROM `metroatm` WHERE STATUS IS null ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
    $resultado_usuario = $conexao->query($result_usuario);
    
//Verificar se encontrou resultado na tabela "usuarios"
if(($resultado_usuario) AND ($resultado_usuario->rowCount() != 0)){
?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Id/Terminal</th>
				<th>Terminal</th>
                <th>Modelo</th>
                <th>Última venda</th>
                <th>Sonda</th>
                <th>Ação</th>
			</tr>
		</thead>
		<tbody>
<?php
while($row_usuario = $resultado_usuario->fetch(PDO::FETCH_ASSOC)) {
?>
        <tr>
            <th><?php echo $row_usuario['id']; ?></th>
            <th><?php echo $row_usuario['ide']; ?></th>
            <th><?php echo $row_usuario['terminal']; ?></th>
            <th><?php echo $row_usuario['modelo']; ?></th>
            <th><?php echo $row_usuario['ultima_venda']; ?></th>
            <th><?php echo $row_usuario['sonda']; ?></th>            
        </tr>
        <?php
    }?>
    </tbody>
</table>
<?php 
    //Paginação - Somar a quantidade de usuários
    $result_pg = "SELECT COUNT(id) AS num_result FROM metroatm";
    $resultado_pg = $conexao->query($result_pg);
    $row_pg = $resultado_pg->fetch(PDO::FETCH_ASSOC);
    //Quantidade de pagina
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

	//Limitar os link antes depois
	$max_links = 2;

	echo '<nav aria-label="paginacao">';
	echo '<ul class="pagination">';
	echo '<li class="page-item">';
	echo "<span class='page-link'><a href='#' onclick='listar_usuario(1, $qnt_result_pg)'>Primeira</a> </span>";
	echo '</li>';
	for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
		if($pag_ant >= 1){
			echo "<li class='page-item'><a class='page-link' href='#' onclick='listar_usuario($pag_ant, $qnt_result_pg)'>$pag_ant </a></li>";
		}
	}
	echo '<li class="page-item active">';
	echo '<span class="page-link">';
	echo "$pagina";
	echo '</span>';
	echo '</li>';

	for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
		if($pag_dep <= $quantidade_pg){
			echo "<li class='page-item'><a class='page-link' href='#' onclick='listar_usuario($pag_dep, $qnt_result_pg)'>$pag_dep</a></li>";
		}
	}
	echo '<li class="page-item">';
	echo "<span class='page-link'><a href='#' onclick='listar_usuario($quantidade_pg, $qnt_result_pg)'>Última</a></span>";
	echo '</li>';
	echo '</ul>';
	echo '</nav>';

}else{
	echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}
?>







