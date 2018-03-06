<?php
	include ('procesar_registro.php');
?>
<hmtl>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="Css.css" >
		<title>Registro de usuario</title>
	</head>
	<body>
		<span><? echo $mensaje; ?></span>
		<form method="post" >
			<div class="container">
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
				<select id="permisos" name="permisos" >
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
				<button type="button" onclick="location.href='login.php'" class="button_cancelar" >Cancelar</button>
			</div>
		</form>
	</body>
</hmtl>
