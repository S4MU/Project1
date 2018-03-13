<?php
include('db.php');
include('function.php');
//error_log(print_r($_POST,true));
if(isset($_POST["idcliente"]))
{
//error_log("entramos 1");
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM factura
		WHERE id_cliente = '".$_POST["idcliente"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	if($row["estado"] == 'PENDIENTE'){
	//error_log("entramos 2");
		//$output["first_name"] = $row["first_name"];
		$output["monto"] = $row["monto"];
		$output["fecha"] = $row["fecha"];
		$output["idfac"] = $row["id"];
		
		
		}
	}
	echo json_encode($output);
}
?>