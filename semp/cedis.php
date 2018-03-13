<?php
	/*-------------------------
	Kevin Martinez
	---------------------------*/
	/*session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }*/
        require_once ("config/db2.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Reporte General | Tomza CR";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>

  </head>
      
  <body>

	<?php
	include("navbar.php");
	?>  
    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<a  onclick="this.href='nexus.php?q='+document.getElementById('q').value+'&d='   
                      +document.getElementById('d').value;
           somefunction(this, event); return true;" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span>Exportar a excel</a>
			
			</div>
					
			<h4><i class='glyphicon glyphicon-search'></i> Reporte GPS</h4>
		</div>
		
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				<div class="form-group row">
						
							<label for="q" class="col-md-2 control-label">Ruta:</label>
							<div class="col-md-2">
							<select id="q" onchange="initMap();">
							  <optgroup label="Reportes">
							    <option value="0">General Nacional</option> 
							    <option value="111">Tiendas</option>
							    <option value="222">Pulperias</option>
							    <option value="333">Granel</option>
							    
							  </optgroup>
							  <optgroup label="Cartago">
							    <option value="1">Todas las rutas</option>
							    <option value="11">Tiendas</option>
							    <option value="12">Pulperias</option>
							    <option value="13">Granel</option>
							    <option value="1R">Ruta 1</option>
							    <option value="2R">Ruta 2</option>
							    <option value="3R">Ruta 3</option>
							    <option value="4R">Ruta 4</option>
							    <option value="5R">Ruta 5</option>
							    <option value="6R">Ruta 6</option>
							    <option value="7R">Ruta 7</option>
							    <option value="8R">Ruta 8</option>
							    <option value="9R">Ruta 9</option>
							    <option value="10R">Ruta 10</option>
							    <option value="45R">Ruta 45</option>
							    <option value="46R">Ruta 46</option>
							    <option value="58R">Ruta 58</option>
							    <option value="106R">Ruta 106</option>
							    <option value="107R">Ruta 107</option>
							    <option value="108R">Ruta 108</option>
							    <option value="109R">Ruta 109</option>
	    						    <option value="110R">Ruta 110</option>
	    						    <option value="200R">Ruta VIP 200</option>
	    						    <option value="601R">Planta 601</option>
	    						    <option value="602R">Distribuidores 602</option>  

							    
							  </optgroup>
							  <optgroup label="Super Gas">
							    <option value="2">Todas las rutas</option>
							    <option value="21">Tiendas</option>
							    <option value="22">Pulperias</option>
							    <option value="23">Granel</option>
							     <option value="27R">Ruta 27</option>
							    <option value="28R">Ruta 28</option>
							    <option value="29R">Ruta 29</option>
							    <option value="30R">Ruta 30</option>
							    <option value="31R">Ruta 31</option>
							    <option value="32R">Ruta 32</option>
							    <option value="33R">Ruta 33</option>
							    <option value="34R">Ruta 34</option>
							    <option value="38R">Ruta 38</option>
							    <option value="39R">Ruta 39</option>
							    <option value="40R">Ruta 40</option>
							    <option value="47R">Ruta 47</option>
							    <option value="48R">Ruta 48</option>
							    <option value="59R">Ruta 59</option>
							    <option value="600R">Planta 600</option>
							    <option value="603R">Distribuidores 603</option>
							    
							  </optgroup>
							  <optgroup label="Atlatico">
							    <option value="3">Todas las rutas</option>
							    <option value="31">Tiendas</option>
							    <option value="32">Pulperias</option>
							     <option value="11">Ruta 11</option>
							    <option value="17R">Ruta 17</option>
							    <option value="18R">Ruta 18</option>
							    <option value="19R">Ruta 19</option>
							    <option value="20R">Ruta 20</option>
							    <option value="504R">Ruta 504</option>
							    
							  </optgroup>
							  <optgroup label="Perez">
							    <option value="4">Todas las rutas</option>
							    <option value="41">Tiendas</option>
							    <option value="42">Pulperias</option>
							    <option value="43">Granel</option>
							    <option value="21R">Ruta 21</option>
							    <option value="22R">Ruta 22</option>
							    <option value="23R">Ruta 23</option>
							    <option value="24R">Ruta 24</option>
							    <option value="25R">Ruta 25</option>
							    <option value="26R">Ruta 26</option>
							    <option value="51R">Ruta 51</option>
							    <option value="307R">Ruta 307</option>
							  </optgroup>
							  <optgroup label="La cruz">
							    <option value="5">Todas las rutas</option>
							    <option value="51">Tiendas</option>
							    <option value="52">Pulperias</option>
							    <option value="53">Granel</option>
							    <option value="12R">Ruta 12</option>
							    <option value="13R">Ruta 13</option>
							    <option value="14R">Ruta 14</option>
							    <option value="15R">Ruta 15</option>
							    <option value="16R">Ruta 16</option>
							    <option value="404R">Ruta 404</option>
							    
							  </optgroup>
							</select>
							
							</div>
							<label for="d" class="col-md-2 control-label">Fecha:</label>
							<div class="col-md-2">
								<p><input type="text" id="d" placeholder="Fecha" onchange="initMap();"></p>
							</div>
							
							
							
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='initMap();'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
			
		        
		      
		        
			
			<div id="map" style="width:700px; height:500px; margin-left:80px;" ></div>

				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
			 
		</div>	
		
		<table class="table">
				<tr  class="info">
					<th>#</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th class='text-right'></th>
					<th class='text-right'></th>
					
					<th>Cartago:</th>
					<th>25</th>
					<th>25 R</th>
					<th>100 R</th>
					<th>20</th>
					<th>20 R</th>
					<th>30 R</th>
					<th>10 R</th>
					<th>35 R</th>
					<th>45 R </th>
					<th>40 R </th>
					<th>50 R</th>
					<th>60 R</th>
					<th>Total</th>
					
				</tr>

				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td>Totales:</td>
				                
				                
				                <td id = "cq25"></td>
				                <td id = "cq25r"></td>
				                <td id = "cq100r"></td>
				                <td id = "cq20"></td>
				                <td id = "cq20r"></td>
				                <td id = "cq30"></td>
				                <td id = "cq10r"></td>
				                <td id = "cq35r"></td>
				                <td id = "cq45r"></td>
				                <td id = "cq40r"></td>
				                <td id = "cq50r"></td>
				                <td id = "cq60r"></td>
				                <td id = "cqtt"></td>
						
						
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
					
					<th>Alajuela:</th>
					<th>25</th>
					<th>25 R</th>
					<th>100 R</th>
					<th>20</th>
					<th>20 R</th>
					<th>30 R</th>
					<th>10 R</th>
					<th>35 R</th>
					<th>45 R </th>
					<th>40 R </th>
					<th>50 R</th>
					<th>60 R</th>
					<th>Total</th>
					
				</tr>

				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td>Totales:</td>
				                
				                
				                <td id = "aq25"></td>
				                <td id = "aq25r"></td>
				                <td id = "aq100r"></td>
				                <td id = "aq20"></td>
				                <td id = "aq20r"></td>
				                <td id = "aq30"></td>
				                <td id = "aq10r"></td>
				                <td id = "aq35r"></td>
				                <td id = "aq45r"></td>
				                <td id = "aq40r"></td>
				                <td id = "aq50r"></td>
				                <td id = "aq60r"></td>
				                <td id = "aqtt"></td>
						
						
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
					
					<th>Atlantico:</th>
					<th>25</th>
					<th>25 R</th>
					<th>100 R</th>
					<th>20</th>
					<th>20 R</th>
					<th>30 R</th>
					<th>10 R</th>
					<th>35 R</th>
					<th>45 R </th>
					<th>40 R </th>
					<th>50 R</th>
					<th>60 R</th>
					<th>Total</th>
					
				</tr>

				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td>Totales:</td>
				                
				                
				                <td id = "atq25"></td>
				                <td id = "atq25r"></td>
				                <td id = "atq100r"></td>
				                <td id = "atq20"></td>
				                <td id = "atq20r"></td>
				                <td id = "atq30"></td>
				                <td id = "atq10r"></td>
				                <td id = "atq35r"></td>
				                <td id = "atq45r"></td>
				                <td id = "atq40r"></td>
				                <td id = "atq50r"></td>
				                <td id = "atq60r"></td>
				                <td id = "atqtt"></td>
						
						
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
					
					<th>Perez Zeledon:</th>
					<th>25</th>
					<th>25 R</th>
					<th>100 R</th>
					<th>20</th>
					<th>20 R</th>
					<th>30 R</th>
					<th>10 R</th>
					<th>35 R</th>
					<th>45 R </th>
					<th>40 R </th>
					<th>50 R</th>
					<th>60 R</th>
					<th>Total</th>
					
				</tr>

				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td>Totales:</td>
				                
				                
				                <td id = "pq25"></td>
				                <td id = "pq25r"></td>
				                <td id = "pq100r"></td>
				                <td id = "pq20"></td>
				                <td id = "pq20r"></td>
				                <td id = "pq30"></td>
				                <td id = "pq10r"></td>
				                <td id = "pq35r"></td>
				                <td id = "pq45r"></td>
				                <td id = "pq40r"></td>
				                <td id = "pq50r"></td>
				                <td id = "pq60r"></td>
				                <td id = "pqtt"></td>
						
						
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
					
					<th>La cruz:</th>
					<th>25</th>
					<th>25 R</th>
					<th>100 R</th>
					<th>20</th>
					<th>20 R</th>
					<th>30 R</th>
					<th>10 R</th>
					<th>35 R</th>
					<th>45 R </th>
					<th>40 R </th>
					<th>50 R</th>
					<th>60 R</th>
					<th>Total</th>
					
				</tr>

				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td>Totales:</td>
				                
				                
				                <td id = "lq25"></td>
				                <td id = "lq25r"></td>
				                <td id = "lq100r"></td>
				                <td id = "lq20"></td>
				                <td id = "lq20r"></td>
				                <td id = "lq30"></td>
				                <td id = "lq10r"></td>
				                <td id = "lq35r"></td>
				                <td id = "lq45r"></td>
				                <td id = "lq40r"></td>
				                <td id = "lq50r"></td>
				                <td id = "lq60r"></td>
				                <td id = "lqtt"></td>
						
						
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
					<th>20</th>
					<th>20 R</th>
					<th>30 R</th>
					<th>10 R</th>
					<th>35 R</th>
					<th>45 R </th>
					<th>40 R </th>
					<th>50 R</th>
					<th>60 R</th>
					<th>Total</th>
					
				</tr>

				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td>Totales:</td>
				                
				                
				                <td id = "q25"></td>
				                <td id = "q25r"></td>
				                <td id = "q100r"></td>
				                <td id = "q20"></td>
				                <td id = "q20r"></td>
				                <td id = "q30"></td>
				                <td id = "q10r"></td>
				                <td id = "q35r"></td>
				                <td id = "q45r"></td>
				                <td id = "q40r"></td>
				                <td id = "q50r"></td>
				                <td id = "q60r"></td>
				                <td id = "qtt"></td>
						
						
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
					
					<th>Granel:</th>
					<th>LTS</th>
					<th>KGS</th>
					
					
				</tr>

				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td><></td>
				                <td>Totales:</td>
				                
				                
				                <td id = "clts"></td>
				                <td id = "ckgs"></td>
				               
						
						
				</table>
				
				
				
				<p id="totalc">Total: </p>
				<p id="totalk">Total: </p>
				<p id="totall">Total: </p>
	</div>

	<hr>
	
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	
	  <script>
	  	 function excel(){
	  	 var q= $("#q").val();
         var d= $("#d").val();
          $.ajax({
        url:'nexus.php?q='+q+'&d='+d,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
        	//alert(data);
          
          $('#loader').html('');
            window.open('http://tomzacr.com/semp/cedis.php','_blank' );
          
          }
      });
      }


	  var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      	  var labelIndex = 0;
      	  var poly;

	  function initMap(){
	  
	  var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(9.9363912,-84.0916548),
          zoom: 8
        });


        var coords = [];
        
       
        
        //var infoWindow = new google.maps.InfoWindow;
        
	  var q= $("#q").val();
       var d= $("#d").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'map2.php?q='+q+'&d='+d,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          
          $('#loader').html('');
           txt = "";
           myObj = JSON.parse(data);
           labelIndex = 0;
           var q25 = 0;var q25r = 0;var q100r = 0;var q20 = 0;var q20r = 0;var q10 = 0;var q10r = 0;var q30 = 0;
           var q35r = 0;var q40r = 0;var q45r = 0;var q50r = 0;var q60r = 0;var lts = 0;var kgs = 0;
           var qtt;
           
           var aq25 = [0,0,0,0,0];var aq25r =[0,0,0,0,0];var aq100r = [0,0,0,0,0];var aq20 = [0,0,0,0,0];var aq20r = [0,0,0,0,0];var aq10 =[0,0,0,0,0];var aq10r = [0,0,0,0,0];var aq30 = [0,0,0,0,0];
           var aq35r = [0,0,0,0,0];var aq40r = [0,0,0,0,0];var aq45r = [0,0,0,0,0];var aq50r = [0,0,0,0,0];var aq60r = [0,0,0,0,0];
           var aqtt = [0,0,0,0,0];
           
        
           
        for (x in myObj) {
              var name = myObj[x].razon_social;
              var address = myObj[x].fecha;
              var type = "bar";
              //Sumar consolidado
              q25 += parseInt(myObj[x].q25);
              q25r += parseInt(myObj[x].q25r);
              q100r += parseInt(myObj[x].q100);
              q20 += parseInt(myObj[x].q20);
              q20r += parseInt(myObj[x].q20r);
              q10r += parseInt(myObj[x].q10r);
              q30 += parseInt(myObj[x].q35);
              q35r += parseInt(myObj[x].q35r);
              q40r += parseInt(myObj[x].q45);
              q45r += parseInt(myObj[x].q45r);
              q50r += parseInt(myObj[x].q60);
              q60r += parseInt(myObj[x].q60r);
              
              lts += parseInt(myObj[x].qlts);
              kgs += parseInt(myObj[x].qkgs);
              
              
   if(myObj[x].ruta == "1" || myObj[x].ruta == "2" || myObj[x].ruta == "3" || myObj[x].ruta == "4" || myObj[x].ruta == "5" || myObj[x].ruta == "6" || myObj[x].ruta == "7" || myObj[x].ruta == "8" || myObj[x].ruta == "9" || myObj[x].ruta == "10" || myObj[x].ruta == "45" || myObj[x].ruta == "46" || myObj[x].ruta == "58" || myObj[x].ruta == "106" || myObj[x].ruta == "107" || myObj[x].ruta == "108" || myObj[x].ruta == "109" || myObj[x].ruta == "110" || myObj[x].ruta == "200")
              {
              aq25[0] += parseInt(myObj[x].q25);
              aq25r[0] += parseInt(myObj[x].q25r);
              aq100r[0] += parseInt(myObj[x].q100);
              aq20[0] += parseInt(myObj[x].q20);
              aq20r[0] += parseInt(myObj[x].q20r);
              aq10r[0] += parseInt(myObj[x].q10r);
              aq30[0] += parseInt(myObj[x].q35);
              aq35r[0] += parseInt(myObj[x].q35r);
              aq40r[0] += parseInt(myObj[x].q45);
              aq45r[0] += parseInt(myObj[x].q45r);
              aq50r[0] += parseInt(myObj[x].q60);
              aq60r[0] += parseInt(myObj[x].q60r);
             
              
              }
              if(myObj[x].ruta == "27" || myObj[x].ruta == "28" || myObj[x].ruta == "29" || myObj[x].ruta == "30" || myObj[x].ruta == "31" || myObj[x].ruta == "32" || myObj[x].ruta == "33" || myObj[x].ruta == "34" || myObj[x].ruta == "38" || myObj[x].ruta == "39" || myObj[x].ruta == "40" || myObj[x].ruta == "47" || myObj[x].ruta == "48" || myObj[x].ruta == "59")
              {
              aq25[1] += parseInt(myObj[x].q25);
              aq25r[1] += parseInt(myObj[x].q25r);
              aq100r[1] += parseInt(myObj[x].q100);
              aq20[1] += parseInt(myObj[x].q20);
              aq20r[1] += parseInt(myObj[x].q20r);
              aq10r[1] += parseInt(myObj[x].q10r);
              aq30[1] += parseInt(myObj[x].q35);
              aq35r[1] += parseInt(myObj[x].q35r);
              aq40r[1] += parseInt(myObj[x].q45);
              aq45r[1] += parseInt(myObj[x].q45r);
              aq50r[1] += parseInt(myObj[x].q60);
              aq60r[1] += parseInt(myObj[x].q60r);
               
              
              }
              if(myObj[x].ruta == "11" || myObj[x].ruta == "17" || myObj[x].ruta == "18" || myObj[x].ruta == "19" || myObj[x].ruta == "20" || myObj[x].ruta == "504" )
              {
              aq25[2] += parseInt(myObj[x].q25);
              aq25r[2] += parseInt(myObj[x].q25r);
              aq100r[2] += parseInt(myObj[x].q100);
              aq20[2] += parseInt(myObj[x].q20);
              aq20r[2] += parseInt(myObj[x].q20r);
              aq10r[2] += parseInt(myObj[x].q10r);
              aq30[2] += parseInt(myObj[x].q35);
              aq35r[2] += parseInt(myObj[x].q35r);
              aq40r[2] += parseInt(myObj[x].q45);
              aq45r[2] += parseInt(myObj[x].q45r);
              aq50r[2] += parseInt(myObj[x].q60);
              aq60r[2] += parseInt(myObj[x].q60r);
            
              
              }
              
  if(myObj[x].ruta == "21" || myObj[x].ruta == "51" || myObj[x].ruta == "22" || myObj[x].ruta == "23" || myObj[x].ruta == "24" || myObj[x].ruta == "25" || myObj[x].ruta == "26" || myObj[x].ruta == "307")
              {
              aq25[3] += parseInt(myObj[x].q25);
              aq25r[3] += parseInt(myObj[x].q25r);
              aq100r[3] += parseInt(myObj[x].q100);
              aq20[3] += parseInt(myObj[x].q20);
              aq20r[3] += parseInt(myObj[x].q20r);
              aq10r[3] += parseInt(myObj[x].q10r);
              aq30[3] += parseInt(myObj[x].q35);
              aq35r[3] += parseInt(myObj[x].q35r);
              aq40r[3] += parseInt(myObj[x].q45);
              aq45r[3] += parseInt(myObj[x].q45r);
              aq50r[3] += parseInt(myObj[x].q60);
              aq60r[3] += parseInt(myObj[x].q60r);
               
              
              
              }
              
              if(myObj[x].ruta == "12" || myObj[x].ruta == "13" || myObj[x].ruta == "14" || myObj[x].ruta == "15" || myObj[x].ruta == "16" || myObj[x].ruta == "404")
              {
              aq25[4] += parseInt(myObj[x].q25);
              aq25r[4] += parseInt(myObj[x].q25r);
              aq100r[4] += parseInt(myObj[x].q100);
              aq20[4] += parseInt(myObj[x].q20);
              aq20r[4] += parseInt(myObj[x].q20r);
              aq10r[4] += parseInt(myObj[x].q10r);
              aq30[4] += parseInt(myObj[x].q35);
              aq35r[4] += parseInt(myObj[x].q35r);
              aq40r[4] += parseInt(myObj[x].q45);
              aq45r[4] += parseInt(myObj[x].q45r);
              aq50r[4] += parseInt(myObj[x].q60);
              aq60r[4] += parseInt(myObj[x].q60r);
              
              
              }
               if(myObj[x].ruta == "3001" || myObj[x].ruta == "3002" || myObj[x].ruta == "3003" || myObj[x].ruta == "3004")
              {
              aq25[4] += parseInt(myObj[x].q25);
              aq25r[4] += parseInt(myObj[x].q25r);
              aq100r[4] += parseInt(myObj[x].q100);
              aq20[4] += parseInt(myObj[x].q20);
              aq20r[4] += parseInt(myObj[x].q20r);
              aq10r[4] += parseInt(myObj[x].q10r);
              aq30[4] += parseInt(myObj[x].q35);
              aq35r[4] += parseInt(myObj[x].q35r);
              aq40r[4] += parseInt(myObj[x].q45);
              aq45r[4] += parseInt(myObj[x].q45r);
              aq50r[4] += parseInt(myObj[x].q60);
              aq60r[4] += parseInt(myObj[x].q60r);
              
              }
              
              
        var point = {
                  lat:parseFloat(myObj[x].LAT),
                  lng:parseFloat(myObj[x].LONGI)};
                  var st = "";
                  if(parseInt(myObj[x].q100) > 0)
                  	st += "<b>100 lbs: </b>" + (parseInt(myObj[x].q100)).toString() + "</br>";
                  if(parseInt(myObj[x].q10r) > 0)
                  	st += "<b>10 lbs: </b>" + (parseInt(myObj[x].q10r) ).toString()+ "</br>";
                  if(parseInt(myObj[x].q20r) + parseInt(myObj[x].q20) > 0)
                  	st += "<b>20 lbs: </b>" + (parseInt(myObj[x].q20r) + parseInt(myObj[x].q20)).toString()+ "</br>";
                  if(parseInt(myObj[x].q25r) + parseInt(myObj[x].q25) > 0)
                  	st += "<b>25 lbs: </b>" + (parseInt(myObj[x].q25r) + parseInt(myObj[x].q25)).toString()+ "</br>";

                  if(parseInt(myObj[x].q35r) > 0)
                  	st += "<b>35 lbs: </b>" + (parseInt(myObj[x].q35r)).toString()+ "</br>";
                  if(parseInt(myObj[x].q45r) > 0)
                  	st += "<b>45 lbs: </b>" + (parseInt(myObj[x].q45r)).toString()+ "</br>";
                  	
                  st += myObj[x].fecha;
                  	
                  
                  var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h4 id="firstHeading" class="firstHeading"> Ruta:'+ myObj[x].ruta + ' - '+name + ' @ ' +((parseInt(myObj[x].q25) * 11.33) + (parseInt(myObj[x].q25r) * 11.33) + 
            (parseInt(myObj[x].q100) * 45) +(parseInt(myObj[x].q35) * 1.2 * 11.33)+(parseInt(myObj[x].q35r) * 1.4 * 11.33)+(parseInt(myObj[x].q45) * 1.6 * 11.33)+(parseInt(myObj[x].q45r) * 1.8 * 11.33) + (parseInt(myObj[x].q20r) * 0.8* 11.33) + (parseInt(myObj[x].q20) * 0.8 * 11.33)).toString() + ' kgs'+'</h4>'+
            '<div id="bodyContent">'+ 
            '</p>'+ st +
            '<p>Reporte de rentabilidad:'+
            '(Tomza.co.cr).</p>'+
            '</div>'+
            '</div>';
                  
      
              var infowindow = new google.maps.InfoWindow({
          content: contentString 
        });

               
              
              
         
              
              var t = tm(point ,map,infowindow ,contentString);
              
              
             
        
            }//end for
             qtt = (q25r+q25+(q100r*4)+(q20r*0.8)+(q20*0.8)+(q30*1.2) +(q10r*0.4)+(q35r*1.4)+(q40r*1.6)+(q45r*1.8)+(q50r*2)+(q60r*2.4) );
              aqtt[0] = (aq25[0]+aq25r[0]+(aq100r[0]*4)+(aq20r[0]*0.8)+(aq20[0]*0.8)+(aq30[0]*1.2) +(aq10r[0]*0.4)+(aq35r[0]*1.4)+(aq40r[0]*1.6)+(aq45r[0]*1.8)+(aq50r[0]*2)+(aq60r[0]*2.4) );
              aqtt[1] = (aq25[1]+aq25r[1]+(aq100r[1]*4)+(aq20r[1]*0.8)+(aq20[1]*0.8)+(aq30[1]*1.2) +(aq10r[1]*0.4)+(aq35r[1]*1.4)+(aq40r[1]*1.6)+(aq45r[1]*1.8)+(aq50r[1]*2)+(aq60r[1]*2.4) );
              aqtt[2] = (aq25[2]+aq25r[2]+(aq100r[2]*4)+(aq20r[2]*0.8)+(aq20[2]*0.8)+(aq30[2]*1.2) +(aq10r[2]*0.4)+(aq35r[2]*1.4)+(aq40r[2]*1.6)+(aq45r[2]*1.8)+(aq50r[2]*2)+(aq60r[2]*2.4) );
              aqtt[3] = (aq25[3]+aq25r[3]+(aq100r[3]*4)+(aq20r[3]*0.8)+(aq20[3]*0.8)+(aq30[3]*1.2) +(aq10r[3]*0.4)+(aq35r[3]*1.4)+(aq40r[3]*1.6)+(aq45r[3]*1.8)+(aq50r[3]*2)+(aq60r[3]*2.4) );
              aqtt[4] = (aq25[4]+aq25r[4]+(aq100r[4]*4)+(aq20r[4]*0.8)+(aq20[4]*0.8)+(aq30[4]*1.2) +(aq10r[4]*0.4)+(aq35r[4]*1.4)+(aq40r[4]*1.6)+(aq45r[4]*1.8)+(aq50r[4]*2)+(aq60r[4]*2.4) );
            document.getElementById("clts").innerHTML = lts;
            document.getElementById("ckgs").innerHTML = kgs;

            document.getElementById("q25").innerHTML = q25;
            document.getElementById("q25r").innerHTML = q25r;
            document.getElementById("q100r").innerHTML = q100r;
            document.getElementById("q20").innerHTML = q20;
            document.getElementById("q20r").innerHTML = q20r;
            document.getElementById("q30").innerHTML = q30;
            document.getElementById("q10r").innerHTML = q10r;
            document.getElementById("q35r").innerHTML = q35r;
            document.getElementById("q40r").innerHTML = q40r;
            document.getElementById("q45r").innerHTML = q45r;
            document.getElementById("q50r").innerHTML = q50r;
            document.getElementById("q60r").innerHTML = q60r;
            document.getElementById("qtt").innerHTML = qtt;
            
                        document.getElementById("cq25").innerHTML = aq25[0];
            document.getElementById("cq25r").innerHTML = aq25r[0];
            document.getElementById("cq100r").innerHTML = aq100r[0];
            document.getElementById("cq20").innerHTML = aq20[0];
            document.getElementById("cq20r").innerHTML = aq20r[0];
            document.getElementById("cq30").innerHTML = aq30[0];
            document.getElementById("cq10r").innerHTML = aq10r[0];
            document.getElementById("cq35r").innerHTML = aq35r[0];
            document.getElementById("cq40r").innerHTML = aq40r[0];
            document.getElementById("cq45r").innerHTML = aq45r[0];
            document.getElementById("cq50r").innerHTML = aq50r[0];
            document.getElementById("cq60r").innerHTML = aq60r[0];
            document.getElementById("cqtt").innerHTML = aqtt[0].toFixed(2);
            
             document.getElementById("aq25").innerHTML = aq25[1];
            document.getElementById("aq25r").innerHTML = aq25r[1];
            document.getElementById("aq100r").innerHTML = aq100r[1];
            document.getElementById("aq20").innerHTML = aq20[1];
            document.getElementById("aq20r").innerHTML = aq20r[1];
            document.getElementById("aq30").innerHTML = aq30[1];
            document.getElementById("aq10r").innerHTML = aq10r[1];
            document.getElementById("aq35r").innerHTML = aq35r[1];
            document.getElementById("aq40r").innerHTML = aq40r[1];
            document.getElementById("aq45r").innerHTML = aq45r[1];
            document.getElementById("aq50r").innerHTML = aq50r[1];
            document.getElementById("aq60r").innerHTML = aq60r[1];
            document.getElementById("aqtt").innerHTML = aqtt[1].toFixed(2);
            
            document.getElementById("atq25").innerHTML = aq25[2];
            document.getElementById("atq25r").innerHTML = aq25r[2];
            document.getElementById("atq100r").innerHTML = aq100r[2];
            document.getElementById("atq20").innerHTML = aq20[2];
            document.getElementById("atq20r").innerHTML = aq20r[2];
            document.getElementById("atq30").innerHTML = aq30[2];
            document.getElementById("atq10r").innerHTML = aq10r[2];
            document.getElementById("atq35r").innerHTML = aq35r[2];
            document.getElementById("atq40r").innerHTML = aq40r[2];
            document.getElementById("atq45r").innerHTML = aq45r[2];
            document.getElementById("atq50r").innerHTML = aq50r[2];
            document.getElementById("atq60r").innerHTML = aq60r[2];
            document.getElementById("atqtt").innerHTML = aqtt[2].toFixed(2);
            
            document.getElementById("pq25").innerHTML = aq25[3];
            document.getElementById("pq25r").innerHTML = aq25r[3];
            document.getElementById("pq100r").innerHTML = aq100r[3];
            document.getElementById("pq20").innerHTML = aq20[3];
            document.getElementById("pq20r").innerHTML = aq20r[3];
            document.getElementById("pq30").innerHTML = aq30[3];
            document.getElementById("pq10r").innerHTML = aq10r[3];
            document.getElementById("pq35r").innerHTML = aq35r[3];
            document.getElementById("pq40r").innerHTML = aq40r[3];
            document.getElementById("pq45r").innerHTML = aq45r[3];
            document.getElementById("pq50r").innerHTML = aq50r[3];
            document.getElementById("pq60r").innerHTML = aq60r[3];
            document.getElementById("pqtt").innerHTML = aqtt[3].toFixed(2);
            
            document.getElementById("lq25").innerHTML = aq25[4];
            document.getElementById("lq25r").innerHTML = aq25r[4];
            document.getElementById("lq100r").innerHTML = aq100r[4];
            document.getElementById("lq20").innerHTML = aq20[4];
            document.getElementById("lq20r").innerHTML = aq20r[4];
            document.getElementById("lq30").innerHTML = aq30[4];
            document.getElementById("lq10r").innerHTML = aq10r[4];
            document.getElementById("lq35r").innerHTML = aq35r[4];
            document.getElementById("lq40r").innerHTML = aq40r[4];
            document.getElementById("lq45r").innerHTML = aq45r[4];
            document.getElementById("lq50r").innerHTML = aq50r[4];
            document.getElementById("lq60r").innerHTML = aq60r[4];
            document.getElementById("lqtt").innerHTML = aqtt[4].toFixed(2);
            
            var stt = (q25r+q25+(q100r*4)+(q20r*0.8)+(q20*0.8)+(q30*1.2) +(q10r*0.4)+(q35r*1.4)+(q40r*1.6)+(q45r*1.8)+(q50r*2)+(q60r*2.4) ).toFixed(2);
         // var stt = (q25r+q25+(q100r*4)+(q20r*0.8)+(q20*0.8)+(q30*1.2) +(q10r*0.4)+(q35r*1.4)+(q40r*1.6)+(q45r*1.8)+(q50r*2)+(q60r*2.4) );
            var kilos = stt * 11.607;
            var litros = kilos / 0.54;
  
            document.getElementById("totalc").innerHTML = "Total Cilindros:" + stt;
                        document.getElementById("totalk").innerHTML = "Total Kilos:" + kilos.toFixed(2);
                                    document.getElementById("totall").innerHTML = "Total Litros:" + litros.toFixed(2);
         
            
          
          
        }
      })
      
	  }
	  
       function tm(p,m,i,iwc){
       
       
                   var marker = new google.maps.Marker({
	          position: p,
	          icon: 'https://i.imgur.com/IrcB40y.png',
	        
	          map: m
	          
	        });
	        

        // Because path is an MVCArray, we can simply append a new coordinate
        // and it will automatically appear.
        
                marker.addListener('click', function() {
                i.setContent(iwc);
                i.open(m, marker);
              });
              
          
              }
      
           
              
	
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPhsjCN-m5XNQwuYDRXNr9C8vao_1F-rQ&callback=initMap">
    </script>
  </body>
</html>
