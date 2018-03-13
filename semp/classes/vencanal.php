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
	$y = 0;
	
	
	$generalpulperias = 0;
	
	$generalagencias = 0;
	$generalpulperiasc = 0;
	
	$generalagenciasc = 0;
	$litroscredito = 0;
	$litroscontado = 0;
	$kiloscontado = 0;
	$kiloscredito = 0;
	$totalgcontado = 0;
	$totalgcredito = 0;
	$descgcontado = 0;
	$descgcredito= 0;
	$generalhnos = 0;
	$generalhnosc = 0;
	$generalpub = 0;
	$generaldist = 0;
	$generaldistc = 0;
	$generaltiendas = 0;
	$generaltiendasc = 0;
	$generalcontadolitros = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,8,9,10);
	$generalcontadoneto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	$generalcontadodesc = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	$generalcontadobruto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	$generalcreditolitros = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	$generalcreditoneto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	$generalcreditodesc = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	$generalcreditobruto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	
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

			$rutas = array("1", "2", "3","4","5", "6", "7","8","9", "10", "45","46","58", "106", "107","108","109", "110", "27","28","29", "30", "31","32","33", "34", "38","39","40", "47", "48","59","11", "17", "18","19","20", "504", "21","22","23", "24", "25","26","51","307","12", "13", "14","15","16", "404","600","601","602","603","200");
		
			

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
				$generalpulperias += $kilost; //Pulperias Credito
				$generalagencias += $kilos ; //Tienda Credito
				$generalpulperiasc += $kilostc;//Pulperias Contado
				$generalagenciasc += $kilosc;// Tienda Contado
	
	
				if($ruta == 602){
				$generaldist += $kilostc;
				$generaldistc += $kilost;
				$generalcontadolitros[4] += $kilostc;
				$generalcreditolitros[4] += $kilost;
				$generalcontadoneto[4] += $contadoP;

				$generalcreditoneto[4] += $creditoP;

				}
				if($ruta == 601){
				$generalpub += $kilostc;
				$generalcontadolitros[2] += $kilostc;
				$generalcreditolitros[2] += $kilost;
				$generalcontadoneto[2] += $contadoP;

				$generalcreditoneto[2] += $creditoP;
				}
				if($ruta == 603){
				$generaldist += $kilostc;
				$generaldistc += $kilost;
				$generalcontadolitros[14] += $kilostc;
				$generalcreditolitros[14] += $kilost;
				$generalcontadoneto[14] += $contadoP;

				$generalcreditoneto[14] += $creditoP;

				}
				if($ruta == 600){
				$generalpub += $kilostc;
				$generalcontadolitros[11] += $kilostc;
				$generalcreditolitros[11] += $kilost;
				$generalcontadoneto[11] += $contadoP;

				$generalcreditoneto[11] += $creditoP;
				}
				
				if($ruta == 1 || $ruta == 2 || $ruta == 3 || $ruta == 4 || $ruta == 5 || $ruta == 6 || $ruta == 7 || $ruta == 8 || $ruta ==9 || $ruta == 10 || $ruta == 45 || $ruta == 46 || $ruta ==58 || $ruta == 106 || $ruta == 107 || $ruta == 108 || $ruta ==109 || $ruta ==110 ){
				//Cartago
				$generalhnos += $kilostc;
				$generalhnosc += $kilost;
				$generalcontadolitros[1] += $kilostc;
				$generalcreditolitros[1] += $kilost;
				
				
				$generaltiendas += $kilosc;
				$generaltiendasc += $kilos;
				$generalcontadolitros[8] += $kilosc;
				$generalcreditolitros[8] += $kilos;
					/*$generalcontadoneto[1] += $contadoP;
				$generalcontadodesc[1];
				$generalcontadobruto[1] ;
				$generalcreditoneto[1] += $creditoP;
				$generalcreditodesc[1] ;
				$generalcreditobruto[1];*/
				
				$generalcontadoneto[1] += $contadoP;

				$generalcreditoneto[1] += $creditoP;
				
				$generalcontadoneto[8] += $contadoT;

				$generalcreditoneto[8] += $creditoT;
				

			

				}
				if($ruta == 27 || $ruta == 28 || $ruta == 29 || $ruta == 30 || $ruta == 31 || $ruta == 32 || $ruta == 33 || $ruta == 34 || $ruta ==38 || $ruta == 39 || $ruta == 40 || $ruta == 47 || $ruta ==48 || $ruta == 59 ){
				//Cartago
			
				$generalcontadolitros[13] += $kilostc;
				$generalcreditolitros[13] += $kilost;
				
				
				
				$generalcontadolitros[18] += $kilosc;
				$generalcreditolitros[18] += $kilos;
				
				
				$generalcontadoneto[13] += $contadoP;

				$generalcreditoneto[13] += $creditoP;
				
				$generalcontadoneto[18] += $contadoT;

				$generalcreditoneto[18] += $creditoT;
				

			

				}
				if($ruta == 404 || $ruta == 12 || $ruta == 13 || $ruta == 14 || $ruta == 15 || $ruta == 16){
				//La Cruz
			
				$generalcontadolitros[19] += $kilostc;
				$generalcreditolitros[19] += $kilost;
				
				
				
				$generalcontadolitros[22] += $kilosc;
				$generalcreditolitros[22] += $kilos;
				$generalcontadoneto[22] += $contadoT;

				$generalcreditoneto[22] += $creditoT;
				
				
				$generalcontadoneto[19] += $contadoP;

				$generalcreditoneto[19] += $creditoP;
				

				

			

				}
				if($ruta == 504 || $ruta == 11 || $ruta == 17 || $ruta == 18 || $ruta == 19 || $ruta == 20){
				$generalcontadolitros[23] += $kilostc;
				$generalcreditolitros[23] += $kilost;
				
				
				
				$generalcontadolitros[24] += $kilosc;
				$generalcreditolitros[24] += $kilos;
				$generalcontadoneto[24] += $contadoT;

				$generalcreditoneto[24] += $creditoT;
				
				
				$generalcontadoneto[23] += $contadoP;

				$generalcreditoneto[23] += $creditoP;
				

				

			

				}
				if($ruta == 307 || $ruta == 51 || $ruta == 21 || $ruta == 22 || $ruta == 23 || $ruta == 24 || $ruta == 25 || $ruta == 26 ){
				//Perez
				$generalcontadolitros[25] += $kilostc;
				$generalcreditolitros[25] += $kilost;
				
				
				$y += $kilosc;
				$generalcontadolitros[28] += $kilosc;
				$generalcreditolitros[28] += $kilos;
				$generalcontadoneto[28] += $contadoT;

				$generalcreditoneto[28] += $creditoT;
				
				
				
				$generalcontadoneto[25] += $contadoP;

				$generalcreditoneto[25] += $creditoP;
				

				

			

				}

				
				
					//Total por ruta		
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
            
            
            
            
            
            
           
            
            
            
            
        } // For each rutas cilindros
        
        $rutasg = array("3001","3002","3003","3004","3005","9001","2001","2002","2003","2004","5001");
		
			

			foreach($rutasg as $ruta) {
			$sWhere= " WHERE (ruta = '$ruta') AND fecha LIKE '%$d%'"; //AND (tipo = '0' OR tipo = '4' OR tipo = '5')
			
			$sql = "SELECT * FROM  facturag $sWhere GROUP BY fecha ORDER BY id ASC "; 
				$litroscredito = 0;
				$litroscontado = 0;
				$kiloscontado = 0;
				$kiloscredito = 0;
				$totalgcontado = 0;
				$totalgcredito = 0;
				$descgcontado = 0;
				$descgcredito= 0;
					$query = mysqli_query($con, $sql);
			if (!$query ) {
			  die('Invalid query: ' . mysql_error() . $sWhere);
			}
			while ($row=mysqli_fetch_array($query)){
			if($row['credito'] == '0'){
				$litroscredito += $row['qlts'];
				$kiloscredito += ($row['qkgs'] / 0.54);
					
				$totalgcredito += $row['total'];
				
				$descgcredito += $row['descuento'] ;
			}else{
				$litroscontado += $row['qlts'];
				$kiloscontado += ($row['qkgs'] / 0.54);
				$descgcontado+= $row['descuento'] ;
				$totalgcontado += $row['total'];
			}
				
				
				
			}//end actual ruta
			if($ruta == 3001 || $ruta == 3002 || $ruta == 3003 || $ruta == 3004 || $ruta == 9001 ){
				$generalcontadolitros[5] += $litroscontado + $kiloscontado;
				$generalcreditolitros[5] += $litroscredito + $kiloscredito;
				$generalcontadoneto[5] += $totalgcontado;

				$generalcreditoneto[5] += $totalgcredito;
				}
				if($ruta == 2001 || $ruta == 2002 || $ruta == 2003 || $ruta == 2004 ){
				$generalcontadolitros[15] += $litroscontado + $kiloscontado;
				$generalcreditolitros[15] += $litroscredito + $kiloscredito;
				$generalcontadoneto[15] += $totalgcontado;

				$generalcreditoneto[15] += $totalgcredito;
				}
				if($ruta == 5001 || $ruta == 5002 ){
				$generalcontadolitros[21] += $litroscontado + $kiloscontado;
				$generalcreditolitros[21] += $litroscredito + $kiloscredito;
				$generalcontadoneto[21] += $totalgcontado;

				$generalcreditoneto[21] += $totalgcredito;
				}
				if($ruta == 3005 ){
				$generalcontadolitros[26] += $litroscontado + $kiloscontado;
				$generalcreditolitros[26] += $litroscredito + $kiloscredito;
				$generalcontadoneto[26] += $totalgcontado;

				$generalcreditoneto[26] += $totalgcredito;
				}
				
			
			}//end for each granel
        
        // Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Liquidacion Rutas');




$objPHPExcel->createSheet();
        
        $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'RESUMEN DE VENTA')->setCellValue('B1', 'LITROS')->setCellValue('C1', 'BRUTO')->setCellValue('D1', 'DESCUENTO')
            ->setCellValue('E1', 'MONTO NETO')->setCellValue('F1', 'LITROS')->setCellValue('G1', 'BRUTO')->setCellValue('H1', 'DESCUENTO')
            ->setCellValue('I1', 'MONTO NETO')
            ->setCellValue('A2', 'GAS TOMZA HINOS')
            ->setCellValue('A3', 'GAS TOMZA PLANTA PUBLICO')
            ->setCellValue('A4', 'GAS TOMZA PLANTA DISTRIBUIDORES')
            ->setCellValue('A5', 'GAS TOMZA DISTRIBUIDORES')
            ->setCellValue('A6', 'GAS TOMZA GRANEL')
            ->setCellValue('A7', 'GAS TOMZA PETROGAS')
            ->setCellValue('A8', 'GAS TOMZA GRAN GRANEL')
            ->setCellValue('A9', 'GAS TOMZA TIENDAS')
            ->setCellValue('A10', 'GAS TOMZA CARBURACION')
            ->setCellValue('A11', 'GAS TOMZA CAMION CF')
            ->setCellValue('A12', 'SUPER GAS PLANTA PUBLICO')
            ->setCellValue('A13', 'SUPER GAS PLANTA DISTRIBUIDORES')
            ->setCellValue('A14', 'SUPER GAS HINOS')
            ->setCellValue('A15', 'SUPER GAS CAMION DISTRIBUIDORES')
            ->setCellValue('A16', 'SUPER GAS GRANEL')
            ->setCellValue('A17', 'SUPER GAS GRANEL PETROGAS')
            ->setCellValue('A18', 'SUPER GAS GRAN GRANEL')
            ->setCellValue('A19', 'SUPER GAS TIENDAS')
            ->setCellValue('A20', 'LA CRUZ HINOS')
            ->setCellValue('A21', 'LA CRUZ DISTRIBUIDORES')
            ->setCellValue('A22', 'LA CRUZ GRANEL')
            ->setCellValue('A23', 'LA CRUZ TIENDAS') 
            ->setCellValue('A24', 'CEDI ATLANTICO')
            ->setCellValue('A25', 'CEDI ATLANTICO TIENDAS')  
            ->setCellValue('A26', 'CEDI ZONA SUR HINOS')
            ->setCellValue('A27', 'CEDI ZONA SUR GRANEL')
            ->setCellValue('A28', 'ZONA SUR CARBURACION')
            ->setCellValue('A29', 'CEDI ZONA SUR TIENDAS')
             ->setCellValue('A30', 'TOTAL:');
             
            			/*	$generalpulperias += $kilost; //Pulperias Contado
				$generalagencias += $kilos ; //Tienda Credito
				$generalpulperiasc += $kilostc;//Pulperias Credito
				$generalagenciasc += $kilosc;// Tienda Contado*/
				
			
							/*$generalcontadoneto[1] += $contadoP;
				$generalcontadodesc[1];
				$generalcontadobruto[1] ;
				$generalcreditoneto[1] += $creditoP;
				$generalcreditodesc[1] ;
				$generalcreditobruto[1];*/
            
            $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('B2',  $generalcontadolitros[1]/0.54)->setCellValue('E2', $generalcontadoneto[1])->setCellValue('F2', $generalcreditolitros[1]/0.54)->setCellValue('I2', $generalcreditoneto[1])  // General pulperias
            ->setCellValue('B3', $generalcontadolitros[2]/0.54)->setCellValue('E3', $generalcontadoneto[2])->setCellValue('F3', $generalcreditolitros[2]/0.54)->setCellValue('I3', $generalcreditoneto[3])
            ->setCellValue('B4', '0')
            ->setCellValue('B5', $generalcontadolitros[4]/0.54)->setCellValue('E5', $generalcontadoneto[4])->setCellValue('F5', $generalcreditolitros[4]/0.54)->setCellValue('I5', $generalcreditoneto[4])         
            ->setCellValue('B6', $generalcontadolitros[5]/0.54)->setCellValue('E6', $generalcontadoneto[5])->setCellValue('F6', $generalcreditolitros[5])->setCellValue('I6', $generalcreditoneto[5])
            ->setCellValue('B7', '0')
            ->setCellValue('B8', '0')        
            ->setCellValue('B9', $generalcontadolitros[8]/0.54 )->setCellValue('E9', $generalcontadoneto[8])->setCellValue('F9', $generalcreditolitros[8] /0.54)->setCellValue('I9', $generalcreditoneto[8])   //Tienda Cartago
           
            ->setCellValue('B10', '0') 
            ->setCellValue('B11', '0') //Agen
            ->setCellValue('B12', '0')->setCellValue('B12', $generalcontadolitros[11]/0.54 )->setCellValue('E12', $generalcontadoneto[11])->setCellValue('F12', $generalcreditolitros[11] /0.54)->setCellValue('I12', $generalcreditoneto[11])
            ->setCellValue('B13', '0') //gran granel
            ->setCellValue('B14', '0')->setCellValue('B14', $generalcontadolitros[13]/0.54 )->setCellValue('E14', $generalcontadoneto[13])->setCellValue('F14', $generalcreditolitros[13] /0.54)->setCellValue('I14', $generalcreditoneto[13]) 
            
            ->setCellValue('B15', '0')->setCellValue('B15', $generalcontadolitros[14]/0.54 )->setCellValue('E15', $generalcontadoneto[14])->setCellValue('F15', $generalcreditolitros[14] /0.54)->setCellValue('I15', $generalcreditoneto[14])
            ->setCellValue('B16', '0')->setCellValue('B16', $generalcontadolitros[15] )->setCellValue('E16', $generalcontadoneto[15])->setCellValue('F16', $generalcreditolitros[15] )->setCellValue('I16', $generalcreditoneto[15])
            ->setCellValue('B19', '0')->setCellValue('B19', $generalcontadolitros[18]/0.54 )->setCellValue('E19', $generalcontadoneto[18])->setCellValue('F19', $generalcreditolitros[18] /0.54)->setCellValue('I19', $generalcreditoneto[18])
            ->setCellValue('B20', '0')->setCellValue('B20', $generalcontadolitros[19]/0.54 )->setCellValue('E20', $generalcontadoneto[19])->setCellValue('F20', $generalcreditolitros[19] /0.54)->setCellValue('I20', $generalcreditoneto[19])
            ->setCellValue('B22', '0')->setCellValue('B22', $generalcontadolitros[21] )->setCellValue('E22', $generalcontadoneto[21])->setCellValue('F22', $generalcreditolitros[21] )->setCellValue('I22', $generalcreditoneto[21])
            
            ->setCellValue('B23', '0')->setCellValue('B23', $generalcontadolitros[22]/0.54 )->setCellValue('E23', $generalcontadoneto[22])->setCellValue('F23', $generalcreditolitros[22]/0.54 )->setCellValue('I23', $generalcreditoneto[22])

             ->setCellValue('B24', '0')->setCellValue('B24', $generalcontadolitros[23]/0.54 )->setCellValue('E24', $generalcontadoneto[23])->setCellValue('F24', $generalcreditolitros[23] /0.54)->setCellValue('I24', $generalcreditoneto[23])
             ->setCellValue('B25', '0')->setCellValue('B25', $generalcontadolitros[24]/0.54 )->setCellValue('E25', $generalcontadoneto[24])->setCellValue('F25', $generalcreditolitros[24] /0.54)->setCellValue('I25', $generalcreditoneto[24])
             
             ->setCellValue('B29', $generalcontadolitros[28]/0.54)->setCellValue('E29', $generalcontadoneto[28]) // TIENDAS CEDI SUR

              ->setCellValue('B26', '0')->setCellValue('B26', $generalcontadolitros[25]/0.54 )->setCellValue('E26', $generalcontadoneto[25])->setCellValue('F26', $generalcreditolitros[25] /0.54)->setCellValue('I26', $generalcreditoneto[25])
             ->setCellValue('B27', '0')->setCellValue('B27', $generalcontadolitros[26] )->setCellValue('E27', $generalcontadoneto[26])->setCellValue('F27', $generalcreditolitros[26] )->setCellValue('I27', $generalcreditoneto[26])
             
 
              ->setCellValue('B30', '0');          
            
                /*    2539
                    $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A20', 'Pulperia General Contado Kilos')
            ->setCellValue('A21', 'Pulperia General Credito Kilos')
            ->setCellValue('A22', 'Tiendas General Contado Kilos')
            ->setCellValue('A23', 'Tienda General Credito Kilos')
            ->setCellValue('A24', 'Pulperia General Contado')
            ->setCellValue('A25', 'Pulperia General Credito')
            ->setCellValue('A26', 'Tienda General Contado')
            ->setCellValue('A27', 'Tienda General Credito');*/
            
           
            
            
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
header('Content-Disposition: attachment;filename="resumenxcanalxunegocio.xlsx"');
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
