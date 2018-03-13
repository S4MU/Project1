<?php
	require_once ("config/db2.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

	require('classes/PHPExcel.php');
	require_once "classes/PHPExcel/IOFactory.php";

	PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
                $q ='';
                $d ='';
                $q= $_GET['q'];//isset($GET['q']) ? $GET['q'] : '';
                $d= $_GET['d'];//isset($GET['d']) ? $GET['d'] : '';
                $sTable = "facturas"; //$sTable = "facturas, clientes, users";
		$sWhere = " WHERE";
	$myArray = array();

		if ( $q != "" and $d != "")
		{
			// Start XML file, create parent node
			if ($q == "0"){
			$sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
			OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110' OR ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
			OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59' OR ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504' OR  ruta = '21' OR ruta = '22' OR ruta = '23'OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "1"){
			$sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
			OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110')  AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "11"){
			$sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
			OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "2"){
			$sWhere.= " (ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
			OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59')   AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "3"){
			$sWhere.= " (ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "4"){
			$sWhere.= " (ruta = '21' OR ruta = '22' OR ruta = '23' OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '307') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}
			if ($q == "5"){
			$sWhere.= " (ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fecha LIKE '%$d%'";
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
			}		
			
			$query = mysqli_query($con, $sql);
			if (!$query ) {
			  die('Invalid query: ' . mysql_error());
			}
			$columnHeader ='';
			$columnHeader = "Fecha"."\t"."Codigo Cliente"."\t"."Razon Social"."\t"."Descuento"."\t"."Total Factura"."\t"."Ruta"."\t"."Tipo"."\t"."Q25"."\t"."Q25R"."\t"."Q100R"."\t"."Q20"."\t"."Q20R"."\t"."Q10"."\t"."Q10R"."\t"."Q35R"."\t"."Q45R"."\t"."Q40R"."\t"."Q50R"."\t"."Q60R"."\t";



			while ($row=mysqli_fetch_array($query)){
			


    
            		$myArray[] = $row;
 
    
		
			  
			}
			
		
			$file1=json_encode($myArray);
	$objXLS =new PHPExcel();
	$value=1;
	$array=json_decode($file1);
	$man_val=array();
//set the heading for first time

foreach ($array as $key => $jsons) { 
    foreach($jsons as $key => $value1) {
        array_push($man_val,$key);
    }
    break;
}
$objXLS->getSheet(0)->fromArray($man_val, null, "A".$value);

$man_val=array();
$value=2;
foreach ($array as $key => $jsons) { 
    
    foreach($jsons as $key => $value1) {
        array_push($man_val,$value1);
    }
    $objXLS->getSheet(0)->fromArray($man_val, null, "A".$value);
    $value=$value+1;
    $man_val=array();
}
		
		$fileType = 'Excel2007';
$fileName = $file_name;
$objWriter = PHPExcel_IOFactory::createWriter($objXLS, $fileType);
ob_end_clean();
$objWriter->save("php://output");
exit();
			
		}else{
		echo "nope".$q.$d."no";
		}
				 
				  


?>