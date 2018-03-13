<?php
	session_start();
	/*Dentro de config esta la conexion*/
	Include("config/conexion2.php");

	/*Valido que se haya presionado el submit en el formulario*/
	if(isset($_POST['submit']))
	{
		$nombre= $_POST['usuario'];
		$contra= $_POST['contrasena'];
		/*Validacion para que el usuario y/o contraseña no vengan vacios*/
		if(empty($_POST['usuario']))
		{
			echo "<script> alert('¡El campo usuario y/o contraseña están vacios!');window.location= 'index.php' </script>";
		}
		else if(empty($_POST['contrasena']))
		{
			echo "<script> alert('¡El campo usuario y/o contraseña están vacios!');window.location= 'index.php' </script>";
		}
		else
		{
			/*Query de la consulta para el login*/
			$query="Select * FROM usuario where usuario='$nombre'" ;
			$stmt = $conexion->prepare($query);
			$stmt->execute();

			/*Si la consulta trajo los datos, paso a la siguiente pagina*/
			if($stmt->rowCount()>0)
			{
				/*Se genera la variable de sesion*/
				$dataUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

				/*una vez almacenados los resultados de la consulta, pregunto mediante password_verify si las contraseñas son identicas*/
				if(password_verify($_POST['contrasena'], $dataUsuario['contrasena']))
				{
					/*Redirijo a la siguiente pagina, a falta de conocer donde redirigen los demas privilegios,
					del 5 al 10, redirigen a facturas.php*/
		   		/*asigno el nombre de usuario a $_SESSION*/
					$_SESSION['username']=$dataUsuario['usuario'];
					switch ($dataUsuario['privilegio']) {
						case '1':
							//header("Location: facturas.php ");
							break;
						case '2':
							//header("Location: facturas.php ");
							break;
						case '3':
							//header("Location: facturas.php ");
							break;
						case '4':
							//header("Location: facturas.php ");
							break;
						case '5':
							header("Location: facturas.php ");
							break;
						case '6':
							header("Location: facturas.php ");
							break;
						case '7':
							header("Location: facturas.php ");
							break;
						case '8':
							header("Location: facturas.php ");
						 	break;
						case '9':
							header("Location: facturas.php ");
							break;
						case '10':
							header("Location: facturas.php ");
							break;
						default:
							header("Location: loginprincipal.php ");
							break;
					}
				}
				else
				{
					echo "<script> alert('¡Las contraseñas no son identicas!');window.location= 'index.php' </script>";
				}
			}
			/*Si la consulta trajo 0 datos, entonces genero el error*/
			else
			{
				echo "<script> alert('¡El usuario no existe, verifique la información!');window.location= 'index.php' </script>";
			}
		}
	}
	else
	{
		header("location: loginprincipal.php");
	}
?>
