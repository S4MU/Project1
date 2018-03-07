<hmtl>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="Css.css" >
		<title>Registro de usuario</title>
	</head>
	<body>
		<form action="procesar_registro.php" method="post" >
			<div class="container">
				<h3 align="center">Registro de nuevo usuario</h3>
				<br>
				<!--Registro de nombre-->
				<label for="uname"><b>Nombre</b></label>
				<input type="text" placeholder="Nombre" name="registro_nombre" id="registro_nombre" required autofocus />

				<!--Registro de apellidos-->
				<label for="uname"><b>Apellidos</b></label>
				<input type="text" placeholder="Apellidos" name="registro_apellidos" id="registro_apellidos" required />

				<!--Registro de correo-->
				<label for="uname"><b>Correo electronico</b></label>
				<input type="text" placeholder="Correo electronico" name="registro_correo" id="registro_correo" required  />

				<!--Registro de usuario-->
				<label for="uname"><b>Nombre de usuario</b></label>
				<input type="text" placeholder="Nombre de usuario" name="registro_usuario" id="registro_usuario" required />

				<!--Registro de contraseña-->
				<label for="psw"><b>Contraseña</b></label>
				<input type="password" placeholder="Contraseña" name="registro_contrasena" id="registro_contrasena"  required />

				<!--Registro de contraseña nuevamente-->
				<label for="psw"><b>Confirmar Contraseña</b></label>
				<input type="password" placeholder="Confirmar Contraseña" name="confirmar_contrasena" id="confirmar_contrasena"  required />

				<!--Registro del privilegio-->
				<label for="psw"><b>Tipo de permiso</b></label>
				<select id="permisos" name="permisos" required >
				   <option value="0">Seleccione permiso</option>
				   <option value="1">1</option>
				   <option value="2">2</option>
				   <option value="3">3</option>
				   <option value="4">4</option>
				   <option value="5">5</option>
				   <option value="6">6</option>
				   <option value="7">7</option>
				   <option value="8">8</option>
				   <option value="9">9</option>
				   <option value="10">10</option>
				</select>

				<!--Boton para inicio de sesion-->
				<button type="submit" name="registrarse" class="button_aceptar" >Registrarse</button>
				<!--Boton para cancelar el registro y volver a inicio de sesion-->
				<button type="button" onclick="location.href='index.php'" class="button_cancelar" >Cancelar</button>
			</div>
		</form>
	</body>
</hmtl>
