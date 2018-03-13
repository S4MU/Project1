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

$x = 5;//excel comienza en fila 1
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
                
                $cod = $_GET['cod'];
                
                $q= $_GET['q'];//isset($GET['q']) ? $GET['q'] : '';
                $d= $_GET['d'];//isset($GET['d']) ? $GET['d'] : '';
                $sTable = "facturas"; //$sTable = "facturas, clientes, users";
        $sWhere = " WHERE";
   
            $sTable = "facturas"; //$sTable = "facturas, clientes, users";
        $sWhere = " WHERE";
    $myArray = array();
    
            // Start XML file, create parent node
           
            
            if ($q == "1"){
            $sWhere.= " (ruta = '1' OR ruta = '2' OR ruta = '3' OR ruta = '4' OR ruta = '5' OR ruta = '6' OR ruta = '7' OR ruta = '8' OR ruta = '9'
            OR ruta = '10' OR ruta = '45' OR ruta = '46' OR ruta = '58' OR ruta = '106' OR ruta = '107' OR ruta = '108' OR ruta = '109' OR ruta = '110')  AND fecha like '%$d%' AND credito = '0'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
            
            if ($q == "2"){
            $sWhere.= " (ruta = '27' OR ruta = '28' OR ruta = '29' OR ruta = '30' OR ruta = '31' OR ruta = '32' OR ruta = '33' OR ruta = '34' OR ruta = '38'
            OR ruta = '39' OR ruta = '40' OR ruta = '47' OR ruta = '48' OR ruta = '59') AND fecha like '%$d%' AND credito = '0'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
           
            if ($q == "3"){
            $sWhere.= " (ruta = '11' OR ruta = '17' OR ruta = '18' OR ruta = '19' OR ruta = '20' OR ruta = '504') AND fecha like '%$d%' AND credito = '0'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
           
            if ($q == "4"){
            $sWhere.= " (ruta = '21' OR ruta = '22' OR ruta = '23' OR ruta = '24' OR ruta = '25' OR ruta = '26' OR ruta = '307') AND fecha like '%$d%' AND credito = '0'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }
             
            if ($q == "5"){
            $sWhere.= " (ruta = '12' OR ruta = '13' OR ruta = '14'OR ruta = '15' OR ruta = '16' OR ruta = '404') AND fecha like '%$d%' AND credito = '0'";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC "; 
            }   
                      
             if ($q != "0" && $q != "1" && $q != "2" && $q != "3" && $q != "4" && $q != "5" ){
              
           
            
            }else{ //MEGA ELSEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
             
             
              if ($q == "3"){
                $rutas = array("11", "17", "18","19","20", "504");
              }
              if ($q == "2"){
                $rutas = array("27","28","29", "30", "31","32","33", "34", "38","39","40", "47", "48","59");
              }
              if ($q == "4"){
                $rutas = array("21","22","23", "24", "25","26","51","307");
              }
              if ($q == "5"){
                $rutas = array("12", "13", "14","15","16", "404");
              }
                 if ($q == "1"){
              
            $rutas = array("1", "2", "3","4","5", "6", "7","8","9", "10", "45","46","58", "106", "107","108","109", "110");
            
}
              $objPHPExcel->setActiveSheetIndex(0);
              $x = 5;
            
            
            
            
/*
$objPHPExcel->getActiveSheet()->setCellValue('A1' , 'FECHA')->setCellValue('B1', 'DOCUMENTO')->setCellValue('C1', 'CODIGO CLIENTE')->setCellValue('D1', 'NOMBRE CLIENTE')->setCellValue('E1', 'RAZON SOCIAL')->setCellValue('F1', 'T. COLONES')->setCellValue('G1', 'T KILOS')->setCellValue('H1', 'SUB CANAL')->setCellValue('I1', 'RUTA')->setCellValue('J1', 'SUBTOTAL')->setCellValue('K1', 'DESCUENTO UNITARIO')->setCellValue('L1', 'U. CILINDROS')->setCellValue('M1', 'DESCUENTO')->setCellValue('N1', 'LITROS')->setCellValue('O1', 'Tramite')->setCellValue('P1', 'Original o copia')->setCellValue('Q1', 'Descuento')->setCellValue('R1', '');*/

$objPHPExcel->getActiveSheet()->setCellValue('A5' , 'FECHA')->setCellValue('B5', 'DOCUMENTO')->setCellValue('C5', 'CODIGO CLIENTE')->setCellValue('D5', 'NOMBRE CLIENTE')->setCellValue('E5', 'RAZON SOCIAL')->setCellValue('F5', 'T. COLONES')->setCellValue('G5', 'RUTA')->setCellValue('H5', 'DESCUENTO')->setCellValue('I5', 'Tramite')->setCellValue('J5', 'Original o copia')->setCellValue('K5', 'Descuento')->setCellValue('E3', 'GAS TOMZA - VENTA CREDITO - '.$d);

for($col = 'A'; $col !== 'AB'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
            //$sWhere= " WHERE (ruta = '$ruta') AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')"; //AND (tipo = '0' OR tipo = '4' OR tipo = '5')
                  
          // $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC ";
           foreach($rutas as $rutar) {
           $sWhere = " WHERE (ruta = '$rutar') AND credito = '0' AND DATE(fechadt) = '$d' ";
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
$objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnumero'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, $row['ruta'])->setCellValue('H'.$x,$row['descuento'] );

 
    
        
              
            }
            }//for each  rutas
            
        
     if ($q == "1" || $q == "5" || $q == "3" || $q == "4"){
          error_log(print_r("si".$q, TRUE)); 

          $rutasg = array();
             
             if ($q == "1"){$rutasg = array("3001","3002","3003","3004");
                   error_log(print_r("CARTAGO".$q, TRUE));}
                   
              if ($q == "4")
                $rutasg = array("3005");
              if ($q == "5")
                $rutasg = array("5001","5002");
            
            if ($q == "2") $rutasg = array("2001","2002","2003","2004");
            
                   
                   
                  foreach($rutasg as $ruta) {
                  $sWhere= " WHERE (ruta = '$ruta') AND credito = '0' AND DATE(fechadt) = '$d'"; //AND (tipo = '0' OR tipo = '4' OR tipo = '5')
                  $sql = "SELECT * FROM  facturag $sWhere GROUP BY fecha ORDER BY id ASC "; 
                  //error_log(print_r($ruta, TRUE)); 
                              $query = mysqli_query($con, $sql);
                  if (!$query ) {
                    die('Invalid query: ' . mysql_error() . $sWhere);
                  }
                  while ($row=mysqli_fetch_array($query)){
                        $x++;
                        $canal = '';
                        
                         $credito= 'Credito';
                           if($row['credito']==1)
                           { $credito= 'Contado';}
                       

                        if($ruta == 2001 || $ruta == 2002 || $ruta == 2003 || $ruta == 2004){
                        
                      
                        
                              
                        if ($row['qkgs'] > 0){
                         $canal = 'SUPER GAS GRAN GRANEL';
                              $index = 16;

                              if($row['credito'] != '0'){

                              
                              $generalcontadolitros[$index] += $row['qkgs'] / 0.54 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'] * $row['qkgs'];
                              $generalcontadobruto[$index] += $row['total']+ ($row['descuento'] * $row['qkgs']);
                              }else{
                              $generalcreditolitros[$index] += $row['qkgs'] / 0.54 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'] * $row['qkgs'];
                              $generalcreditobruto[$index] += $row['total']+ ($row['descuento'] * $row['qkgs']);
                              }
                         }else{
                           $index = 14;
                          $canal = 'SUPER GAS GRANEL COMERCIAL';
                         if($row['credito'] != '0'){
                         
                            
                              $generalcontadolitros[$index] += $row['qlts'] ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'] * $row['qlts'];
                              $generalcontadobruto[$index] += $row['total']+ ($row['descuento'] * $row['qlts']);
                              }else{
                              $generalcreditolitros[$index] += $row['qlts'];
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'] * $row['qlts'];
                              $generalcreditobruto[$index] += $row['total']+ ($row['descuento'] * $row['qlts']);
                              }
                         }
                        }
                  if($ruta == 3001 || $ruta == 3002 || $ruta == 3003 || $ruta == 3004 || $ruta == 9001 ){
                       
                              if ($row['qkgs'] > 0){
                          $canal = 'GAS TOMZA GRAN GRANEL COMERCIAL';
                        $index = 6;
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $row['qkgs'] / 0.54 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'] * $row['qkgs'];
                              $generalcontadobruto[$index] += $row['total']+ ($row['descuento'] * $row['qkgs']);
                              }else{
                              $generalcreditolitros[$index] += $row['qkgs'] / 0.54 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'] * $row['qkgs'];
                              $generalcreditobruto[$index] += $row['total']+ ($row['descuento'] * $row['qkgs']);
                              }
                         }else{
                           $canal = 'GAS TOMZA GRANEL COMERCIAL';
                        $index = 4;
                         if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $row['qlts'] ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'] * $row['qlts'];
                              $generalcontadobruto[$index] += $row['total']+ ($row['descuento'] * $row['qlts']);
                              }else{
                              $generalcreditolitros[$index] += $row['qlts'];
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'] * $row['qlts'];
                              $generalcreditobruto[$index] += $row['total']+ ($row['descuento'] * $row['qlts']);
                              }
                         }
                        }

                        if($ruta == 5001 || $ruta == 5002){
                        $canal = 'LA CRUZ GRANEL COMERCIAL';
                        $index = 20;
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $row['qlts']  ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'] * $row['qlts'];
                              $generalcontadobruto[$index] += $row['total']+ ($row['descuento'] * $row['qlts']);
                              }else{
                              $generalcreditolitros[$index] += $row['qlts']  ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'] * $row['qlts'];
                              $generalcreditobruto[$index] += $row['total']+ ($row['descuento'] * $row['qlts']);
                              }
                        }
                        if( $ruta == 3005){
                              $canal = 'CEDI SUR GRANEL COMERCIAL';
                              $index = 25;
                              if ($row['qkgs'] > 0){
                         
                              if($row['credito'] != '0'){
                              $generalcontadolitros[$index] += $row['qkgs'] / 0.54 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'] * $row['qkgs'];
                              $generalcontadobruto[$index] += $row['total']+ ($row['descuento'] * $row['qkgs']);
                              }else{
                              $generalcreditolitros[$index] += $row['qkgs'] / 0.54 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'] * $row['qkgs'];
                              $generalcreditobruto[$index] += $row['total']+ ($row['descuento'] * $row['qkgs']);
                              }
                         }else{
                         if($row['credito'] != '0'){

                              $generalcontadolitros[$index] += $row['qlts'] ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'] * $row['qlts'];
                              $generalcontadobruto[$index] += $row['total']+ ($row['descuento'] * $row['qlts']);
                              }else{
                              $generalcreditolitros[$index] += $row['qlts'];
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'] * $row['qlts'];
                              $generalcreditobruto[$index] += $row['total']+ ($row['descuento'] * $row['qlts']);
                              }
                         }
                        }
                        
                        if ($row['qkgs'] > 0){
     /*                   
$objPHPExcel->getActiveSheet()->setCellValue('A1' , 'FECHA')->setCellValue('B1', 'DOCUMENTO')->setCellValue('C1', 'CODIGO CLIENTE')->setCellValue('D1', 'NOMBRE CLIENTE')->setCellValue('E1', 'RAZON SOCIAL')->setCellValue('F1', 'T. COLONES')->setCellValue('G1', 'RUTA')->setCellValue('H1', 'DESCUENTO')->setCellValue('I1', 'Tramite')->setCellValue('J1', 'Original o copia')->setCellValue('K1', 'Descuento')->setCellValue('L1', '');*/

                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnum'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, $row['ruta'])->setCellValue('H'.$x,$row['descuento'] ); 
                       /*  $objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnum'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($row['qkgs']))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($row['qkgs']*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,0)->setCellValue('M'.$x, ($row['qlts']*$row['descuento']))->setCellValue('N'.$x,$row['qkgs']/0.54); */
                  
                
                      }
                        else{
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnum'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, $row['ruta'])->setCellValue('H'.$x,$row['descuento'] );
                      /*  $objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnum'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($row['qlts']*0.54))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($row['qkgs']*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,$row['qlts']*0.54)->setCellValue('M'.$x, ($row['qlts']*$row['descuento']))->setCellValue('N'.$x,$row['qlts'] );*/
                        
                       
                        /* $new_array = array('TOTAL KILOS'=>$row['qlts']*0.54,'NOMBRE'=>str_replace("&","",$row['nombre']),'RESUMEN VENTA'=>$canal,'TOTAL CILINDROS'=>'0','RUTA'=>$canal .' '.$row['ruta'],'CODIGO'=>$row['codigo'],'TIPO'=>$rowtipo);*/
            
                        }
                        
                        
                  }

      
                  } 
             
}
      
            
      
                   $x += 5;    
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$x ,'REVISADO POR:____________________________________')->setCellValue('F'.$x, 'RECIBIDO POR:____________________________________');

       
              
      
           
              



     
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


