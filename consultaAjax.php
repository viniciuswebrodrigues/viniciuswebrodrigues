<?php
$host="localhost";
$usuario="root";
$contraseña="";
$base="chamados";

$conexion= new mysqli($host, $usuario, $contraseña, $base);
if ($conexion -> connect_errno)
{
	die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> 
		mysqli_connect_error());
}

/////////////////////// CONSULTA A LA BASE DE DATOS ////////////////////////
$resAlumnos=$conexion->query("SELECT * FROM solicitacoes WHERE status IS NULL");

echo '<table border="1" style="border-collapse: collapse;">';
    echo '<tr>';
        echo '<th>Id</th>';
        echo '<th>Id/Terminal</th>';
        echo '<th >Terminal</th>';
        echo '<th >Modelo</th>';
        echo '<th >Última venda</th>';
        echo '<th >Sonda</th>';
        echo '<th >Ação</th>';
    echo '</tr>';

    while ($filaAlumnos = $resAlumnos->fetch_array(MYSQLI_BOTH)) {
    echo '<tr>';
        echo '<td>'.$filaAlumnos['id'].'</td>';
        echo '<td>'.$filaAlumnos['ide'].'</td>';
        echo '<td>'.$filaAlumnos['terminal'].'</td>';
        echo '<td>'.$filaAlumnos['modelo'].'</td>';
        echo '<td>'.$filaAlumnos['ultima_venda'].'</td>';
        echo '<td>'.$filaAlumnos['sonda'].'</td>';
        echo '<td>'."<a href='fit.php?id=".$filaAlumnos['id']."'>Fit</a>".'</td>';
        //echo "<a href=editar.php?id>Fit</a>";
        
    echo '</tr>';
}
echo '</table>';

?>
