<hmtl>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="Css.css" >
		<title>Inicio de sesión</title>
	</head>
	<body>
		<? echo $mensaje; ?>
		<form action="procesar_login.php" method="POST" >
			<div class="container">
				<!--Ingreso de usuario-->
				<label for="uname"><b>Nombre de usuario</b></label>
				<input type="text" placeholder="Nombre de usuario" name="usuario" id="usuario" required />

				<!--Ingreso de contraseña-->
				<label for="psw"><b>Contraseña</b></label>
				<input type="password" placeholder="Contraseña" name="contrasena" id="contrasena"  required />

				<!--Boton para inicio de sesion-->
				<button type="submit" name="submit" >Login</button>
				<button type="button">Registrarse</button>

				 <span class="loginMsg"><?php echo @$msg;?></span>
			</div>
		</form>
	</body>
</hmtl>
