<hmtl>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="Css.css" >
		<title>Inicio de sesión</title>
	</head>
	<body>
	<form action="procesar_login.php" method="post" >
			<div class="container">
				<h2 align="center">Ingresar</h2>
				<br>
				<!--Ingreso de usuario-->
				<label for="uname"><b>Nombre de usuario</b></label>
				<input type="text" placeholder="Nombre de usuario" name="usuario" id="usuario" required autofocus />
				<!--Ingreso de contraseña-->
				<label for="psw"><b>Contraseña</b></label>
				<input type="password" placeholder="Contraseña" name="contrasena" id="contrasena"  required />
				<!--Boton para inicio de sesion-->
				<button type="submit" name="submit" class="button_aceptar" >Iniciar Sesión</button>
				<!--Boton para registrarse-->
				<button type="button" onclick="location.href='registro.php'" class="button_aceptar" >Registrarse</button>
				</div>
		</form>
	</body>
</hmtl>
