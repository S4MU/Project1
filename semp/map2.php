<?php
	
	/* Connect To Database*/
	require_once ("config/db2.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
                $q ='';
                $d ='';
                $qtoken = '';
                $q= $_GET['q'];//isset($GET['q']) ? $GET['q'] : '';
                $d= $_GET['d'];//isset($GET['d']) ? $GET['d'] : '';
                $sTable = "facturas"; //$sTable = "facturas, clientes, users";
		$sWhere = " WHERE";
	$myArray = array();

		if ( $q != "" and $d != "")
		{
			// Start XML file, create parent node
			if ($q == "0"){
			/*$sWhere.= " (ruta = '200' OR ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
			OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110' OR ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38' 
			OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59' OR ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504' OR  ruta = '21' OR ruta = '22' OR ruta = '23'OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '51' OR ruta = '307' OR ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fecha LIKE '%$d%'";*/
			
		$sWhere.= " (ruta = '200' OR ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
			OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110' OR ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38' 
			OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59' OR ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504' OR  ruta = '21' OR ruta = '22' OR ruta = '23'OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '51' OR ruta = '307' OR ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha "; 
			
			$query = mysqli_query($con, $sql);
			if (!$query ) {
			  die('Invalid query: ' . mysql_error());
			}
			while ($row=mysqli_fetch_array($query)){
			


    
            		$myArray[] = $row;
 
    
		
			  
			}//end while
					
			
			
			
			}//End If
			if ($q == "111"){
			$sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
			OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110' OR ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
			OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59' OR ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504' OR  ruta = '21' OR ruta = '22' OR ruta = '23'OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "222"){
			$sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
			OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110' OR ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
			OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59' OR ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504' OR  ruta = '21' OR ruta = '22' OR ruta = '23'OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fecha LIKE '%$d%'  AND (tipo = '0' OR tipo = '4' OR tipo = '5')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "333"){
			$sWhere.= " (ruta = '3001' OR ruta = '3002' OR ruta = '3003' OR ruta = '3004' OR ruta = '3005' OR ruta = '2001' OR ruta = '2002' OR ruta = '2003' OR ruta = '2004' OR ruta = '5001') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  facturag $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "1"){
			$sWhere.= " (ruta = '200' OR ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
			OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110')  AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "11"){
			$sWhere.= " (ruta = '200' OR ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
			OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110') AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "12"){
			$sWhere.= " (ruta = '200' OR ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
			OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110') AND fecha LIKE '%$d%' AND (tipo = '0' OR tipo = '4' OR tipo = '5')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "13"){
			$sWhere.= " (ruta = '3001' OR ruta = '3002' OR ruta = '3003' OR ruta = '3004') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  facturag $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "2"){
			$sWhere.= " (ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
			OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59')   AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "21"){
			$sWhere.= " (ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
			OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59')   AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "22"){
			$sWhere.= " (ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
			OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59')   AND fecha LIKE '%$d%'  AND (tipo = '0' OR tipo = '4' OR tipo = '5')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "23"){
			$sWhere.= " (ruta = '2001' OR ruta = '2002' OR ruta = '2003' OR ruta = '2004') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  facturag $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "3"){
			$sWhere.= " (ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "31"){
			$sWhere.= " (ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504') AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "32"){
			$sWhere.= " (ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504') AND fecha LIKE '%$d%' AND (tipo = '0' OR tipo = '4' OR tipo = '5')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "4"){
			$sWhere.= " (ruta = '21' OR ruta = '22' OR ruta = '23' OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '307' OR ruta = '51') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "41"){
			$sWhere.= " (ruta = '51') AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "42"){
			$sWhere.= " (ruta = '21' OR ruta = '22' OR ruta = '23' OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '307') AND fecha LIKE '%$d%' AND (tipo = '0' OR tipo = '4' OR tipo = '5')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "43"){
			$sWhere.= " (ruta = '3005') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  facturag $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "5"){
			$sWhere.= " (ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}	
			if ($q == "51"){
			$sWhere.= " (ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}		
			if ($q == "52"){
			$sWhere.= " (ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fecha LIKE '%$d%' AND (tipo = '0' OR tipo = '4' OR tipo = '5')";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "53"){
			$sWhere.= " (ruta = '5001') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  facturag $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if (substr($q, -1) == "R"){
			$qtoken = substr($q, 0, -1);
			$sWhere.= " (ruta = '$qtoken' ) AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC ";  
			}	
			if($q != '0'){
			$query = mysqli_query($con, $sql);
			if (!$query ) {
			  die('Invalid query: ' . mysql_error());
			}
			while ($row=mysqli_fetch_array($query)){
			


    
            		$myArray[] = $row;
 
    
		
			  
			}
			}
			
		echo json_encode($myArray);
		
		//$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%')";
			
		}else{
		echo "nope".$q.$d."no";
		}
				 
				  


?>