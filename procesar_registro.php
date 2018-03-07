<?php
include('conexion.php');
/*Si presiono el submit inicia el proceso de registro*/
if (isset($_POST['registrarse']))
{
	 $nombre=$_POST['registro_nombre'];
	 $apellidos=$_POST['registro_apellidos'];
	 $email=$_POST['registro_correo'];

	 $usuario=$_POST['registro_usuario'];
	 $contrasena=$_POST['registro_contrasena'];
	 $contraseña_confirmar=$_POST['confirmar_contrasena'];
	 $privilegio=$_POST['permisos'];

	 /*Encripto datos del usuario al momento de insertarse en la BD con password_hash*/
	 $nombre_cifrado = password_hash($nombre,PASSWORD_DEFAULT);
	 $apellido_cifrado = password_hash($apellidos,PASSWORD_DEFAULT);
	 $correo_cifrado = password_hash($email,PASSWORD_DEFAULT);
	 $contrasena_cifrada = password_hash($contrasena,PASSWORD_DEFAULT);
	 /*---------------------------------Fin cifrado---------------------------------*/


	 /*Valido que ninguna de las variables este vacia, a pesar de que el mismo formulario ya valida que no vengan vacias*/
	 if(empty($_POST['registro_usuario']))
	 {
		 echo "<script> alert('¡El campo de nombre de usuario está vacio!');window.location= 'registro.php' </script>";
		 return;
	 }
	 else if(empty($_POST['registro_contrasena']))
	 {
		 echo "<script> alert('¡El campo de contraseña está vacio!');window.location= 'registro.php' </script>";
		 return;
	 }
	 else if(empty($_POST['confirmar_contrasena']))
	 {
		 echo "<script> alert('¡El campo de confirmar contraseña está vacio!');window.location= 'registro.php' </script>";
		 return;
	 }
	 else if(!filter_var($_POST['registro_correo'] , FILTER_VALIDATE_EMAIL))
	 {
		  echo "<script> alert('¡El correo electronico ingresado no es valido!');window.location= 'registro.php' </script>";
		  return;
	 }
	 /*------------------------------Fin validacion campos de ingreso--------------------------------------------------------*/
	 else
	 {
		/*Query para averiguar si nombre de usuario ya existe, si existe lanza mensaje de error*/
		$queryuser="SELECT * FROM usuario where usuario='$usuario'";
		$stmtuser = $conexion->query($queryuser);
		$stmtuser->execute();
		if($stmtuser->rowCount()>0)
		{
			 echo "<script> alert('¡El nombre de usuario ya está en uso, ingrese uno nuevo!');window.location= 'registro.php' </script>";
			 return;
		}
		/*Averiguo si la contraseña y confirmar cntraseña son identicas*/
		else if ($contrasena!=$contraseña_confirmar)
		{
			 echo "<script> alert('¡Las contraseñas no son identicas, verifique!');window.location= 'registro.php' </script>";
			 return;

		}
		/*Valido que el privilegio no sea igual a 0*/
		else if($privilegio == 0 )
		{
			echo "<script> alert('¡Verifique que eligio un tipo de permiso!');window.location= 'registro.php' </script>";
			return;

		}
		/*Una vez concluido las validaciones y si no pasa ningun error, procedo a registrar el usuario*/
		else
		{
			try
			{
				/*Query para averiguar si el correo ya existe, si existe lanza mensaje de error*/
				$querycorreo="SELECT * FROM usuario where email='$correo_cifrado'";
				$stmtcorreo = $conexion->query($querycorreo);
				$stmtcorreo->execute();
				if ($stmtcorreo->rowCount()>0)
				{
					echo "<script> alert('¡El correo electronico ya está en uso, ingrese uno nuevo!');window.location= 'registro.php' </script>";
					return;
				}
				else
				{
				/*Realizo el insert de los datos del usuario en la BD*/

				$query="INSERT INTO usuario (usuario, contrasena, privilegio, nombre , apellidos , email)
						VALUES (:usuario, :contrasena, :privilegio, :nombre, :apellidos, :email)";
				$nuevoUsuario = $conexion -> prepare($query);
				$nuevoUsuario -> bindParam(':usuario'   , $usuario, PDO::PARAM_STR);
				$nuevoUsuario -> bindParam(':contrasena', $contrasena_cifrada, PDO::PARAM_STR);
				$nuevoUsuario -> bindParam(':privilegio', $privilegio, PDO::PARAM_STR);
				$nuevoUsuario -> bindParam(':nombre'   , $nombre_cifrado, PDO::PARAM_STR);
				$nuevoUsuario -> bindParam(':apellidos', $apellido_cifrado, PDO::PARAM_STR);
				$nuevoUsuario -> bindParam(':email', $correo_cifrado, PDO::PARAM_STR);
				$stmt1= $nuevoUsuario -> execute();
				}
			}
			catch (PDOException $error)
			{
				echo "<script> alert('¡Ha ocurrido un error, intentelo mas tarde!');window.location= 'registro.php' </script>";
				return;
			}
			if($stmt1)
			{
				echo "<script> alert('¡Se ingreso correctamente al usuario!');window.location= 'index.php' </script>";
			}
		}
	 }
}
