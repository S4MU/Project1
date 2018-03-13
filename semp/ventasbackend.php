<?php

	
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("config/db2.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos




	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_factura=intval($_GET['id']);
		$del1="delete from facturas where numero_factura='".$numero_factura."'";
		$del2="delete from detalle_factura where numero_factura='".$numero_factura."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
                //$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
                $q =$_REQUEST['q'];
                $d =$_REQUEST['d'];
		  $sTable = "facturas"; //$sTable = "facturas, clientes, users";
		 $sWhere = " WHERE";
		 //$sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id";
		 //$sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente ";
		/* if ( $_GET['d'] != "" ){
				$sWhere.= " ruta = '$q' AND fecha LIKE '%$d%'";
			}else{
				$sWhere.= " ruta = '$q'";
			}*/
			
		if ( $_GET['q'] != "" and $_GET['d'] != "")
		{
			
				$sWhere.= " ruta = '$q' AND fecha LIKE '%$d%'";
			
				
			
			
		
		//$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%')";
			
		}else{
		$sWhere = " ";
		}

		
		
		//$sWhere.=" order by facturas.id_factura desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 100; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable $sWhere GROUP BY fecha");
		
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './facturas.php';
		//main query to fetch the data
		//$sql="SELECT DISTINCT (fecha),id, codigo, razon_social, descuento, credito, total, ruta, q25, q25r, q100, q20, q20r, q10, q10r, q35, q35r, q45, q45r, q60, //q60r, LAT, LONGI, g  FROM  $sTable $sWhere LIMIT $offset,$per_page";

//Convert the date string into a unix timestamp.
$unixTimestamp = strtotime($d);
 
//Get the day of the week using PHP's date function.
$dayOfWeek = date("l", $unixTimestamp);
 
//Print out the day that our date fell on.
//echo $date . ' fell on a ' . $dayOfWeek;		
		if ($dayOfWeek == 'Monday') $ss = 'L = "1"';
		if ($dayOfWeek == 'Tuesday') $ss = 'K = "1"';
		if ($dayOfWeek == 'Wednesday') $ss = 'M = "1"';
		if ($dayOfWeek == 'Thursday') $ss = 'J = "1"';
		if ($dayOfWeek == 'Friday') $ss = 'V = "1"';
		if ($dayOfWeek == 'Saturday') $ss = 'S = "1"';
		$sql = "SELECT *
FROM  cliente WHERE ruta = '$q' AND $ss";
		$query = mysqli_query($con, $sql);
		$clientes = array();
		$clientesDia = array();
		$clientesFac = array();
		while ($row=mysqli_fetch_array($query)){
		$clientes[] = $row['nombre'];
		$mark = 1;
				if ($dayOfWeek == 'Monday' && $row['L'] == "1"){
				$clientesDia[] = $row['nombre'];
				 
				 
				 };
				if ($dayOfWeek == 'Tuesday' && $row['K'] == "1"){
				$clientesDia[] = $row['nombre'];
				 
				 
				 }; //$ss = 'K = "1"';
				if ($dayOfWeek == 'Wednesday' && $row['M'] == "1"){
				
				 $clientesDia[] = $row['nombre'];
				 
				 }; //$ss = 'M = "1"';
				if ($dayOfWeek == 'Thursday' && $row['J'] == "1"){

				 $clientesDia[] = $row['nombre'];
				 
				 }; //$ss = 'J = "1"';
				if ($dayOfWeek == 'Friday' && $row['V'] == "1"){

				 $clientesDia[] = $row['nombre'];
				 
				 }; //$ss = 'V = "1"';
				if ($dayOfWeek == 'Saturday' && $row['S'] == "1"){

				 $clientesDia[] = $row['nombre'];
				 
				 };
		
 
		}
		//print_r($clientes);
		$sql = "SELECT *
FROM  $sTable $sWhere GROUP BY fecha ORDER BY id ASC LIMIT $offset,$per_page ";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>Tipo</th>
					<th>Numero de Factura</th>
					<th>Razon Social</th>
					<th>Desc. - Total</th>
					<th>Credito</th>
					<th class='text-right'>Total</th>
					<th class='text-right'>Ruta</th>
					
					<th>Fecha emitida</th>
					<th>25</th>
					<th>25 R</th>
					<th>100 R</th>
					<th>20 P</th>
					<th>20 R</th>
					<th>10 R</th>
					<th>30 R</th>
					<th>35 R</th>
					<th>45 R </th>
					<th>40 R </th>
					<th>50 R</th>
					<th>60 R</th>
					
				</tr>
				<?php
						$lat = array();
						$longi = array();
						$i = 0;
						
						$sql4 = "SELECT *
FROM  $sTable WHERE ruta = '$q' AND fecha LIKE '%$d%' AND tipo = '100' GROUP BY fecha ORDER BY id ASC LIMIT $offset,$per_page ";
		$query4 = mysqli_query($con, $sql4);
		$totalcilza = 0;
		$kilos = 0;
						while ($row=mysqli_fetch_array($query4)){
						if ($row['credito'] == '1'){
						$totalcilza += $row['total'];
						}
						
						}
						
						
				while ($row=mysqli_fetch_array($query)){
				 //$ss = 'S = "1"';
				
				 //$rolr = $row['L'].$row['K'].$row['M'].$row['J'].$row['V'].$row['S'];

  						$clientesFac[] = $row['nombre'];
						$id_factura=0;
						$numero_factura=$row['ruta'] . $row['facnumero'];
						$fecha=$row['fecha']; //$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$nombre_cliente= $row['nombre'] ." - ".$row['razon_social'];
						$telefono_cliente=$row['descuento'];
						$email_cliente=$row['q25'];
						//$nombre_vendedor=$row['firstname']." ".$row['lastname'];
						$nombre_vendedor=$row['ruta'];
						$estado_factura=$row['credito'];
						if ($estado_factura==1){$text_estado="Pagada";$label_class='label-success';}
						else{$text_estado="Pendiente";$label_class='label-warning';}
						$total_venta=$row['total'];
						$q25=$row['q25'];
						$q25r=$row['q25r'];
						$q100=$row['q100'];
						$q20=$row['q20'];
						$q20r=$row['q20r'];
						$q10=$row['q10r'];
						$q35=$row['q35'];
						$q35r=$row['q35r'];
						$q45=$row['q45'];
						$q45r=$row['q45r'];
						$q60=$row['q60'];
						$q60r=$row['q60r'];
						
						/*$qq25+=$row['q25'];
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
						$qq60r+=$row['q60r'];*/
						
						$lat[$i++] = $row['LAT'];
						$longi[$i++] = $row['LONGI'];
						
						$kilos = $q25 + $q25r + ($q100 * 4) + ($q20 * 0.8) + ($q20r * 0.8) + ($q10 * 0.4) + ($q35 * 1.2) + ($q35r * 1.4)
				+ ($q45r * 1.8) + ($q45 * 1.6) + ($q60 * 2) + ($q60r * 2.4) ; 
				
				$telefono_cliente .= '   -   '. ($kilos * $telefono_cliente);
						
						
						$cre = $row['credito']; 
						if ($cre == 1) $contado+= $total_venta; else $credito += $total_venta

					?>
					<tr>
					<?php
					if($row['tipo'] == '100')
					echo '<td><strong>CILZA</strong></td>';
					else if($row['tipo'] == '1' || $row['tipo'] == '2' )
					echo '<td><mark>TIENDA</mark></td>';
					else
					echo '<td>ok</td>';

					
					?>
						
						<td><?php echo $numero_factura; ?></td>

						<td><a target="_blank" href=<?php echo '"http://www.google.com/maps/place/'.$row['LAT'].','.$row['LONGI'].'"'?> ><?php if($mark == 1) echo "FUERA ROL: ".$rolr." - ".$nombre_cliente; else echo $nombre_cliente;?></a></td>
						<td><?php echo $telefono_cliente; ?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td class='text-right'><?php echo number_format ($total_venta,2); ?></td>	
						<td><?php echo $nombre_vendedor; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $q25; ?></td>
						<td><?php echo $q25r; ?></td>
						<td><?php echo $q100; ?></td>
						<td><?php echo $q20; ?></td>
						<td><?php echo $q20r; ?></td>
						<td><?php echo $q10; ?></td>
						<td><?php echo $q35; ?></td>
						<td><?php echo $q35r; ?></td>
						<td><?php echo $q45r; ?></td>
						<td><?php echo $q45; ?></td>
						<td><?php echo $q60; ?></td>
						<td><?php echo $q60r; ?></td>
						
										
					<td class="text-right">
						<a href="editar_factura.php?id_factura=<?php echo $id_factura;?>" class='btn btn-default' title='Editar factura' ><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default' title='Descargar factura' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar factura' onclick="eliminar('<?php echo $numero_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php
				}
				
$result = array_diff($clientes, $clientesFac);
$result2 = array_diff($clientesDia, $clientesFac); 

//print_r($result);
//echo 'aqui';

echo '<table border="2">';
echo "<Strong>Clientes no Visitados<Strong>";
foreach($result as $values)
{

echo "<tr><td>";

echo "$values";

echo "</td></tr>";
}	
echo '<table border="2">';
echo "<Strong>Clientes Fuera de Rol<Strong>";
foreach($result2 as $values)
{

echo "<tr><td>";

echo "$values";

echo "</td></tr>";
}			
				if ( $_GET['q'] != "" and $_GET['d'] != "")
		{
			
				
			$count_query  = mysqli_query($con, "SELECT * FROM billete WHERE ruta = '$q' ORDER BY fecha DESC");
		
				$row= mysqli_fetch_array($count_query);
				$mk = $row['50k'];
				$ak = $row['20k'];
				$vk = $row['10k'];
				$amk = $row['5k'];
				$azk = $row['2k'];
				$rk = $row['1k'];
				$qui = $row['qui'];
				$cien = $row['cien'];
				$cin = $row['cin'];
				$vein = $row['vein'];
				$diez = $row['diez'];
				$cinco = $row['cinco'];
				$dolares = $row['dolares'];
				$vale = $row['vale'];
				
		




				$Total = ($contado-$vale);
				
				
			
			
		
		
			
		}
						
				
				
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			  <table class="table">
				<tr  class="info">
					<th>#</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th class='text-right'></th>
					<th class='text-right'></th>
					
					<th>Cilindros</th>
					<th>25</th>
					<th>25 R</th>
					<th>100 R</th>
					<th>20 P</th>
					<th>20 R</th>
					<th>10</th>
					<th>10 R</th>
					<th>35 R</th>
					<th>45 R </th>
					<th>40 R </th>
					<th>50 R</th>
					<th>60 R</th>
					
				</tr>

				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td>Totales:</td>
				                
				                
				                <td><?php echo $qq25; ?></td>
						<td><?php echo $qq25r; ?></td>
						<td><?php echo $qq100; ?></td>
						<td><?php echo $qq20; ?></td>
						<td><?php echo $qq20r; ?></td>
						<td><?php echo $qq10; ?></td>
						<td><?php echo $qq35; ?></td>
						<td><?php echo $qq35r; ?></td>
						<td><?php echo $qq45r; ?></td>
						<td><?php echo $qq45; ?></td>
						<td><?php echo $qq60; ?></td>
						<td><?php echo $qq60r; ?></td>
						
						
				</table>
				
				Total de cilindros: <?php echo $qq25 + $qq25r + ($qq100 * 4) + ($qq20 * 0.8) + ($qq20r * 0.8) + ($qq10 * 0.4) + ($qq35 * 1.2) + ($qq35r * 1.4)
				+ ($qq45r * 1.8) + ($qq45 * 1.8) + ($qq60 * 2) + ($qq60r * 2.4) ; ?></br>
				
				Total Kilos: <?php echo ($qq25 + $qq25r + ($qq100 * 4) + ($qq20 * 0.8) + ($qq20r * 0.8) + ($qq10 * 0.4) + ($qq35 * 1.2) + ($qq35r * 1.4)
				+ ($qq45r * 1.8) + ($qq45 * 1.8) + ($qq60 * 2) + ($qq60r * 2.4)) * 11.607 ; ?></br>
				
				Total de Litros: <?php echo (($qq25 + $qq25r + ($qq100 * 4) + ($qq20 * 0.8) + ($qq20r * 0.8) + ($qq10 * 0.4) + ($qq35 * 1.2) + ($qq35r * 1.4)
				+ ($qq45r * 1.8) + ($qq45 * 1.8) + ($qq60 * 2) + ($qq60r * 2.4)) * 11.607) / 0.54 ; ?></br>
			  
			  
			  <div>
			  <br />
			  Total Cilza Contado : <?php
					 echo $totalcilza;
					?><br /><br />
			 Total Tomza Contado: <?php
					 echo $contado - $totalcilza;
					?><br /><br />
			   Total Contado: <?php
					 echo $contado;
					?> <br /><br />
			  Total Creditos: <?php
					 echo $credito;
					?><br /><br />
			  (Vale) : <?php
					 echo $vale;
					?><br />


			  Total General : <?php
					 echo $Total;
					?><br />
					
			  Venta Total:<br />
			  Descuento Total:<br />
			  Venta Neta:<br />	
			  
			  Venta Credito:<br />
			  Descuento Credito:<br />
			  
			  Venta Contado(1)<br />
			  Descuento Contado(2)<br />
			  
			  Efectivo a recibir(3):<br />
			  
			  ------------------Gastos --------------------<br />
			  Vale<br />
			  Total Gastos(4):<br />
			  
			  Efectivo Neto a recibir:<br />
			  
			  ------------------Deglose Efectivo--------------------<br />
			  	
			  

			  
			   <?php
					 echo '50 mil X ' .$mk. ' = ' . ($mk * 50) . '<br>';
					 echo '20 mil X ' .$ak. ' = ' . ($ak* 20). '<br>';
					 echo '10 mil X ' .$vk. ' = ' . ($vk* 10). '<br>';
					 echo '5 mil X ' .$amk. ' = ' . ($amk* 5). '<br>';
					 echo '2 mil X ' .$azk. ' = ' . ($azk* 2). '<br>';
					 echo '1 mil X ' .$rk. ' = ' . ($rk* 1). '<br>';
					 echo '500 X ' .$qui. ' = ' . ($qui* 500). '<br>';
					 echo '100 mil X ' .$cien. ' = ' . ($cien* 100). '<br>';
					 echo '50 mil X ' .$cin. ' = ' . ($cin* 50). '<br >';
					 echo '25 mil X ' .$vein. ' = ' . ($vein* 25). '<br >';
					 echo '10 mil X ' .$diez. ' = ' . ($diez* 10). '<br >';
					 echo '5 mil X ' .$cinco. ' = ' . ($cinco* 5). '<br >';
					 echo 'Total billetes:';
					 echo 'Total Monedas>:';
					 
					 
					?>
					 Dolares : <?php
					 echo $dolares;
					?><br />
			------------------Cheques y Transferencias--------------------<br />
				 <table class="table">
				<tr  class="info">
					<th>#</th>
					<th>Cheque</th>
					<th>Cliente</th>
					<th>Banco</th>
					<th>Monto</th>
				</tr>
				</table>

			
			  </div>

			</div>
			
			
			<?php

			
		}
		

	}
?>