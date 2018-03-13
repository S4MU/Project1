<?php
/*Dentro de config esta la conexion*/
require_once ("config/db3.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
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
		$sql1="SELECT * FROM usuario where usuario='$usuario'";
		$query1= mysqli_query($con, $sql1);
		$rowcount1=mysqli_num_rows($query1);
		if($rowcount1 > 0)
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
				$sql2="SELECT * FROM usuario where email='$correo_cifrado'";
				$query2= mysqli_query($con, $sql2);
				$rowcount2=mysqli_num_rows($query2);
				if ($rowcount2 > 0)
				{
					echo "<script> alert('¡El correo electronico ya está en uso, ingrese uno nuevo!');window.location= 'registro.php' </script>";
					return;
				}
				else
				{
				/*Realizo el insert de los datos del usuario en la BD*/
				$sql3=$con->prepare("INSERT INTO usuario (usuario, contrasena, privilegio, nombre , apellidos , email) VALUES (?,?,?,?,?,?)");
				/*La 's' indican la cantidad de variables que le voy a pasar al insert*/
				$sql3->bind_param('ssssss',$usuario, $contrasena_cifrada, $privilegio, $nombre_cifrado, $apellido_cifrado, $correo_cifrado);
				$sql3->execute();
				}
			}
			catch (mysqli_sql_exception $error)
			{
				echo "<script> alert('¡Ha ocurrido un error, intentelo mas tarde!');window.location= 'registro.php' </script>";
				return;
			}
			if($sql3)
			{
				echo "<script> alert('¡Se ingreso correctamente al usuario!');window.location= 'index.php' </script>";
			}
		}
	 }
}
else {
	header("location: index.php");
}
?>
