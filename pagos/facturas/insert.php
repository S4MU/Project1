<?php
include('db.php');
include('function.php');
error_log(print_r($_POST,true));
$_msg = "";
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
	
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO mov (id_cliente,id_factura,tipo, monto,ref,nota, image) 
			VALUES (:id_cliente,:id_factura,:tipo, :monto,:ref,:nota, :image)
		");
		$result = $statement->execute(
			array(
				':id_cliente'	=>	$_POST["idcliente"],
				':id_factura'	=>	$_POST["idfactura"],
				':tipo'	=>	$_POST["Tipo"],
				':monto'=>	$_POST["Monto"],
				':ref'	=>	$_POST["Ref"],
				':nota'	=>	$_POST["Nota"],
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Movimiento Agregado';
		}
	}
	if($_POST["operation"] == "Pago"){
			error_log("bien");
		$statement = $connection->prepare("
			INSERT INTO mov (id_cliente,id_factura,tipo, monto,ref,nota, image) 
			VALUES (:id_cliente,:id_factura,:tipo, :monto,:ref,:nota, :image)
		");
		if(getsaldofactura($_POST["idfactura"]) > 0){
		//error_log("bien1".getsaldo($_POST["idfactura"]));
		$result = $statement->execute(
			array(
				':id_cliente'	=>	$_POST["idcliente"],
				':id_factura'	=>	$_POST["idfactura"],
				':tipo'	=>	"Pago",
				':monto'=>	getsaldofactura($_POST["idfactura"]),
				':ref'	=>	$_POST["Ref"],
				':nota'	=>	"Pago masivo",
				':image'		=>	""
			)
		);
		}else{
		$_msg = 'La factura ya ha sido abonada a totalidad';
		}
		if(!empty($result))
		{
			$_msg = 'Pago realizado';
		}
		echo $_msg;
	
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE users 
			SET first_name = :first_name, last_name = :last_name, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':last_name'	=>	$_POST["last_name"],
				':image'		=>	$image,
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>