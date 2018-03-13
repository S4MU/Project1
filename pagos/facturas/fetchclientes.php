<?php
include('db.php');
include('function.php');

 $query = $connection->prepare("SELECT * FROM clientecartera");
    $query->execute();
    $rows = $query->fetchAll();

    
    $options = "";
    foreach ($rows as $row) {
        $options .= '<option value="'. $row['id'] .'">'. $row['cliente'] .'</option>';
        
    }

    $response = array(
        'success' => TRUE,
        'options' => $options
    );
    
header('Content-Type: application/json');
 //error_log(var_dump($response));

echo json_encode(array_map('utf8_encode',  $response));   
//echo 'hola';
