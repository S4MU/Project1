<?php


error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');






// Create new PHPExcel object
//$objPHPExcel = new PHPExcel();
require '../functionsreport.php';
    require '../PHPivot.php';

    $q = ''; $dd = ''; $d = ''; $cod = '';
                
                
                $q= $_GET['q'];//isset($GET['q']) ? $GET['q'] : '';
                $d= $_GET['d'];//isset($GET['d']) ? $GET['d'] : '';
                
            $data = reportegenfecha('0', $d);
            echo '<a name="genre"></a><h1>Reporte <?php $d;?></h1>';
    $filmsByGenre = PHPivot::create($data)
            ->setPivotRowFields('RESUMEN VENTA')
            ->setPivotValueFields('TOTAL KILOS',PHPivot::PIVOT_VALUE_SUM, PHPivot::DISPLAY_AS_VALUE, 'TOTAL KILOS')
            //->addFilter('Genre','', PHPivot::COMPARE_NOT_EQUAL) //Filter out blanks/unknown genre
            ->generate();
    echo $filmsByGenre->toHtml();
            
           // print_r($ArrayGeneral);

           

