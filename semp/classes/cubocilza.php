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
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/PHPExcel.php';
require '../PHPivot.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
require_once ("../config/db2.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
$ArrayGeneral = array();
$credito = 0;
$ruta = 0; 
$canal = 0;
      $generalcontadolitros = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcontadoneto =   array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcontadodesc =   array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcontadobruto =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditolitros = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditoneto =   array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditodesc =   array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditobruto =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      
      $generalq25 =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq10 =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq20 =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq30 =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq35 =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq40 =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq45 =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq50 =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq60 =  array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq100 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $index = 0;
       function AddtoArray($pos,$code, $value,$credito) {
       if ($credito == 0){
       if($pos == 0) {$generalcontadolitros[$code] += $value;}
      if($pos == 1) {$generalcontadoneto[$code] += $value;}
      if($pos == 2) {$generalcontadodesc[$code] += $value;}
      if($pos == 3) {$generalcontadobruto[$code] += $value;}
      }else{
      if($pos == 4) {$generalcreditolitros[$code] += $value;}
      if($pos == 5) {$generalcreditoneto[$code] += $value;}
      if($pos == 6) {$generalcreditodesc[$code] += $value;}
      if($pos == 7) {$generalcreditobruto[$code] += $value;}
      }
      
           
            return $code;
         }


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

$x = 1;//excel comienza en fila 1
// Set document properties
$objPHPExcel->getProperties()->setCreator("Sistema Tomza CR")
                             ->setLastModifiedBy("Tomza cr")
                             ->setTitle("Captura General")
                             ->setSubject("Office 2007 ")
                             ->setDescription("Reporte CUBO Costa rica")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Test result file");

$kilos = 0;

    $sql = 'NO CARGO NADA';
    
                //$q =$_GET['q'];
    $q = ''; $dd = ''; $d = ''; $cod = '';
                $dd =$_GET['dd']; 
                $cod = $_GET['cod'];
                
                $q= $_GET['q'];//isset($GET['q']) ? $GET['q'] : '';
                $d= $_GET['d'];//isset($GET['d']) ? $GET['d'] : '';
                $sTable = "facturas"; //$sTable = "facturas, clientes, users";
        $sWhere = " WHERE";
   
            $sTable = "facturas"; //$sTable = "facturas, clientes, users";
        $sWhere = " WHERE";
    $myArray = array();
    if ($q == "991"){
        $sWhere.= " (ruta = '$cod')  AND fechadt BETWEEN  '$d' AND '$dd' ";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
       }
       if ($q == "999"){
        $sWhere.= " (codigo = '$cod')  AND fechadt BETWEEN  '$d' AND '$dd' ";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
       }
              if ($q == "998"){
        $sWhere.= " (nombre= '$cod')  AND fechadt BETWEEN  '$d' AND '$dd' ";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
       }
              if ($q == "997" || $q == "996" || $q == "995" || $q == "994"){
        $sWhere.= " fechadt BETWEEN  '$d' AND '$dd' ";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
       }
   
                     if ($q == "993"){
        $sWhere.= " (total <= '$cod')  AND fechadt BETWEEN  '$d' AND '$dd' ";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
       }
                     if ($q == "992"){
        $sWhere.= " (total >= '$cod')  AND fechadt BETWEEN  '$d' AND '$dd' ";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
       }
            // Start XML file, create parent node
            if ($q == "0"){
            $sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
            OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110' OR ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
            OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59' OR ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504' OR  ruta = '21' OR ruta = '22' OR ruta = '23'OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404' OR ruta = '200' OR ruta = '600' OR ruta = '601' OR ruta = '602' OR ruta = '603') AND  fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "111"){
            $sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
            OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110' OR ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
            OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59' OR ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504' OR  ruta = '21' OR ruta = '22' OR ruta = '23'OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND (tipo = '1' OR tipo = '2') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "222"){
            $sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
            OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110' OR ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
            OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59' OR ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504' OR  ruta = '21' OR ruta = '22' OR ruta = '23'OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND (tipo = '0' OR tipo = '4' OR tipo = '5') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "333"){
            $sWhere.= " (ruta = '3001' OR ruta = '3002' OR ruta = '3003' OR ruta = '3004' OR ruta = '3005' OR ruta = '2001' OR ruta = '2002' OR ruta = '2003' OR ruta = '2004' OR ruta = '5001') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  facturag $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "1"){
            $sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
            OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110')  AND fechadt BETWEEN  '$d' AND '$dd' ";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "11"){
            $sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
            OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110')  AND (tipo = '1' OR tipo = '2') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "12"){
            $sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
            OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110')  AND (tipo = '0' OR tipo = '4' OR tipo = '5') AND (fechadt BETWEEN  '$d' AND '$dd')";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "13"){
            $sWhere.= " (ruta = '3001' OR ruta = '3002' OR ruta = '3003' OR ruta = '3004') AND fechadt BETWEEN  '$d' AND '$dd' ";
            $sql = "SELECT * FROM  facturag $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "2"){
            $sWhere.= " (ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
            OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59')   AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "21"){
            $sWhere.= " (ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
            OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59') AND (tipo = '1' OR tipo = '2') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "22"){
            $sWhere.= " (ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
            OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59')  AND (tipo = '0' OR tipo = '4' OR tipo = '5') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "23"){
            $sWhere.= " (ruta = '2001' OR ruta = '2002' OR ruta = '2003' OR ruta = '2004') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  facturag $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "3"){
            $sWhere.= " (ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
                        if ($q == "31"){
            $sWhere.= " (ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504') AND (tipo = '1' OR tipo = '2') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
                        if ($q == "32"){
            $sWhere.= " (ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504') AND (tipo = '0' OR tipo = '4' OR tipo = '5') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "4"){
            $sWhere.= " (ruta = '21' OR ruta = '22' OR ruta = '23' OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '307') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
                        if ($q == "41"){
            $sWhere.= " (ruta = '21' OR ruta = '22' OR ruta = '23' OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '307') AND (tipo = '1' OR tipo = '2') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
                        if ($q == "42"){
            $sWhere.= " (ruta = '21' OR ruta = '22' OR ruta = '23' OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '307') AND (tipo = '0' OR tipo = '4' OR tipo = '5') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "43"){
            $sWhere.= " (ruta = '3005') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  facturag $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "5"){
            $sWhere.= " (ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }   
                        if ($q == "51"){
            $sWhere.= " (ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND (tipo = '1' OR tipo = '2') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }       
                        if ($q == "52"){
            $sWhere.= " (ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND (tipo = '0' OR tipo = '4' OR tipo = '5') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            if ($q == "53"){
            $sWhere.= " (ruta = '5001') AND fechadt BETWEEN  '$d' AND '$dd'";
            $sql = "SELECT * FROM  facturag $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }   
             if ($q != "0" && $q != "1" && $q != "2" && $q != "3" && $q != "4" && $q != "5" ){
              
            $query = mysqli_query($con, $sql);
            if (!$query ) {
              die('Invalid query: ' . mysql_error(). $q.$d.$dd . '  '.$sql );
           
            }
             $objPHPExcel->setActiveSheetIndex(0);
            
            
            
            

$objPHPExcel->getActiveSheet()->setCellValue('A1' , 'FECHA')->setCellValue('B1', 'DOCUMENTO')->setCellValue('C1', 'CODIGO CLIENTE')->setCellValue('D1', 'NOMBRE CLIENTE')->setCellValue('E1', 'RAZON SOCIAL')->setCellValue('F1', 'T. COLONES')->setCellValue('G1', 'T KILOS')->setCellValue('H1', 'SUB CANAL')->setCellValue('I1', 'RUTA')->setCellValue('J1', 'SUBTOTAL')->setCellValue('K1', 'DESCUENTO UNITARIO')->setCellValue('L1', 'U. CILINDROS')->setCellValue('M1', 'DESCUENTO')->setCellValue('N1', 'COORDENADA')->setCellValue('O1', 'Presion 25')->setCellValue('P1', 'Rosca 25')->setCellValue('Q1', 'Rosca 100')->setCellValue('R1', 'Presion 20')->setCellValue('S1', 'Rosca 20')->setCellValue('T1', '35 Rosca')->setCellValue('U1', '45 Rosca')->setCellValue('V1', '10 ROSCA')->setCellValue('W1', '30 ROSCA')->setCellValue('X1', '50 ROSCA')->setCellValue('Y1', '60 ROSCA')->setCellValue('Z1', 'CREDITO')->setCellValue('AA1', 'Resumen de venta')->setCellValue('AB1', 'Total Litros')->setCellValue('AC1', '40 Rosca');
for($col = 'A'; $col !== 'AB'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
$rowtipo = ''; 
            while ($row=mysqli_fetch_array($query)){
                              $canal = '';
            $kilos = $row['cz25'] + $row['cz25r'] + ($row['cz100r'] * 4) ;
                
            if ($q == "997" ){ if(($kilos*$row['descuento']) < $cod) continue; }
            if ($q == "996" ){ if(($kilos*$row['descuento']) > $cod) continue; }
            if ($q == "995" ){ if(($kilos*11.607) < $cod) continue; }
            if ($q == "994" ){ if(($kilos*11.607) > $cod) continue; }
            $rowtipo = $row['cz25'];
            
           // if ($row['tipo'] == '0') $rowtipo = 'PULPERIA';
            if ($row['tipo'] == '1') $rowtipo = 'TIENDA VARIABLE';
            if ($row['tipo'] == '2') $rowtipo = 'TIENDA FIJO';
            if ($row['tipo'] == '4') $rowtipo = 'SUPERMERCADO';
            if ($row['tipo'] == '5') $rowtipo = 'INDUSTRIAL';
            if ($row['tipo'] == '100') $rowtipo = 'CILZA';
            
            $x++;
               $ruta = $row['ruta']; 
               $credito= 'Credito';
               if($row['credito']==1)
               { $credito= 'Contado';}
               //$credito = ($row['ruta']==1?'Contado':'Credito')
                     if ($ruta == 601){ $canal = 'GAS TOMZA PLANTA PUBLICO';}
                     if ($ruta == 200) {$canal = 'GAS TOMZA CAMION CF';}
                      if ($ruta == 602){ $canal = 'GAS TOMZA DISTRIBUIDORES';}
  if($ruta == 1 || $ruta == 2 || $ruta == 3 || $ruta == 4 || $ruta == 5 || $ruta == 6 || $ruta == 7 || $ruta == 8 || $ruta ==9 || $ruta == 10 || $ruta == 45 || $ruta == 46 || $ruta ==58 || $ruta == 106 || $ruta == 107 || $ruta == 108 || $ruta ==109 || $ruta ==110 ){
                        //Cartago
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'GAS TOMZA HINOS';
                              
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'GAS TOMZA TIENDAS';
                        }
                        
                        
                        
}
            if ($ruta == 600){ $canal = 'SUPER GASA PLANTA PUBLICO';}
                     
                      if ($ruta == 603) $canal = 'SUPER GAS  CAMION DISTRIBUIDORES';
if($ruta == 27 || $ruta == 28 || $ruta == 29 || $ruta == 30 || $ruta == 31 || $ruta == 32 || $ruta == 33 || $ruta == 34 || $ruta ==38 || $ruta == 39 || $ruta == 40 || $ruta == 47 || $ruta ==48 || $ruta == 59 ){
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'SUPER GAS HINOS';
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'SUPER GAS TIENDAS';
                        }
                        

}

if($ruta == 404 || $ruta == 12 || $ruta == 13 || $ruta == 14 || $ruta == 15 || $ruta == 16){
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'LA CRUZ HINOS';
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'LA CRUZ TIENDAS';
                        }
                        

}
if($ruta == 504 || $ruta == 11 || $ruta == 17 || $ruta == 18 || $ruta == 19 || $ruta == 20){
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'ATLANTICO HINOS';
                        }
                        if( $row['tipo'] == 1 ||$row['tipo'] == 2){
                              $canal = 'ATLANTICO TIENDAS';
                        }
                        

}
if($ruta == 307 || $ruta == 51 || $ruta == 21 || $ruta == 22 || $ruta == 23 || $ruta == 24 || $ruta == 25 || $ruta == 26 ){
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'CEDI SUR HINOS';
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'CEDI SUR TIENDAS';
                        }
                        

}                          




//$objPHPExcel->getActiveSheet()->setCellValue('A'.$x, $row['nombre'])->setCellValue('B'.$x, $row['total']);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnumero'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($kilos*11.607))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($kilos*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,$kilos)->setCellValue('M'.$x, ($kilos*$row['descuento']))->setCellValue('N'.$x, $row['LAT'].','.$row['LONGI'])->setCellValue('O'.$x, $row['q25'])->setCellValue('P'.$x, $row['q25r'])->setCellValue('Q'.$x, $row['q100'])->setCellValue('R'.$x, $row['q20'])->setCellValue('S'.$x, $row['q20r'])->setCellValue('T'.$x, $row['q35r'])->setCellValue('U'.$x, $row['q45r'])->setCellValue('V'.$x, $row['q10r'])->setCellValue('W'.$x, $row['q35'])->setCellValue('X'.$x, $row['q60'])->setCellValue('Y'.$x, $row['q60r'])->setCellValue('Z'.$x, $credito)->setCellValue('AA'.$x, $canal)->setCellValue('AB'.$x,$kilos * 21.495 );

 
    
        
              
            }
            
            if ($q == "0"){
            
$rutasg = array("3001","3002","3003","3004","3005","9001","2001","2002","2003","2004","5001");
            
                  

                  foreach($rutasg as $ruta) {
                  $sWhere= " WHERE (ruta = '$ruta') AND fechadt BETWEEN  '$d' AND '$dd'"; //AND (tipo = '0' OR tipo = '4' OR tipo = '5')
                  $sql = "SELECT * FROM  facturag $sWhere GROUP BY fecha ORDER BY id ASC "; 
                  //error_log(print_r($ruta, TRUE)); 
                              $query = mysqli_query($con, $sql);
                  if (!$query ) {
                    die('Invalid query: ' . mysql_error() . $sWhere);
                  }
                  while ($row=mysqli_fetch_array($query)){
                        $x++;
                        $canal = '';
                        if($ruta == 3001 || $ruta == 3002 || $ruta == 3003 || $ruta == 3004 || $ruta == 9001 ){
                        $canal = 'GAS TOMZA GRANEL COMERCIAL';
                        if ($row['qkgs'] > 0){
                         $canal = 'GAS TOMZA GRAN GRANEL';
                         }
                        }
                        if($ruta == 2001 || $ruta == 2002 || $ruta == 2003 || $ruta == 2004){
                        $canal = 'SUPER GAS GRANEL COMERCIAL';
                        if ($row['qkgs'] > 0){
                         $canal = 'SUPER GAS GRAN GRANEL';
                         }
                        }
                        if($ruta == 5001 || $ruta == 5002){
                        $canal = 'LA CRUZ GRANEL COMERCIAL';
                        }
                        if( $ruta == 3005){
                        $canal = 'CEDI SUR GRANEL COMERCIAL';
                        }
                        
                        if ($row['qkgs'] > 0){
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnum'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($row['qkgs']))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($row['qkgs']*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,0)->setCellValue('M'.$x, ($row['qlts']*$row['descuento']))->setCellValue('N'.$x, $row['LAT'].','.$row['LONGI'])->setCellValue('Z'.$x, $credito)->setCellValue('AA'.$x, $canal)->setCellValue('AB'.$x,$row['qkgs']/0.54); }
                        else{
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnum'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($row['qlts']*0.54))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($row['qkgs']*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,$row['qlts']*0.54)->setCellValue('M'.$x, ($row['qlts']*$row['descuento']))->setCellValue('N'.$x, $row['LAT'].','.$row['LONGI'])->setCellValue('Z'.$x, $credito)->setCellValue('AA'.$x, $canal)->setCellValue('AB'.$x,$row['qlts'] )->setCellValue('AC'.$x,$row['q45'] );
                        }
                        
                        
                  }

      
                  } 
 }
            
            }else{ //MEGA ELSEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
             
             
              if ($q == "3"){
                $rutas = array("11", "17", "18","19","20", "504");
              }
              if ($q == "4"){
                $rutas = array("21","22","23", "24", "25","26","51","307");
              }
              if ($q == "5"){
                $rutas = array("12", "13", "14","15","16", "404");
              }
                 if ($q == "0"){
              
            $rutas = array("1", "2", "3","4","5", "6", "7","8","9", "10", "45","46","58", "106", "107","108","109", "110", "27","28","29", "30", "31","32","33", "34", "38","39","40", "47", "48","59","11", "17", "18","19","20", "504", "21","22","23", "24", "25","26","51","307","12", "13", "14","15","16", "404","600","601","602","603","200");
            
}
              $objPHPExcel->setActiveSheetIndex(0);
              $x = 1;
            
            
            
            

$objPHPExcel->getActiveSheet()->setCellValue('A1' , 'FECHA')->setCellValue('B1', 'DOCUMENTO')->setCellValue('C1', 'CODIGO CLIENTE')->setCellValue('D1', 'NOMBRE CLIENTE')->setCellValue('E1', 'RAZON SOCIAL')->setCellValue('F1', 'T. COLONES')->setCellValue('G1', 'T KILOS')->setCellValue('H1', 'SUB CANAL')->setCellValue('I1', 'RUTA')->setCellValue('J1', 'SUBTOTAL')->setCellValue('K1', 'DESCUENTO UNITARIO')->setCellValue('L1', 'U. CILINDROS')->setCellValue('M1', 'DESCUENTO')->setCellValue('N1', 'COORDENADA')->setCellValue('O1', 'Presion 25')->setCellValue('P1', 'Rosca 25')->setCellValue('Q1', 'Rosca 100')->setCellValue('R1', 'Presion 20')->setCellValue('S1', 'Rosca 20')->setCellValue('T1', '35 Rosca')->setCellValue('U1', '45 Rosca')->setCellValue('V1', '10 ROSCA')->setCellValue('W1', '30 ROSCA')->setCellValue('X1', '50 ROSCA')->setCellValue('Y1', '60 ROSCA')->setCellValue('Z1', 'CREDITO')->setCellValue('AA1', 'Resumen de venta')->setCellValue('AB1', 'Total Litros')->setCellValue('AC1', 'Rosca 40');

for($col = 'A'; $col !== 'AB'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
            //$sWhere= " WHERE (ruta = '$ruta') AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')"; //AND (tipo = '0' OR tipo = '4' OR tipo = '5')
                  
          // $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC ";
           foreach($rutas as $rutar) {
           $sWhere = " WHERE (ruta = '$rutar') AND tipo = 100 AND fechadt BETWEEN  '$d' AND '$dd' ";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC ";
             
             $query = mysqli_query($con, $sql);
            if (!$query ) {
              die('Invalid query: ' . mysql_error(). $q.$d.$dd . '  '.$sql );
           
            }
            
$rowtipo = ''; 
            while ($row=mysqli_fetch_array($query)){
                              $canal = '';
            $kilos = $row['cz25'] + $row['cz25r'] + ($row['cz100r'] * 4) ;
                
     
            $rowtipo = $row['cz25'];
            
           // if ($row['tipo'] == '0') $rowtipo = 'PULPERIA';
            if ($row['tipo'] == '1') $rowtipo = 'TIENDA VARIABLE';
            if ($row['tipo'] == '2') $rowtipo = 'TIENDA FIJO';
            if ($row['tipo'] == '4') $rowtipo = 'SUPERMERCADO';
            if ($row['tipo'] == '5') $rowtipo = 'INDUSTRIAL';
            if ($row['tipo'] == '100') $rowtipo = 'CILZA';
            
            $x++;
               $ruta = $row['ruta']; 
               $credito= 'Credito';
               if($row['credito']==1)
               { $credito= 'Contado';}
               //$credito = ($row['ruta']==1?'Contado':'Credito')
                     if ($ruta == 601){ $canal = 'GAS TOMZA PLANTA PUBLICO';
                                     $index = 1;
                                     $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                                     
                                     
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                               }
                     if ($ruta == 200) {$canal = 'GAS TOMZA CAMION CF';
                     $index = 9;
                     $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                              }
                      if ($ruta == 602){ $canal = 'GAS TOMZA DISTRIBUIDORES';
                                    $index = 3;
                                    $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                                     // error_log("Yeah!", 0);
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                             //  error_log("yeah c!", 0);
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                              }
  if($ruta == 1 || $ruta == 2 || $ruta == 3 || $ruta == 4 || $ruta == 5 || $ruta == 6 || $ruta == 7 || $ruta == 8 || $ruta ==9 || $ruta == 10 || $ruta == 45 || $ruta == 46 || $ruta ==58 || $ruta == 106 || $ruta == 107 || $ruta == 108 || $ruta ==109 || $ruta ==110 ){
                        //Cartago
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'GAS TOMZA HINOS';
                              $index = 0;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                              //$generalcontadolitros[0] += $kilos * 21.495;
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'GAS TOMZA TIENDAS';
                              $index = 7;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        
                        
                        
}
            if ($ruta == 600){ $canal = 'SUPER GAS PLANTA PUBLICO';
                              $index = 10;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
            }
                     
                      if ($ruta == 603) {$canal = 'SUPER GAS CAMION DISTRIBUIDORES';
                                     $index = 13;
                                     $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                      }
if($ruta == 27 || $ruta == 28 || $ruta == 29 || $ruta == 30 || $ruta == 31 || $ruta == 32 || $ruta == 33 || $ruta == 34 || $ruta ==38 || $ruta == 39 || $ruta == 40 || $ruta == 47 || $ruta ==48 || $ruta == 59 ){
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'SUPER GAS HINOS';
                              $index = 12;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'SUPER GAS TIENDAS';
                              $index = 17;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        

}

if($ruta == 404 || $ruta == 12 || $ruta == 13 || $ruta == 14 || $ruta == 15 || $ruta == 16){
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'LA CRUZ HINOS';
                              $index = 18;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'LA CRUZ TIENDAS';
                              $index = 21;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        

}
if($ruta == 504 || $ruta == 11 || $ruta == 17 || $ruta == 18 || $ruta == 19 || $ruta == 20){
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'ATLANTICO HINOS';
                              $index = 22;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){ //contado
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{ //credito
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 ||$row['tipo'] == 2){
                              $canal = 'ATLANTICO TIENDAS';
                              $index = 23;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        

}
if($ruta == 307 || $ruta == 51 || $ruta == 21 || $ruta == 22 || $ruta == 23 || $ruta == 24 || $ruta == 25 || $ruta == 26 ){
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'CEDI SUR HINOS';
                              $index = 24;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'CEDI SUR TIENDAS';
                              $index = 27;
                              $generalq25[$index] += $row['cz25'] + $row['cz25r'];
                                     $generalq20[$index] += $row['q20'] + $row['q20r'];
                                     $generalq10[$index] += $row['q10r'];
                                     $generalq35[$index] += $row['q35r'];
                                     $generalq30[$index] += $row['q35'];
                                     $generalq40[$index] += $row['q45'];
                                     $generalq45[$index] += $row['q45r'];
                                     $generalq50[$index] += $row['q60'];
                                     $generalq60[$index] += $row['q60r'];
                                     $generalq100[$index] += $row['q100'];
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $kilos  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        

}                          

$tien = 'TIENDA';
if ($rowtipo != 'TIENDA FIJO' && $rowtipo != 'TIENDA VARIABLE') {$tien = $rowtipo; }
$new_array = array('TOTAL KILOS'=>$kilos*11.607,'NOMBRE'=>str_replace("&","",$row['nombre']),'RESUMEN VENTA'=>$canal,'TOTAL CILINDROS'=>$kilos,'RUTA'=>$row['ruta'],'CODIGO'=>$row['codigo'],'TIPO'=>$tien);
array_push($ArrayGeneral, $new_array);

//$objPHPExcel->getActiveSheet()->setCellValue('A'.$x, $row['nombre'])->setCellValue('B'.$x, $row['total']);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnumero'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($kilos*11.607))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($kilos*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,$kilos)->setCellValue('M'.$x, ($kilos*$row['descuento']))->setCellValue('N'.$x, $row['LAT'].','.$row['LONGI'])->setCellValue('O'.$x, $row['cz25']+$row['cz25r'])->setCellValue('P'.$x, $row['q25r'])->setCellValue('Q'.$x, $row['cz100r'])->setCellValue('R'.$x, $row['q20'])->setCellValue('S'.$x, $row['q20r'])->setCellValue('T'.$x, $row['q35r'])->setCellValue('U'.$x, $row['q45r'])->setCellValue('V'.$x, $row['q10r'])->setCellValue('W'.$x, $row['q35'])->setCellValue('X'.$x, $row['q60'])->setCellValue('Y'.$x, $row['q60r'])->setCellValue('Z'.$x, $credito)->setCellValue('AA'.$x, $canal)->setCellValue('AB'.$x,$kilos * 21.495 )->setCellValue('AC'.$x,$row['q45']);

 
    
        
              
            }
            }//for each  rutas
            
        

      
            
      
      $objPHPExcel->createSheet();
      $objPHPExcel->createSheet();
      $objPHPExcel->setActiveSheetIndex(2);
      
      for($col = 'A'; $col !== 'Z'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
                             
        

        $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A35', 'RESUMEN DE VENTA '.$d)->setCellValue('B35', 'ENVASES')->setCellValue('C35', 'BRUTO')->setCellValue('D35', 'DESCUENTO')
            ->setCellValue('E35', 'MONTO NETO')->setCellValue('F35', 'ENVASES')->setCellValue('G35', 'BRUTO')->setCellValue('H35', 'DESCUENTO')
            ->setCellValue('I35', 'MONTO NETO')

            ->setCellValue('A36', 'GAS TOMZA CILZA')->setCellValue('B36', $generalcontadolitros[0])->setCellValue('C36', $generalcontadobruto[0])->setCellValue('D36', $generalcontadodesc[0])
            ->setCellValue('E36', $generalcontadoneto[0])->setCellValue('F36',$generalcreditolitros[0] )->setCellValue('G36', $generalcreditobruto[0])->setCellValue('H36', $generalcreditodesc[0])
            ->setCellValue('I36', $generalcreditoneto[0])

            ->setCellValue('A48', 'CILZA SUPER GAS ')
            ->setCellValue('B48', $generalcontadolitros[12])
            ->setCellValue('C48', $generalcontadobruto[12])
            ->setCellValue('D48', $generalcontadodesc[12])
            ->setCellValue('E48', $generalcontadoneto[12])
            ->setCellValue('F48',$generalcreditolitros[12])
            ->setCellValue('G48', $generalcreditobruto[12])
            ->setCellValue('H48', $generalcreditodesc[12])
            ->setCellValue('I48', $generalcreditoneto[12])

           

            ->setCellValue('A54', 'CILZA LA CRUZ ')
            ->setCellValue('B54', $generalcontadolitros[18])
            ->setCellValue('C54', $generalcontadobruto[18])
            ->setCellValue('D54', $generalcontadodesc[18])
            ->setCellValue('E54', $generalcontadoneto[18])
            ->setCellValue('F54',$generalcreditolitros[18] )
            ->setCellValue('G54', $generalcreditobruto[18])
            ->setCellValue('H54', $generalcreditodesc[18])
            ->setCellValue('I54', $generalcreditoneto[18])

        

            ->setCellValue('A58', 'CILZA CEDI ATLANTICO')
            ->setCellValue('B58', $generalcontadolitros[22])
            ->setCellValue('C58', $generalcontadobruto[22])
            ->setCellValue('D58', $generalcontadodesc[22])
            ->setCellValue('E58', $generalcontadoneto[22])
            ->setCellValue('F58',$generalcreditolitros[22] )
            ->setCellValue('G58', $generalcreditobruto[22])
            ->setCellValue('H58', $generalcreditodesc[22])
            ->setCellValue('I58', $generalcreditoneto[22])

          

            ->setCellValue('A60', 'CILZA CEDI ZONA SUR')
            ->setCellValue('B60', $generalcontadolitros[24])
            ->setCellValue('C60', $generalcontadobruto[24])
            ->setCellValue('D60', $generalcontadodesc[24])
            ->setCellValue('E60', $generalcontadoneto[24])
            ->setCellValue('F60',$generalcreditolitros[24] )
            ->setCellValue('G60', $generalcreditobruto[24])
            ->setCellValue('H60', $generalcreditodesc[24])
            ->setCellValue('I60', $generalcreditoneto[24])

          

             ->setCellValue('A64', 'TOTAL:')
             ->setCellValue('B64', array_sum($generalcontadolitros))
             ->setCellValue('C64', array_sum($generalcontadobruto))
             ->setCellValue('D64', array_sum($generalcontadodesc))
            ->setCellValue('E64', array_sum($generalcontadoneto))
            ->setCellValue('F64',array_sum($generalcreditolitros))
            ->setCellValue('G64', array_sum($generalcreditobruto))
            ->setCellValue('H64', array_sum($generalcreditodesc))
            ->setCellValue('I64', array_sum($generalcreditoneto))
            ->setCellValue('O35', "DETALLE CAJA");

              
       $id = 0;
       
                              
        $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A1', 'Concepto ' . $d)->setCellValue('B1', 'OTROS')->setCellValue('C1', '50')->setCellValue('D1', '10')
            ->setCellValue('E1', '20')->setCellValue('F1', '25')->setCellValue('G1', '35')->setCellValue('H1', '45')
            ->setCellValue('I1', '40')->setCellValue('J1', '100')->setCellValue('K1', '30')->setCellValue('L1', '60')->setCellValue('M1', 'LITROS')->setCellValue('N1', 'KILOS')->setCellValue('O1', 'BRUTO')->setCellValue('P1', 'DESC')->setCellValue('Q1', 'NETO');




            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A2', 'GAS TOMZA HINOS')
            ->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
             
              $id++;
             
             $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A3', 'GAS TOMZA PLANTA PUBLICO')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A4', 'GAS TOMZA PLANTA DISTRIBUIDORES')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A5', 'GAS TOMZA DISTRIBUIDORES')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A6', 'GAS TOMZA GRANEL')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A7', 'GAS TOMZA PETROGAS')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A8', 'GAS TOMZA GRAN GRANEL')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A9', 'GAS TOMZA TIENDAS')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A10', 'GAS TOMZA CARBURACION')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A11', 'GAS TOMZA CAMION CF')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A12', 'SUPER GAS PLANTA PUBLICO')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A13', 'SUPER GAS PLANTA DISTRIBUIDORES')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A14', 'SUPER GAS HINOS')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A15', 'SUPER GAS CAMION DISTRIBUIDORES')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A16', 'SUPER GAS GRANEL')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A17', 'SUPER GAS GRANEL PETROGAS')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A18', 'SUPER GAS GRAN GRANEL')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A19', 'SUPER GAS TIENDAS')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A20', 'LA CRUZ HINOS')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A21', 'LA CRUZ DISTRIBUIDORES')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A22', 'LA CRUZ GRANEL')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A23', 'LA CRUZ TIENDAS')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A24', 'CEDI ATLANTICO')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A25', 'CEDI ATLANTICO TIENDAS')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A26', 'CEDI ZONA SUR HINOS')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A27', 'CEDI ZONA SUR GRANEL')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A28', 'ZONA SUR CARBURACION')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A29', 'CEDI ZONA SUR TIENDAS')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2), $generalq50[$id])->setCellValue('D'.($id+2), $generalq10[$id])
            ->setCellValue('E'.($id+2), $generalq20[$id])->setCellValue('F'.($id+2), $generalq25[$id])->setCellValue('G'.($id+2), $generalq35[$id])->setCellValue('H'.($id+2), $generalq45[$id])
            ->setCellValue('I'.($id+2), $generalq40[$id])->setCellValue('J'.($id+2), $generalq100[$id])->setCellValue('K'.($id+2), $generalq30[$id])->setCellValue('L'.($id+2), $generalq60[$id])->setCellValue('M'.($id+2), $generalcontadolitros[$id] +  $generalcreditolitros[$id] )->setCellValue('N'.($id+2), ($generalcontadolitros[$id] +  $generalcreditolitros[$id]) * 0.54)->setCellValue('O'.($id+2), $generalcontadobruto[$id] + $generalcreditobruto[$id])->setCellValue('P'.($id+2), $generalcontadodesc[$id] + $generalcreditodesc[$id])->setCellValue('Q'.($id+2), $generalcontadoneto[$id] + $generalcreditoneto[$id]);
$id++;
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A30', 'TOTAL:')->setCellValue('B'.($id+2), '')->setCellValue('C'.($id+2),array_sum($generalq50))->setCellValue('D'.($id+2), array_sum($generalq10))
            ->setCellValue('E'.($id+2), array_sum($generalq20))->setCellValue('F'.($id+2), array_sum($generalq25))->setCellValue('G'.($id+2), array_sum($generalq35))->setCellValue('H'.($id+2), array_sum($generalq45))
            ->setCellValue('I'.($id+2), array_sum($generalq40))->setCellValue('J'.($id+2), array_sum($generalq100))->setCellValue('K'.($id+2), array_sum($generalq30))->setCellValue('L'.($id+2), array_sum($generalq60))->setCellValue('M'.($id+2), array_sum($generalcontadolitros) +  array_sum($generalcreditolitros) )->setCellValue('N'.($id+2), (array_sum($generalcontadolitros) +  array_sum($generalcreditolitros)) * 0.54)->setCellValue('O'.($id+2), array_sum($generalcontadobruto) + array_sum($generalcreditobruto))->setCellValue('P'.($id+2), array_sum($generalcontadodesc) + array_sum($generalcreditodesc))->setCellValue('Q'.($id+2), array_sum($generalcontadoneto) + array_sum($generalcreditoneto));
           
               $filmsByGenre = PHPivot::create($ArrayGeneral)
            ->setPivotRowFields('RUTA')
            ->setPivotValueFields('TOTAL KILOS',PHPivot::PIVOT_VALUE_SUM, PHPivot::DISPLAY_AS_VALUE, 'TOTAL KILOS')
            //->addFilter('Genre','', PHPivot::COMPARE_NOT_EQUAL) //Filter out blanks/unknown genre
            ->generate();

function tdrows($elements)
{
    $str = "";
    foreach ($elements as $element) {
        $str .= $element->nodeValue . "  -  ";
    }

    return $str;
}


   // $contents = "<table><tr><td>Row 1 Column 1</td><td>Row 1 Column 2</td></tr><tr><td>Row 2 Column 1</td><td>Row 2 Column 2</td></tr></table>";
 
    $DOM = new DOMDocument;
    $DOM->loadHTML($filmsByGenre->toHtml());

    $items = $DOM->getElementsByTagName('tr');
    $i = 0;

    foreach ($items as $node) {
        //echo tdrows($node->childNodes) . "<br />";
        $i++;
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.($i),tdrows($node->childNodes));
    }
    
     $filmsByGenres = PHPivot::create($ArrayGeneral)
            ->setPivotRowFields('NOMBRE')
            //->setPivotColumnFields('TIPO')
            ->setPivotValueFields('TOTAL KILOS',PHPivot::PIVOT_VALUE_SUM, PHPivot::DISPLAY_AS_VALUE, 'TOTAL KILOS')
            ->addFilter('TIPO','TIENDA', PHPivot::COMPARE_EQUAL)
          
            ->generate();
            
            $DOMi = new DOMDocument;
           
    //error_log($filmsByGenres->toHtml());
          $DOMi->loadHTML($filmsByGenres->toHtml());

    $items = $DOMi->getElementsByTagName('tr');
    $i = 0;

    foreach ($items as $node) {
        //echo tdrows($node->childNodes) . "<br />";
        $i++;
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.($i),tdrows($node->childNodes));
    }   
    

     
            //error_log($filmsByGenre->toHtml());
            

            }//END IF MEGA ELSE

           
// Redirect output to a clientâ€™s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="cubo.xlsx"');
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


