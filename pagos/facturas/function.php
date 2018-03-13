<?php
$_debugactivate = false;
function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($user_id)
{
	include('db.php');
	$statement = $connection->prepare("SELECT image FROM users WHERE id = '$user_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["image"];
	}
}

function get_total_all_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM users");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}



function getsaldo($facturaid){ //El monto original de la factura
global $_debugactivate;
	include('db.php'); $_saldo = 0;
	$statement = $connection->prepare("SELECT * FROM factura WHERE id = '$facturaid' LIMIT 1");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$_saldo += $row["monto"]; // Agregamos el cobro
	}
	if($_debugactivate) error_log($_saldo);
	$_saldo -= getabono($facturaid);
	if($_debugactivate) error_log($_saldo);
	if($_debugactivate) error_log('Fin factura');
	/*$statement = $connection->prepare("SELECT * FROM mov WHERE id_factura = '$facturaid' and tipo = 'Pago'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$_saldo -= $row["monto"]; // Reducimos pagos
	}*/
	return $_saldo;
}
function getmontofactura($facturaid){ //El monto original de la factura
global $_debugactivate;
	include('db.php'); $_saldo = 0;
	$statement = $connection->prepare("SELECT * FROM factura WHERE id = '$facturaid' LIMIT 1");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$_saldo += $row["monto"]; // Agregamos el cobro
	}
	if($_debugactivate) error_log($_saldo);
	//$_saldo -= getabono($facturaid);
	if($_debugactivate) error_log($_saldo);
	if($_debugactivate) error_log('Fin factura');
	/*$statement = $connection->prepare("SELECT * FROM mov WHERE id_factura = '$facturaid' and tipo = 'Pago'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$_saldo -= $row["monto"]; // Reducimos pagos
	}*/
	return $_saldo;
}
function getabono($facturaid){ //Sumamos pagos
global $_debugactivate;
	include('db.php'); $_saldo = 0;
	
	
	
	$statement = $connection->prepare("SELECT * FROM mov WHERE id_factura = '$facturaid'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	if($row["tipo"] == 'Pago') $_saldo += $row["monto"]; // Abonamos pagos
	//if($row["tipo"] == 'Nota de Debito') $_saldo += $row["monto"]; // Aumentamos deuda
	if($row["tipo"] == 'Nota de Credito') $_saldo += $row["monto"]; // Reducimos deuda
	if($row["tipo"] == 'Adelanto') $_saldo += $row["monto"]; // Abonamos pagos
	}
	return $_saldo;
}
function getcargos($facturaid){ //Sumamos deuda
global $_debugactivate;
	include('db.php'); $_saldo = 0;
	
	
	
	$statement = $connection->prepare("SELECT * FROM mov WHERE id_factura = '$facturaid'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
	if($row["tipo"] == 'Nota de Debito') $_saldo += $row["monto"]; // Aumentamos deuda

	}
	return $_saldo;
}
function getsaldocliente($clienteid){ //Saldo original + cargos - abonos
	global $_debugactivate;
	include('db.php'); $_saldo = 0; $_cargos = 0; $_abonos = 0;
	$statement = $connection->prepare("SELECT * FROM factura WHERE id_cliente = '$clienteid' AND estado = 'PENDIENTE'");
	if($_debugactivate) error_log($clienteid);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$_cargos += (getcargos($row['id']) + getmontofactura($row['id'])); // Agregamos el cobro
		$_abonos += getabono($row['id']); // Agregamos el cobro

		//if($_debugactivate)
		 error_log('Factura:'.$row['id_factura'].'En cargos:'. $_cargos. ' ' . $_abonos);
		
	}
	$_saldo = ($_cargos - $_abonos);
	
	return $_saldo;
}
function getsaldofactura($facturaid){
return (getcargos($facturaid) + getmontofactura($facturaid)) - getabono($facturaid);
}
?>