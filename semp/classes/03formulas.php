<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
require_once ("../config/db2.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
/** Include PHPExcel */
require_once dirname(__FILE__) . '/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$credito = 0; 
							$total_venta = 0;
							$contado = 0;
							$qq25c  = 0;
							$qq25rc = 0;
							$qq100c = 0;
							$qq20c = 0;
							$qq20rc = 0;
							$qq10c = 0;
							$qq35c = 0;
							$qq35rc = 0;
							$qq45c = 0;
							$qq45rc = 0;
							$qq60c = 0;
							$qq60rc = 0;

							
							$qq25 = 0;
							$qq25r = 0;
							$qq100 = 0;
							$qq20 = 0;
							$qq20r = 0;
							$qq10 = 0;
							$qq35 = 0;
							$qq35r = 0;
							$qq45 = 0;
							$qq45r = 0;
							$qq60 = 0;
							$qq60r = 0;


// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Tomza cr")
							 ->setTitle("Captura General")
							 ->setSubject("Office 2007 ")
							 ->setDescription("Captura general Operacion Costa rica")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



	
	
                $q ='';
                $d ='';
                //$q= $_GET['q'];//isset($GET['q']) ? $GET['q'] : '';
                $d= $_GET['d'];//isset($GET['d']) ? $GET['d'] : '';
                $sTable = "facturas"; //$sTable = "facturas, clientes, users";
		$sWhere = " WHERE";
	$myArray = array();
	$kilos = 0;
	$kilosc = 0;
	$kilost = 0;
	$kilostc = 0;
	$contado = 0;
	
	$contadoP = 0;
	$contadoT = 0;
	$creditoP = 0;
	$creditoT = 0;
	$x = 0;
	
	
	$generalpulperias = 0;
	
	$generalagencias = 0;
	
	$kilos2 = 0;
	$kilosc2 = 0;
	$kilost2 = 0;
	$kilostc2 = 0;
	$contado2 = 0;
	
	$contadoP2 = 0;
	$contadoT2 = 0;
	$creditoP2 = 0;
	$creditoT2 = 0;
	
	

		//if ( $q != "" and $d != "")
		//{
			// Start XML file, create parent node

			/*$rutas = array("1", "2", "3","4","5", "6", "7","8","9", "10", "45","46","58", "106", "107","108","109", "110", "27","28","29", "30", "31","32","33", "34", "38","39","40", "47", "48","59","11", "17", "18","19","20", "504", "21","22","23", "24", "25","26","51","307","12", "13", "14","15","16", "404","600","601","602","603","200");*/
			
			$rutas = array("1", "2", "3","4","5", "6", "7","8","9", "10", "45","46","58", "106", "107","108","109", "110", "27","28","29", "30", "31","32","33", "34", "38","39","40", "47", "48","59","11", "17", "18","19","20", "504", "21","22","23", "24", "25","26","51","307","12", "13", "14","15","16", "404","200","600","601","602","603");
		
			

			foreach($rutas as $ruta) {
			$kilos = 0;
	$kilosc = 0;
	$kilost = 0;
	$kilostc = 0;
	$contado = 0;
	
	$contadoP = 0;
	$contadoT = 0;
	$creditoP = 0;
	$creditoT = 0;
					
							$qq25c  = 0;
							$qq25rc = 0;
							$qq100c = 0;
							$qq20c = 0;
							$qq20rc = 0;
							$qq10c = 0;
							$qq35c = 0;
							$qq35rc = 0;
							$qq45c = 0;
							$qq45rc = 0;
							$qq60c = 0;
							$qq60rc = 0;

							
							$qq25 = 0;
							$qq25r = 0;
							$qq100 = 0;
							$qq20 = 0;
							$qq20r = 0;
							$qq10 = 0;
							$qq35 = 0;
							$qq35r = 0;
							$qq45 = 0;
							$qq45r = 0;
							$qq60 = 0;
							$qq60r = 0;

			$sWhere= " WHERE (ruta = '$ruta') AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')"; //AND (tipo = '0' OR tipo = '4' OR tipo = '5')
			
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
					$query = mysqli_query($con, $sql);
			if (!$query ) {
			  die('Invalid query: ' . mysql_error() . $sWhere);
			}
			while ($row=mysqli_fetch_array($query)){
				if ($row['tipo'] != '100'){
				
						$total_venta=$row['total'];
						$cre = $row['credito']; 
						if ($cre == 1){ 
						$contadoT+= $total_venta;
						 
						$qq25c+=$row['q25'];
						$qq25rc+=$row['q25r'];
						$qq100c+=$row['q100'];
						$qq20c+=$row['q20'];
						$qq20rc+=$row['q20r'];
						$qq10c+=$row['q10r'];
						$qq35c+=$row['q35'];
							$qq35rc+=$row['q35r'];
							$qq45c+=$row['q45'];
							$qq45rc+=$row['q45r'];
							$qq60c+=$row['q60'];
							$qq60rc+=$row['q60r'];

								}else{ 
							$creditoT += $total_venta;
							$qq25+=$row['q25'];
							$qq25r+=$row['q25r'];
							$qq100+=$row['q100'];
							$qq20+=$row['q20'];
							$qq20r+=$row['q20r'];
							$qq10+=$row['q10r'];
							$qq35+=$row['q35'];
							$qq35r+=$row['q35r'];
							$qq45+=$row['q45'];
							$qq45r+=$row['q45r'];
							$qq60+=$row['q60'];
							$qq60r+=$row['q60r'];

							}

					}
							

							

						
				}
				$kilos = $qq25 + $qq25r + ($qq100 * 4) + ($qq20 * 0.8) + ($qq20r * 0.8) + ($qq10 * 0.4) + ($qq35 * 1.2) + ($qq35r * 1.4)
				+ ($qq45r * 1.8) + ($qq45 * 1.6) + ($qq60 * 2) + ($qq60r * 2.4); 
						
						$kilosc = $qq25c + $qq25rc + ($qq100c * 4) + ($qq20c * 0.8) + ($qq20rc * 0.8) + ($qq10c * 0.4) + ($qq35c * 1.2) + ($qq35rc * 1.4) + ($qq45rc * 1.8) + ($qq45c * 1.6) + ($qq60c * 2) + ($qq60rc * 2.4) ; 	
				
				$kilos = $kilos * 11.607;
				$kilosc = $kilosc * 11.607;
				
				
							$qq25c  = 0;
							$qq25rc = 0;
							$qq100c = 0;
							$qq20c = 0;
							$qq20rc = 0;
							$qq10c = 0;
							$qq35c = 0;
							$qq35rc = 0;
							$qq45c = 0;
							$qq45rc = 0;
							$qq60c = 0;
							$qq60rc = 0;

							
							$qq25 = 0;
							$qq25r = 0;
							$qq100 = 0;
							$qq20 = 0;
							$qq20r = 0;
							$qq10 = 0;
							$qq35 = 0;
							$qq35r = 0;
							$qq45 = 0;
							$qq45r = 0;
							$qq60 = 0;
							$qq60r = 0;
				
	$sWhere= " WHERE (ruta = '$ruta') AND fecha LIKE '%$d%' AND (tipo != '1' AND tipo != '2')"; 
			
			$sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC "; 
					$query = mysqli_query($con, $sql);
			if (!$query ) {
			  die('Invalid query: ' . mysql_error() . $sWhere);
			}
			while ($row=mysqli_fetch_array($query)){
				
				if ($row['tipo'] != '100'){
						$total_venta=$row['total'];
						$cre = $row['credito']; 
						if ($cre == 1){ 
						$contadoP+= $total_venta;
						 
							$qq25c+=$row['q25'];
							$qq25rc+=$row['q25r'];
							$qq100c+=$row['q100'];
							$qq20c+=$row['q20'];
							$qq20rc+=$row['q20r'];
							$qq10c+=$row['q10r'];
							$qq35c+=$row['q35'];
							$qq35rc+=$row['q35r'];
							$qq45c+=$row['q45'];
							$qq45rc+=$row['q45r'];
							$qq60c+=$row['q60'];
							$qq60rc+=$row['q60r'];

								}else{ 
							$creditoP += $total_venta;
							$qq25+=$row['q25'];
							$qq25r+=$row['q25r'];
							$qq100+=$row['q100'];
							$qq20+=$row['q20'];
							$qq20r+=$row['q20r'];
							$qq10+=$row['q10r'];
							$qq35+=$row['q35'];
							$qq35r+=$row['q35r'];
							$qq45+=$row['q45'];
							$qq45r+=$row['q45r'];
							$qq60+=$row['q60'];
							$qq60r+=$row['q60r'];

							}


							
						}
							

						
				}
				
			
				$kilost = $qq25 + $qq25r + ($qq100 * 4) + ($qq20 * 0.8) + ($qq20r * 0.8) + ($qq10 * 0.4) + ($qq35 * 1.2) + ($qq35r * 1.4)
				+ ($qq45r * 1.8) + ($qq45 * 1.6) + ($qq60 * 2) + ($qq60r * 2.4) ; 
				
				$kilostc = $qq25c + $qq25rc + ($qq100c * 4) + ($qq20c * 0.8) + ($qq20rc * 0.8) + ($qq10c * 0.4) + ($qq35c * 1.2) + ($qq35rc * 1.4)
				+ ($qq45rc * 1.8) + ($qq45c * 1.6) + ($qq60c * 2) + ($qq60rc * 2.4) ; 	
				
				$kilost = $kilost * 11.607;
				$kilostc = $kilostc * 11.607;	
				$generalpulperias += ($kilost + $kilostc);
				$generalagencias += ($kilos + $kilosc);
							
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setCellValue('A' . (1 +(10*$x)), 'RUTA')->setCellValue('B'.(1 +(10*$x)), $ruta);

$objPHPExcel->getActiveSheet()->setCellValue('A'.(2 +(10*$x)), 'Pulperia Contado Kilos')->setCellValue('B'.(2 +(10*$x)), $kilostc);

$objPHPExcel->getActiveSheet()
            ->setCellValue('A'.(3 +(10*$x)), 'Pulperia Credito Kilos')->setCellValue('B'.(3 +(10*$x)), $kilost)
            ->setCellValue('A'.(4 +(10*$x)), 'Tienda Contado Kilos')->setCellValue('B'.(4 +(10*$x)), $kilosc)
            ->setCellValue('A'.(5 +(10*$x)), 'Tienda Credito Kilos')->setCellValue('B'.(5 +(10*$x)), $kilos)->setCellValue('D'.(5 +(10*$x)), $kilos+$kilostc+$kilost+$kilosc)
            ->setCellValue('A'.(6 +(10*$x)), 'Pulperia Contado Colones ')->setCellValue('B'.(6 +(10*$x)), $contadoP)->setCellValue('E'.(5 +(10*$x)), $generalpulperias + $generalagencias)->setCellValue('F'.(5 +(10*$x)), ($kilos+$kilostc+$kilost+$kilosc)/0.54 )
            ->setCellValue('A'.(7 +(10*$x)), 'Pulperia Credito Colones') ->setCellValue('B'.(7 +(10*$x)), $creditoP)
            ->setCellValue('A'.(8 +(10*$x)), 'Tienda Contado Colones ')->setCellValue('B'.(8 +(10*$x)), $contadoT)
            ->setCellValue('A'.(9 +(10*$x)), 'Tienda Credito Colones ')->setCellValue('B'.(9 +(10*$x)), $creditoT)
            ->setCellValue('A'.(10 +(10*$x)), ' ')->setCellValue('B'.(10 +(10*$x)), '');
            
            
         $kilos2 += $kilos;
	$kilosc2 += $kilosc;
	$kilost2 += $kilost;
	$kilostc2 += $kilostc;
	$contado2 += $contado;
	
	$contadoP2 += $contadoP;
	$contadoT2 += $contadoT;
	$creditoP2 += $creditoP;
	$creditoT2 += $creditoT;
	
            $x++;
//$objPHPExcel->setActiveSheetIndex(0)
            
            
            
            
            
            
           
            
            
            
            
        }
        $rutasg = array("3001","3002","3003","3004","3005","9001","2001","2002","2003","2004","5001","5002","6001","6002");
		
			

			foreach($rutasg as $ruta) {
			$sWhere= " WHERE (ruta = '$ruta') AND fecha like '%$d%'"; //AND (tipo = '0' OR tipo = '4' OR tipo = '5')
			$sql = "SELECT * FROM  facturag $sWhere GROUP BY fecha ORDER BY id ASC "; 
			//error_log(print_r($ruta, TRUE)); 
					$query = mysqli_query($con, $sql);
			if (!$query ) {
			  die('Invalid query: ' . mysql_error() . $sWhere);
			}
			$qlts = 0;
			$qkgs = 0;
			$qmlts = 0;
			$qmkgs = 0;
			$qltsc = 0;
			$qkgsc = 0;
			$qmltsc = 0;
			$qmkgsc = 0;
			while ($row=mysqli_fetch_array($query)){
				
				$canal = '';
				if ($row['credito'] != '0'){
				$qlts += $row['qlts'];
				$qkgs += $row['qkgs'];
				if ($row['qkgs'] != '0'){$qmkgs += $row['total'];}else
				{$qmlts += $row['total'];}
				
				}
				else{
				$qltsc += $row['qlts'];
				$qkgsc += $row['qkgs'];
				if ($row['qkgs'] != '0'){$qmkgsc += $row['total'];}else
				{$qmltsc += $row['total'];}
				
				}
				}
				
				$x++;
				$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setCellValue('A' . (1 +(10*$x)), 'RUTA')->setCellValue('B'.(1 +(10*$x)), $ruta);



$objPHPExcel->getActiveSheet()
            ->setCellValue('A'.(3 +(10*$x)), 'Granel Comercial Contado lts')->setCellValue('B'.(3 +(10*$x)), $qlts) ->setCellValue('C'.(3 +(10*$x)), 'Granel Comercial Credito lts')->setCellValue('D'.(3 +(10*$x)), $qltsc)->setCellValue('E'.(3 +(10*$x)), 'Total LTS')->setCellValue('F'.(3 +(10*$x)), $qltsc + $qlts)
            ->setCellValue('A'.(4 +(10*$x)), 'Gran Granel kilos')->setCellValue('B'.(4 +(10*$x)), $qkgs)->setCellValue('A'.(4 +(10*$x)), 'Gran Granel Credito kilos')->setCellValue('B'.(4 +(10*$x)), $qkgsc)
           
            ->setCellValue('A'.(5 +(10*$x)), 'Total Comercial ')->setCellValue('B'.(5 +(10*$x)), $qmlts)
            ->setCellValue('A'.(6 +(10*$x)), 'Total Gran granel') ->setCellValue('B'.(6 +(10*$x)), $qmkgs)
            ->setCellValue('A'.(8 +(10*$x)), 'Total Comercial Credito ')->setCellValue('B'.(8 +(10*$x)), $qmltsc)
            ->setCellValue('A'.(9 +(10*$x)), 'Total gran granel Credito ')->setCellValue('B'.(9 +(10*$x)), $qmkgsc)
            ;
				
			

	
 			} 
        // Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Liquidacion Rutas');




$objPHPExcel->createSheet();
        
        $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'Ventas Kilos Credito y Contado')
            ->setCellValue('A2', 'Distribuidores Mini Plamta')
            ->setCellValue('A3', 'Planta distribuidores')
            ->setCellValue('A4', 'Planta C.F.')
            ->setCellValue('A5', 'CAMION DISTRIBUIDORES')
            ->setCellValue('A6', 'CAMION PULPERIAS')
            ->setCellValue('A7', 'CAMION CF')
            ->setCellValue('A8', 'VIP CF')
            ->setCellValue('A9', 'AGENCIAS')
            ->setCellValue('A10', 'GRANEL COMERCIAL')
            ->setCellValue('A11', 'GRAN GRANEL')
            ->setCellValue('A12', 'GRANEL PETRO')
            ->setCellValue('A13', 'CARBURACION ESTACIONES')
            ->setCellValue('A14', 'CARBURACION COMERCIAL')
            ->setCellValue('A15', 'Total')
            ->setCellValue('A16', 'Total litros');
            
            $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('B1', '0')
            ->setCellValue('B2', '0')
            ->setCellValue('B3', '0')
            ->setCellValue('B4', '0') 
            ->setCellValue('B5', '0') 
            ->setCellValue('B6', $generalpulperias) //Cam Distri
            ->setCellValue('B7', '0') //Cam Pul
            ->setCellValue('B8', '0') 
            ->setCellValue('B9', $generalagencias) 
            ->setCellValue('B10', '0') //Agen
            ->setCellValue('B11', '0') // granel
            ->setCellValue('B12', '0') //gran granel
            ->setCellValue('B13', '0') 
            ->setCellValue('B14', '0') 
            ->setCellValue('B15', '0') 
            ->setCellValue('B16', '0')
           ->setCellValue('B17', '0'); 
 
                        
            
                    
                    $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A20', 'Pulperia General Contado Kilos')
            ->setCellValue('A21', 'Pulperia General Credito Kilos')
            ->setCellValue('A22', 'Tiendas General Contado Kilos')
            ->setCellValue('A23', 'Tienda General Credito Kilos')
            ->setCellValue('A24', 'Pulperia General Contado')
            ->setCellValue('A25', 'Pulperia General Credito')
            ->setCellValue('A26', 'Tienda General Contado')
            ->setCellValue('A27', 'Tienda General Credito');
            
            $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('B20', $kilostc2)
            ->setCellValue('B21', $kilost2)
            ->setCellValue('B22', $kilosc2)
            ->setCellValue('B23', $kilos2) 
            ->setCellValue('B24', $contadoP2) 
            ->setCellValue('B25', $creditoP2) //Cam Distri
            ->setCellValue('B26', $contadoT2) //Cam Pul
            ->setCellValue('B27', $creditoT2); 
            
            
$objPHPExcel->getActiveSheet()->setTitle('Captura General');
        
            
/*
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Ventas Kilos Credito y Contado')
            ->setCellValue('A2', 'Distribuidores Mini Plamta')
            ->setCellValue('A3', 'Planta distribuidores')
            ->setCellValue('A4', 'Planta C.F.')
            ->setCellValue('A5', 'CAMION DISTRIBUIDORES')
            ->setCellValue('A6', 'CAMION PULPERIAS')
            ->setCellValue('A7', 'CAMION CF')
            ->setCellValue('A8', 'VIP CF')
            ->setCellValue('A9', 'AGENCIAS')
            ->setCellValue('A10', 'GRANEL COMERCIAL')
            ->setCellValue('A11', 'GRAN GRANEL')
            ->setCellValue('A12', 'GRANEL PETRO')
            ->setCellValue('A13', 'CARBURACION ESTACIONES')
            ->setCellValue('A14', 'CARBURACION COMERCIAL')
            ->setCellValue('A15', 'Total')
            ->setCellValue('A16', 'Total litros');

// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B2', '0')
            ->setCellValue('B3', '0')
            ->setCellValue('B4', '0') 
            ->setCellValue('B5', '0') 
            ->setCellValue('B6', '0') //Cam Distri
            ->setCellValue('B7', $kilos) //Cam Pul
            ->setCellValue('B8', $kilosc) 
            ->setCellValue('B9', $kilost) 
            ->setCellValue('B10', $kilostc) //Agen
            ->setCellValue('B11', '0') // granel
            ->setCellValue('B12', '0') //gran granel
            ->setCellValue('B13', '0') 
            ->setCellValue('B14', '0') 
            ->setCellValue('B15', '0') 
            ->setCellValue('B16', '0')
           ->setCellValue('B17', '0'); 
*/



// Redirect output to a clientâ€™s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
