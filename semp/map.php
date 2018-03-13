<?php
	
	/* Connect To Database*/
	require_once ("config/db2.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
                $q ='';
                $d ='';
                $q= $_GET['q'];//isset($GET['q']) ? $GET['q'] : '';
                $d= $_GET['d'];//isset($GET['d']) ? $GET['d'] : '';
                $desc = $_GET['desc'];
                $sTable = "facturas"; //$sTable = "facturas, clientes, users";
		$sWhere = " WHERE";
	$myArray = array();

		if ( $q != "" and $d != "" and $desc != "")
		{
			// Start XML file, create parent node
			
			if ($desc == "no") $sWhere.= " ruta = '$q' AND fecha LIKE '%$d%'";
			else $sWhere.= " ruta = '$q' AND descuento != '0' AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
				
			
			$query = mysqli_query($con, $sql);
			if (!$query ) {
			  die('Invalid query: ' . mysql_error());
			}
			while ($row=mysqli_fetch_array($query)){
			


    
            		$myArray[] = $row;
 
    
			  /*
			
			  $newnode->set_attribute("name", $row['razon_social']);
			  $newnode->set_attribute("address", $row['fecha']);
			  $newnode->set_attribute("lat", $row['LAT']);
			  $newnode->set_attribute("lng", $row['LONGI']);
			  $newnode->set_attribute("type", "bar");*/
			  
			}
			
		echo json_encode($myArray);
		
		//$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%')";
			
		}else{
		echo "nope".$q.$d."no";
		}
				 
				  


?>