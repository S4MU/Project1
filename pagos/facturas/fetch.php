<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM factura ";
$query .= 'WHERE id_cliente = '.$_POST["idcliente"].' ';

//error_log(print_r($_POST, true));

if(isset($_POST["columns"][1]["search"]["value"]) && !empty($_POST["columns"][1]["search"]["value"])) //Busqueda por columna en la tabla
{
	//$query .= 'AND id_factura =  '.'$_POST["idfac"]'
	$query = "SELECT * FROM factura ";
	$query .= 'WHERE id_factura LIKE "%'.$_POST["columns"][1]["search"]["value"].'%" ';
	$query .= 'AND id_factura = '.$_POST["idcliente"].' ';
	//$query .= 'OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])) //Busqueda general
{
	$query = "SELECT * FROM factura ";
	$query .= 'WHERE id_cliente LIKE "%'.$_POST["columns"][1]["search"]["value"].'%" ';
	$query .= 'OR id_factura LIKE "%'.$_POST["columns"][1]["search"]["value"].'%" ';
	$query .= 'OR fecha LIKE "%'.$_POST["columns"][1]["search"]["value"].'%" ';
	$query .= 'OR monto LIKE "%'.$_POST["columns"][1]["search"]["value"].'%" ';
	$query .= 'AND id_factura = '.$_POST["idcliente"].' ';
	
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
/*if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}*/
//if(isset($_POST["search"]["value"])) 
//error_log($_POST["idfac"].$query);
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	
	$sub_array = array();
	
	
	$sub_array[] = $row['fecha'];
	$sub_array[] = '<a  href="http://tomzacr.com/pagos/index.php?id='.$row['id'].'" id="'.$row['id'].'" class="btn btn-primary btn-xs update">FAC'.$row['id_factura'].'</a>';
	$sub_array[] = $row['monto'] + getcargos($row['id']);
	$sub_array[] = getabono($row['id']);//$row['fecha'];  <------------------------ AQUI VA EL CODIGO QUE SUMA TODOS LOS MOVIMIENTOS PARA SABER EL SALDO
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Pago</button>
	<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Movimiento</button>';



	//$sub_array[] = 'Ejemplo de nota';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);

echo json_encode($output);
?>