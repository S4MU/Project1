<?php
include('db.php');
include('function.php');
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
				':id_factura'	=>	$_POST["idfac"],
				':tipo'	=>	$_POST["Tipo"],
				':monto'=>	$_POST["Monto"],
				':ref'	=>	$_POST["Ref"],
				':nota'	=>	$_POST["Nota"],
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
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