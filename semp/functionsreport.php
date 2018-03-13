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






// Create new PHPExcel object
//$objPHPExcel = new PHPExcel();
require_once ("config/db2.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
    //require 'PHPivot.php';
   
    
    function reportegen($q, $d,$dd,$sqlC = "default") {
	global $con;
    
$ArrayGeneral = array();
$credito = 0;
$ruta = 0; 
$canal = 0;
      $generalcontadolitros = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcontadoneto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcontadodesc = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcontadobruto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditolitros = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditoneto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditodesc = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditobruto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      
      $generalq25 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq10 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq20 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq30 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq35 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq40 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq45 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq50 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq60 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
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


$kilos = 0;

    $sql = 'NO CARGO NADA';
    
                //$q =$_GET['q'];
    
                //$dd =$_GET['dd']; 
                //$cod = $_GET['cod'];
                
                //$q= $_GET['q'];//isset($GET['q']) ? $GET['q'] : '';
                //$d= $_GET['d'];//isset($GET['d']) ? $GET['d'] : '';
               
                $sTable = "facturas"; //$sTable = "facturas, clientes, users";
        $sWhere = " WHERE";
   
            $sTable = "facturas"; //$sTable = "facturas, clientes, users";
        $sWhere = " WHERE";
    $myArray = array();
   
            
            
            
            


$rowtipo = ''; 
$canal = '';

           
            $rutas = array("1", "2", "3","4","5", "6", "7","8","9", "10", "45","46","58", "106", "107","108","109", "110", "27","28","29", "30", "31","32","33", "34", "38","39","40", "47", "48","59","11", "17", "18","19","20", "504", "21","22","23", "24", "25","26","51","307","12", "13", "14","15","16", "404","600","601","602","603","200");
              
              $x = 1;
            
            
            
   


            //$sWhere= " WHERE (ruta = '$ruta') AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')"; //AND (tipo = '0' OR tipo = '4' OR tipo = '5')
                  
          // $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC ";
           foreach($rutas as $rutar) {
           $sWhere = " WHERE (ruta = '$rutar') AND tipo != 100 AND fechadt BETWEEN  '$d' AND '$dd' ";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC ";
             
             $query = mysqli_query($con, $sql);
            if (!$query ) {
              die('Invalid query: ' . mysql_error(). $q.$d.$dd . '  '.$sql );
           
            }
            
$rowtipo = ''; 
            while ($row=mysqli_fetch_array($query)){
                              $canal = '';
            $kilos = $row['q25'] + $row['q25r'] + ($row['q100'] * 4) + ($row['q20'] * 0.8) + ($row['q20r'] * 0.8) + ($row['q10r'] * 0.4) + ($row['q35'] * 1.2) + ($row['q35r'] * 1.4)
                + ($row['q45'] * 1.6) + ($row['q45r'] * 1.8) + ($row['q60'] * 2) + ($row['q60r'] * 2.4) ;
                
     
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
                                     $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                               }
                     if ($ruta == 200) {$canal = 'GAS TOMZA CAMION CF';
                     $index = 9;
                     $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                              }
                      if ($ruta == 602){ $canal = 'GAS TOMZA DISTRIBUIDORES';
                                    $index = 3;
                                    $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                             //  error_log("yeah c!", 0);
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
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
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                              //$generalcontadolitros[0] += $kilos * 21.495;
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'GAS TOMZA TIENDAS';
                              $index = 7;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        
                        
                        
}
            if ($ruta == 600){ $canal = 'SUPER GAS PLANTA PUBLICO';
                              $index = 10;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
            }
                     
                      if ($ruta == 603) {$canal = 'SUPER GAS CAMION DISTRIBUIDORES';
                                     $index = 13;
                                     $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                      }
if($ruta == 27 || $ruta == 28 || $ruta == 29 || $ruta == 30 || $ruta == 31 || $ruta == 32 || $ruta == 33 || $ruta == 34 || $ruta ==38 || $ruta == 39 || $ruta == 40 || $ruta == 47 || $ruta ==48 || $ruta == 59 ){
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'SUPER GAS HINOS';
                              $index = 12;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'SUPER GAS TIENDAS';
                              $index = 17;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
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
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'LA CRUZ TIENDAS';
                              $index = 21;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
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
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{ //credito
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 ||$row['tipo'] == 2){
                              $canal = 'ATLANTICO TIENDAS';
                              $index = 23;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
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
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'CEDI SUR TIENDAS';
                              $index = 27;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        

}                          


         
/*
$objPHPExcel->getActiveSheet()->setCellValue('A1' , 'FECHA')->setCellValue('B1', 'DOCUMENTO')->setCellValue('C1', 'CODIGO CLIENTE')->setCellValue('D1', 'NOMBRE CLIENTE')->setCellValue('E1', 'RAZON SOCIAL')->setCellValue('F1', 'T. COLONES')->setCellValue('G1', 'T KILOS')->setCellValue('H1', 'SUB CANAL')->setCellValue('I1', 'RUTA')->setCellValue('J1', 'SUBTOTAL')->setCellValue('K1', 'DESCUENTO UNITARIO')->setCellValue('L1', 'U. CILINDROS')->setCellValue('M1', 'DESCUENTO')->setCellValue('N1', 'COORDENADA')->setCellValue('O1', 'Presion 25')->setCellValue('P1', 'Rosca 25')->setCellValue('Q1', 'Rosca 100')->setCellValue('R1', 'Presion 20')->setCellValue('S1', 'Rosca 20')->setCellValue('T1', '35 Rosca')->setCellValue('U1', '45 Rosca')->setCellValue('V1', '10 ROSCA')->setCellValue('W1', '30 ROSCA')->setCellValue('X1', '50 ROSCA')->setCellValue('Y1', '60 ROSCA')->setCellValue('Z1', 'CREDITO')->setCellValue('AA1', 'Resumen de venta')->setCellValue('AB1', 'Total Litros')->setCellValue('AC1', 'Rosca 40');
*/
$new_array = array('SUB CANAL'=>$row['credito'],'CREDITO'=>$row['credito'],'TOTAL KILOS'=>$kilos*11.607,'TOTAL LITROS'=>$kilos * 21.495,'RESUMEN VENTA'=>$canal,'TOTAL CILINDROS'=>$kilos,'RUTA'=>$rowtipo );
array_push($ArrayGeneral, $new_array);

/*
//$objPHPExcel->getActiveSheet()->setCellValue('A'.$x, $row['nombre'])->setCellValue('B'.$x, $row['total']);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnumero'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($kilos*11.607))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($kilos*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,$kilos)->setCellValue('M'.$x, ($kilos*$row['descuento']))->setCellValue('N'.$x, $row['LAT'].','.$row['LONGI'])->setCellValue('O'.$x, $row['q25'])->setCellValue('P'.$x, $row['q25r'])->setCellValue('Q'.$x, $row['q100'])->setCellValue('R'.$x, $row['q20'])->setCellValue('S'.$x, $row['q20r'])->setCellValue('T'.$x, $row['q35r'])->setCellValue('U'.$x, $row['q45r'])->setCellValue('V'.$x, $row['q10r'])->setCellValue('W'.$x, $row['q35'])->setCellValue('X'.$x, $row['q60'])->setCellValue('Y'.$x, $row['q60r'])->setCellValue('Z'.$x, $credito)->setCellValue('AA'.$x, $canal)->setCellValue('AB'.$x,$kilos * 21.495 )->setCellValue('AC'.$x,$row['q45']);
*/
 
    
        
              
            }
            }//for each  rutas
            
            if ($q == "0"){
           // error_log(print_r("si", TRUE)); 
$rutasg = array("3001","3002","3003","3004","3005","9001","2001","2002","2003","2004","5001","6002","6001");
            
                  

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
                        $new_array = array('SUB CANAL'=>$row['credito'],'CREDITO'=>$row['credito'],'TOTAL KILOS'=>$kilos*11.607,'TOTAL LITROS'=>$kilos * 21.495,'RESUMEN VENTA'=>$canal,'TOTAL CILINDROS'=>'0','RUTA'=>$rowtipo );
array_push($ArrayGeneral, $new_array);
                      /*  $objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnum'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($row['qkgs']))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($row['qkgs']*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,0)->setCellValue('M'.$x, ($row['qlts']*$row['descuento']))->setCellValue('N'.$x, $row['LAT'].','.$row['LONGI'])->setCellValue('Z'.$x, $credito)->setCellValue('AA'.$x, $canal)->setCellValue('AB'.$x,$row['qkgs']/0.54);*/ }
                        else{
                        $new_array = array('SUB CANAL'=>$row['credito'],'CREDITO'=>$row['credito'],'TOTAL KILOS'=>$kilos*11.607,'TOTAL LITROS'=>$kilos * 21.495,'RESUMEN VENTA'=>'','TOTAL CILINDROS'=>$kilos,'RUTA'=>$rowtipo );	
array_push($ArrayGeneral, $new_array);
                       /* $objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnum'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($row['qlts']*0.54))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($row['qkgs']*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,$row['qlts']*0.54)->setCellValue('M'.$x, ($row['qlts']*$row['descuento']))->setCellValue('N'.$x, $row['LAT'].','.$row['LONGI'])->setCellValue('Z'.$x, $credito)->setCellValue('AA'.$x, $canal)->setCellValue('AB'.$x,$row['qlts'] );*/
                        }
                        
                        
                  }

      
                  } 
             
 
      
            }
            return $ArrayGeneral;
}
            
           

  function reportegenfecha($q, $d) {
	global $con;
    
$ArrayGeneral = array();
$credito = 0;
$ruta = 0; 
$canal = 0;
      $generalcontadolitros = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcontadoneto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcontadodesc = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcontadobruto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditolitros = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditoneto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditodesc = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalcreditobruto = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      
      $generalq25 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq10 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq20 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq30 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq35 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq40 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq45 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq50 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
      $generalq60 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
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


$kilos = 0;

    $sql = 'NO CARGO NADA';
    
                //$q =$_GET['q'];
    
                //$dd =$_GET['dd']; 
                //$cod = $_GET['cod'];
                
                //$q= $_GET['q'];//isset($GET['q']) ? $GET['q'] : '';
                //$d= $_GET['d'];//isset($GET['d']) ? $GET['d'] : '';
               
                $sTable = "facturas"; //$sTable = "facturas, clientes, users";
        $sWhere = " WHERE";
   
            $sTable = "facturas"; //$sTable = "facturas, clientes, users";
        $sWhere = " WHERE";
    $myArray = array();
   
            
            
            
            


$rowtipo = ''; 
$canal = '';

           
            $rutas = array("1", "2", "3","4","5", "6", "7","8","9", "10", "45","46","58", "106", "107","108","109", "110", "27","28","29", "30", "31","32","33", "34", "38","39","40", "47", "48","59","11", "17", "18","19","20", "504", "21","22","23", "24", "25","26","51","307","12", "13", "14","15","16", "404","600","601","602","603","200");
              
              $x = 1;
            
            
            
   


            //$sWhere= " WHERE (ruta = '$ruta') AND fecha LIKE '%$d%' AND (tipo = '1' OR tipo = '2')"; //AND (tipo = '0' OR tipo = '4' OR tipo = '5')
                  
          // $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC ";
           foreach($rutas as $rutar) {
           $sWhere = " WHERE (ruta = '$rutar') AND tipo != 100 AND fecha LIKE '%$d%' ";
            $sql = "SELECT * FROM  $sTable $sWhere GROUP BY fechadt ORDER BY fechadt ASC ";
             
             $query = mysqli_query($con, $sql);
            if (!$query ) {
              die('Invalid query: ' . mysql_error(). $q.$d.$dd . '  '.$sql );
           
            }
            
$rowtipo = ''; 
            while ($row=mysqli_fetch_array($query)){
                              $canal = '';
            $kilos = $row['q25'] + $row['q25r'] + ($row['q100'] * 4) + ($row['q20'] * 0.8) + ($row['q20r'] * 0.8) + ($row['q10r'] * 0.4) + ($row['q35'] * 1.2) + ($row['q35r'] * 1.4)
                + ($row['q45'] * 1.6) + ($row['q45r'] * 1.8) + ($row['q60'] * 2) + ($row['q60r'] * 2.4) ;
                
     
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
                                     $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                               }
                     if ($ruta == 200) {$canal = 'GAS TOMZA CAMION CF';
                     $index = 9;
                     $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                              }
                      if ($ruta == 602){ $canal = 'GAS TOMZA DISTRIBUIDORES';
                                    $index = 3;
                                    $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                             //  error_log("yeah c!", 0);
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
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
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                              //$generalcontadolitros[0] += $kilos * 21.495;
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'GAS TOMZA TIENDAS';
                              $index = 7;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        
                        
                        
}
            if ($ruta == 600){ $canal = 'SUPER GAS PLANTA PUBLICO';
                              $index = 10;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
            }
                     
                      if ($ruta == 603) {$canal = 'SUPER GAS CAMION DISTRIBUIDORES';
                                     $index = 13;
                                     $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                      }
if($ruta == 27 || $ruta == 28 || $ruta == 29 || $ruta == 30 || $ruta == 31 || $ruta == 32 || $ruta == 33 || $ruta == 34 || $ruta ==38 || $ruta == 39 || $ruta == 40 || $ruta == 47 || $ruta ==48 || $ruta == 59 ){
                        if( $row['tipo'] != 1 && $row['tipo'] != 2){
                              $canal = 'SUPER GAS HINOS';
                              $index = 12;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'SUPER GAS TIENDAS';
                              $index = 17;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
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
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'LA CRUZ TIENDAS';
                              $index = 21;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
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
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{ //credito
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 ||$row['tipo'] == 2){
                              $canal = 'ATLANTICO TIENDAS';
                              $index = 23;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
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
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        if( $row['tipo'] == 1 || $row['tipo'] == 2){
                              $canal = 'CEDI SUR TIENDAS';
                              $index = 27;
                              $generalq25[$index] += $row['q25'] + $row['q25r'];
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
                              $generalcontadolitros[$index] += $kilos * 21.495 ;
                              $generalcontadoneto[$index] += $row['total'];
                              $generalcontadodesc[$index] += $row['descuento'];
                              $generalcontadobruto[$index] += $row['total']+ $row['descuento'];
                              }else{
                              $generalcreditolitros[$index] += $kilos * 21.495 ;
                              $generalcreditoneto[$index] += $row['total'];
                              $generalcreditodesc[$index] += $row['descuento'];
                              $generalcreditobruto[$index] += $row['total']+ $row['descuento'];
                              }
                        }
                        

}                          


         
/*
$objPHPExcel->getActiveSheet()->setCellValue('A1' , 'FECHA')->setCellValue('B1', 'DOCUMENTO')->setCellValue('C1', 'CODIGO CLIENTE')->setCellValue('D1', 'NOMBRE CLIENTE')->setCellValue('E1', 'RAZON SOCIAL')->setCellValue('F1', 'T. COLONES')->setCellValue('G1', 'T KILOS')->setCellValue('H1', 'SUB CANAL')->setCellValue('I1', 'RUTA')->setCellValue('J1', 'SUBTOTAL')->setCellValue('K1', 'DESCUENTO UNITARIO')->setCellValue('L1', 'U. CILINDROS')->setCellValue('M1', 'DESCUENTO')->setCellValue('N1', 'COORDENADA')->setCellValue('O1', 'Presion 25')->setCellValue('P1', 'Rosca 25')->setCellValue('Q1', 'Rosca 100')->setCellValue('R1', 'Presion 20')->setCellValue('S1', 'Rosca 20')->setCellValue('T1', '35 Rosca')->setCellValue('U1', '45 Rosca')->setCellValue('V1', '10 ROSCA')->setCellValue('W1', '30 ROSCA')->setCellValue('X1', '50 ROSCA')->setCellValue('Y1', '60 ROSCA')->setCellValue('Z1', 'CREDITO')->setCellValue('AA1', 'Resumen de venta')->setCellValue('AB1', 'Total Litros')->setCellValue('AC1', 'Rosca 40');
*/
$new_array = array('SUB CANAL'=>$row['credito'],'CREDITO'=>$row['credito'],'TOTAL KILOS'=>$kilos*11.607,'TOTAL LITROS'=>$kilos * 21.495,'RESUMEN VENTA'=>$canal,'TOTAL CILINDROS'=>$kilos,'RUTA'=>$rowtipo );
array_push($ArrayGeneral, $new_array);

/*
//$objPHPExcel->getActiveSheet()->setCellValue('A'.$x, $row['nombre'])->setCellValue('B'.$x, $row['total']);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnumero'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($kilos*11.607))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($kilos*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,$kilos)->setCellValue('M'.$x, ($kilos*$row['descuento']))->setCellValue('N'.$x, $row['LAT'].','.$row['LONGI'])->setCellValue('O'.$x, $row['q25'])->setCellValue('P'.$x, $row['q25r'])->setCellValue('Q'.$x, $row['q100'])->setCellValue('R'.$x, $row['q20'])->setCellValue('S'.$x, $row['q20r'])->setCellValue('T'.$x, $row['q35r'])->setCellValue('U'.$x, $row['q45r'])->setCellValue('V'.$x, $row['q10r'])->setCellValue('W'.$x, $row['q35'])->setCellValue('X'.$x, $row['q60'])->setCellValue('Y'.$x, $row['q60r'])->setCellValue('Z'.$x, $credito)->setCellValue('AA'.$x, $canal)->setCellValue('AB'.$x,$kilos * 21.495 )->setCellValue('AC'.$x,$row['q45']);
*/
 
    
        
              
            }
            }//for each  rutas
            
            if ($q == "0"){
           // error_log(print_r("si", TRUE)); 
$rutasg = array("3001","3002","3003","3004","3005","9001","2001","2002","2003","2004","5001");
            
                  

                  foreach($rutasg as $ruta) {
                  $sWhere= " WHERE (ruta = '$ruta') AND fecha LIKE '%$d%'"; //AND (tipo = '0' OR tipo = '4' OR tipo = '5')
                  
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
                        $new_array = array('SUB CANAL'=>$row['credito'],'CREDITO'=>$row['credito'],'TOTAL KILOS'=>$kilos*11.607,'TOTAL LITROS'=>$kilos * 21.495,'RESUMEN VENTA'=>$canal,'TOTAL CILINDROS'=>'0','RUTA'=>$rowtipo );
array_push($ArrayGeneral, $new_array);
                      /*  $objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnum'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($row['qkgs']))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($row['qkgs']*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,0)->setCellValue('M'.$x, ($row['qlts']*$row['descuento']))->setCellValue('N'.$x, $row['LAT'].','.$row['LONGI'])->setCellValue('Z'.$x, $credito)->setCellValue('AA'.$x, $canal)->setCellValue('AB'.$x,$row['qkgs']/0.54);*/ }
                        else{
                        $new_array = array('SUB CANAL'=>$row['credito'],'CREDITO'=>$row['credito'],'TOTAL KILOS'=>$kilos*11.607,'TOTAL LITROS'=>$kilos * 21.495,'RESUMEN VENTA'=>'','TOTAL CILINDROS'=>$kilos,'RUTA'=>$rowtipo );	
array_push($ArrayGeneral, $new_array);
                       /* $objPHPExcel->getActiveSheet()->setCellValue('A'.$x ,$row['fecha'])->setCellValue('B'.$x, $row['ruta'].$row['facnum'])->setCellValue('C'.$x, $row['codigo'])->setCellValue('D'.$x, $row['nombre'])->setCellValue('E'.$x, $row['razon_social'])->setCellValue('F'.$x, $row['total'])->setCellValue('G'.$x, ($row['qlts']*0.54))->setCellValue('H'.$x, $rowtipo)->setCellValue('I'.$x, $row['ruta'])->setCellValue('J'.$x, ($row['total'] -($row['qkgs']*$row['descuento'])) )->setCellValue('K'.$x,$row['descuento'] )->setCellValue('L'.$x,$row['qlts']*0.54)->setCellValue('M'.$x, ($row['qlts']*$row['descuento']))->setCellValue('N'.$x, $row['LAT'].','.$row['LONGI'])->setCellValue('Z'.$x, $credito)->setCellValue('AA'.$x, $canal)->setCellValue('AB'.$x,$row['qlts'] );*/
                        }
                        
                        
                  }

      
                  } 
             
 
      
            }
            return $ArrayGeneral;
}
            
           

