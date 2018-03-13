<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM mov ";
$query .= 'WHERE id_factura = '.$_POST["idfac"].' ';

//error_log(print_r($_POST, true));
if(isset($_POST["columns"][1]["search"]["value"]) && !empty($_POST["columns"][1]["search"]["value"]))
{
	//$query .= 'AND id_factura =  '.'$_POST["idfac"]'
	$query = "SELECT * FROM mov ";
	$query .= 'WHERE tipo LIKE "%'.$_POST["columns"][1]["search"]["value"].'%" ';
	$query .= 'AND id_factura = '.$_POST["idfac"].' ';
	//$query .= 'OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))
{
	$query = 'SELECT * FROM mov  WHERE tipo LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR ref LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'AND id_factura = '.$_POST["idfac"].' ';
	;
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
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
	if($row["image"] != '')
	{
		$image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $row["fecha"];
	$sub_array[] = $row["tipo"];
	$sub_array[] = $row["ref"];
	$sub_array[] = $row["monto"];
	$sub_array[] = $row["nota"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Editar</button>
	<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Eliminar</button>';
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