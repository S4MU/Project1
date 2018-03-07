<?php
 $host = "localhost";
 $user = "root";
 $pass = "";
 $name = "tomzadb";
 try{
  $conexion = new PDO("mysql:host=$host;dbname=$name",$user,$pass);
  $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $ex)
  {
   	 die($ex->getMessage());
  }
?>
