<?php
include('function.php');
error_log($_POST["idcliente"]);
if(isset($_POST["idcliente"])){
echo 'Saldo :'.getsaldocliente($_POST["idcliente"]);
//error_log('Saldo:'.getsaldocliente($_POST["idcliente"]));
}