<?php
include('conexion.php');
/*Si presiono el submit inicia el proceso de registro*/
if (isset($_POST['registrarse']))
{
	 $usuario=$_POST['registro_usuario'];
	 $contrasena=$_POST['registro_contrasena'];
	 $contraseña_confirmar=$_POST['confirmar_contrasena'];
	 $privilegio=$_POST['permisos'];

	 /*Valido que ninguna de las variables este vacia, a pesar de que el mismo formulario ya valida que no vengan vacias*/
	 if(empty($_POST['registro_usuario']))
	 {
		 echo "<script>alert('Vacio');</script>";
		 return;
	 }
	 else if(empty($_POST['registro_contrasena']))
	 {
		 echo "<script>alert('Vacio');</script>";
		 return;
	 }
	 else if(empty($_POST['confirmar_contrasena']))
	 {
		 echo "<script>alert('Vacio');</script>";
		 return;
	 }
	 else
	 {
		 /*Query para averiguar si nombre de usuario ya existe, si existe lanza mensaje de error*/
		$query="SELECT * FROM usuario where usuario='$usuario'";
		$stmt = $conexion->query($query);
		if ($stmt->rowCount()>0)
		{

			$mensaje='<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Nombre de <strong>Usuario y/o Email</strong> ya existente</div>';
			return;

		}
		/*Averiguo si la contraseña y confirmar cntraseña son identicas*/
		else if ($contrasena!=$contraseña_confirmar)
		{
			$mensaje='<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Las contraseñas <strong>no coinciden</strong></div>';
			return;

		}
		/*Valido que el privilegio no sea igual a 0*/
		else if($privilegio == 0 )
		{
			$mensaje='<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Las contraseñas <strong>no coinciden</strong></div>';
			return;

		}
		/*Una vez concluido las validaciones y si no pasa ningun error, procedo a registrar el usuario*/
		else
		{
			try
			{
				/*Encripto la contraseña del usuario al momento de insertarse en la BD con password_hash*/
				$contrasena_cifrada = password_hash($contrasena,PASSWORD_DEFAULT);

				$query="INSERT INTO usuario (usuario, contrasena, privilegio) VALUES (:usuario, :contrasena, :privilegio)";
				$nuevoUsuario = $conexion -> prepare($query);
				$nuevoUsuario -> bindParam(':usuario'   , $usuario, PDO::PARAM_STR);
				$nuevoUsuario -> bindParam(':contrasena', $contrasena_cifrada, PDO::PARAM_STR);
				$nuevoUsuario -> bindParam(':privilegio', $privilegio, PDO::PARAM_STR);
				$stmt= $nuevoUsuario -> execute();
			}
			catch (PDOException $error)
			{
				echo $error;
				print 'ERROR: '. $error->getMessage();
				$mensaje='<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>ERROR AL REGISTRAR NUEVO USUARIO</strong></div>';
				return;
			}
			if($stmt)
			{
				header("location: login.php");
			   $mensaje='<div class="alert alert-success alert-dismissable col-md-offset-4 col-md-3 text-center">
			   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			   <strong>NUEVO USUARIO REGISTRADO CORRECTAMENTE</strong></div>';

			}
		}
	 }
}

?>
