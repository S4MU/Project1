<?php
	session_start();
	Include("conexion.php");

	/*Valido que se haya presionado el submit en el formulario*/
	if(isset($_POST['submit']))
	{
		$nombre= $_POST['usuario'];
		$contra= $_POST['contrasena'];

		/*Validacion para que el usuario y/o contraseña no vengan vacios*/
		if((isset($_POST['usuario'])) && (isset($_POST['contrasena'])) )
		{
			/*Query de la consulta para el login*/
			$query="Select usuario,contrasena FROM usuario where usuario='$nombre' and contrasena='$contra'" ;
			$stmt = $conexion->prepare($query);
			$stmt->bindParam(':usuario', $nombre, PDO::PARAM_STR);
			$stmt->bindParam(':contrasena', $contra, PDO::PARAM_STR);
			$stmt->execute();

			/*Si la consulta trajo los datos, paso a la siguiente pagina*/
			if($stmt->rowCount()>0)
			{
				/*Redirijo a la siguiente pagina*/
				header("Location: login_success.php ");

				/*Se genera la variable de sesion*/
				$dataUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

				/*asigno el nombre de usuario a $_SESSION*/
				$_SESSION['username']=$dataUsuario['usuario'];
			}
			/*Si la consulta trajo 0 datos, entonces genero el error*/
			else
			{

				 echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
			}
		}
		else
		{
			/*Redirijo a login.php*/
			header("location: login.php");
		}
	}
	else
	{
		/*Redirijo a login.php*/
		header("location: login.php");
	}
?>
