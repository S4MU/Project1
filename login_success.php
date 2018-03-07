<?php
 session_start();
 $nombreUsuario= $_SESSION['username'];//VARIABLE DE SESIÓN NOMBRE DE USUARIO

?>
<html lang="es">

<h3>Bienvenido: <?php echo $nombreUsuario ?></h3>

</html>
