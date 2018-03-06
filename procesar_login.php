<?php
	session_start();
	Include("conexion.php");

	/*Valido que se haya presionado el submit en el formulario*/
	if(isset($_POST['submit']))
	{
		$nombre= $_POST['usuario'];
		$contra= $_POST['contrasena'];

		/*Validacion para que el usuario y/o contraseña no vengan vacios*/
		if(empty($_POST['usuario']))
		{
			header("location: login.php");
			return;
		}
		else if(empty($_POST['contrasena']))
		{
			header("location: login.php");
			return;
		}
		else
		{
			echo "<script>alert('Entra');</script>";
			/*Query de la consulta para el login*/
			$query="Select * FROM usuario where usuario='$nombre'" ;
			$stmt = $conexion->prepare($query);
			$stmt->execute();

			/*Si la consulta trajo los datos, paso a la siguiente pagina*/
			if($stmt->rowCount()>0)
			{
				echo "<script>alert('Entra');</script>";

				/*Se genera la variable de sesion*/
				$dataUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

				/*una vez almacenados los resultados de la consulta, pregunto mediante password_verify si las contraseñas son identicas*/
				if(password_verify($_POST['contrasena'], $dataUsuario['contrasena']))
				{
					/*Redirijo a la siguiente pagina*/
					header("Location: login_success.php ");
					/*asigno el nombre de usuario a $_SESSION*/
					$_SESSION['username']=$dataUsuario['usuario'];
				}
				else
				{
					echo "<script>alert('Mal');</script>";
					header("location: login.php");
				}
			}
			/*Si la consulta trajo 0 datos, entonces genero el error*/
			else
			{
				echo "<script>alert('Mal 2');</script>";
				echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
			}
		}
	}
	else
	{	echo "<script>alert('Mal 3');</script>";
		/*Redirijo a login.php*/
		header("location: login.php");
	}
?>
