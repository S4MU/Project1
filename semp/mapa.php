<?php
	/*-------------------------
	Kevin Martinez
	---------------------------*/
	/*session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }*/
	
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Mapa | Tomza CR";
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
				<a  href="nueva_factura.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> </a>
			</div>
					
			<h4><i class='glyphicon glyphicon-search'></i> Reporte GPS</h4>
		</div>
		
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
				
						<div class="form-group row">
						
							<label for="q" class="col-md-2 control-label">Ruta:</label>
							<div class="col-md-2">
							<select id="q" onchange="initMap();">
							  <optgroup label="Cartago">
							    <option value="1">Ruta 1</option>
							    <option value="2">Ruta 2</option>
							    <option value="3">Ruta 3</option>
							    <option value="4">Ruta 4</option>
							    <option value="5">Ruta 5</option>
							    <option value="6">Ruta 6</option>
							    <option value="7">Ruta 7</option>
							    <option value="8">Ruta 8</option>
							    <option value="9">Ruta 9</option>
							    <option value="10">Ruta 10</option>
							    <option value="45">Ruta 45</option>
							    <option value="46">Ruta 46</option>
							    <option value="58">Ruta 58</option>
							    <option value="106">Ruta 106</option>
							    <option value="107">Ruta 107</option>
							    <option value="108">Ruta 108</option>
							    <option value="109">Ruta 109</option>
	    						    <option value="110">Ruta 110</option>
	    						    <option value="200">Ruta 200</option>
							  </optgroup>
							  <optgroup label="Super Gas">
							    <option value="27">Ruta 27</option>
							    <option value="28">Ruta 28</option>
							    <option value="29">Ruta 29</option>
							    <option value="30">Ruta 30</option>
							    <option value="31">Ruta 31</option>
							    <option value="32">Ruta 32</option>
							    <option value="33">Ruta 33</option>
							    <option value="34">Ruta 34</option>
							    <option value="38">Ruta 38</option>
							    <option value="39">Ruta 39</option>
							    <option value="40">Ruta 40</option>
							    <option value="47">Ruta 47</option>
							    <option value="48">Ruta 48</option>
							    <option value="59">Ruta 59</option>
							  </optgroup>
							  <optgroup label="Atlatico">
							    <option value="11">Ruta 11</option>
							    <option value="17">Ruta 17</option>
							    <option value="18">Ruta 18</option>
							    <option value="19">Ruta 19</option>
							    <option value="20">Ruta 20</option>
							    <option value="504">Ruta 504</option>
							  </optgroup>
							  <optgroup label="Perez">
							    <option value="21">Ruta 21</option>
							    <option value="22">Ruta 22</option>
							    <option value="23">Ruta 23</option>
							    <option value="24">Ruta 24</option>
							    <option value="25">Ruta 25</option>
							    <option value="26">Ruta 26</option>
							    <option value="51">Ruta 51</option>
							    <option value="307">Ruta 307</option>
							  </optgroup>
							  <optgroup label="La cruz">
							    <option value="12">Ruta 12</option>
							    <option value="13">Ruta 13</option>
							    <option value="14">Ruta 14</option>
							    <option value="15">Ruta 15</option>
							    <option value="16">Ruta 16</option>
							    <option value="404">Ruta 404</option>
							    
							  </optgroup>
							</select>
							<select id="optd" onchange="initMap();">
							<option value="no">Mostrar Todo</option>
    							<option value="si">Mostrar Solo Descuentos</option>
    
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

	
	</div>

	<hr>
	
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	
	  <script>
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
              var optd= $("#optd").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'map.php?q='+q+'&d='+d+'&desc='+optd,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          
          $('#loader').html('');
           txt = "";
           myObj = JSON.parse(data);
           labelIndex = 0;
        for (x in myObj) {
              var name = myObj[x].nombre;
              var address = myObj[x].fecha;
              var type = "bar";
        var point = {
                  lat:parseFloat(myObj[x].LAT),
                  lng:parseFloat(myObj[x].LONGI)};
                  var st = "";
                  if(parseInt(myObj[x].q100) > 0)
                  	st += "<b>100 lbs: </b>" + (parseInt(myObj[x].q100)).toString() + "</br>";
                  if(parseInt(myObj[x].q10r) + parseInt(myObj[x].q10) > 0)
                  	st += "<b>10 lbs: </b>" + (parseInt(myObj[x].q10r) + parseInt(myObj[x].q10)).toString()+ "</br>";
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
            '<h4 id="firstHeading" class="firstHeading">'+name + ' @ ' +((parseInt(myObj[x].q25) * 11.33) + (parseInt(myObj[x].q25r) * 11.33) + 
            (parseInt(myObj[x].q100) * 45) +(parseInt(myObj[x].q35r) * 1.4 * 11.33)+(parseInt(myObj[x].q45r) * 1.8 * 11.33) + (parseInt(myObj[x].q20r) * 0.8* 11.33) + (parseInt(myObj[x].q20) * 0.8 * 11.33)).toString() + ' kgs'+'</h4>'+
            '<div id="bodyContent">'+ 
            '</p>'+ st + '<p>' + 'Descuento unitario:' +myObj[x].descuento + '</p>' +
            '<p>Reporte de rentabilidad:'+
            '(Tomza.co.cr).</p>'+
            '</div>'+
            '</div>';
                  
          /*  var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              //strong.textContent = ;
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address;
              infowincontent.appendChild(text);
              infowincontent.appendChild(document.createElement('br'));
              infowincontent.appendChild(text);*/
              var infowindow = new google.maps.InfoWindow({
          content: contentString 
        });

               
              
              
         
              
              var t = tm(point ,map,infowindow ,contentString);
              
              
              coords.push({
                  lat:parseFloat(myObj[x].LAT),
                  lng:parseFloat(myObj[x].LONGI)});
        
            }
         
             poly = new google.maps.Polyline({
          path: coords,
          geodesic: true,
          strokeColor: '#000000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        });
        poly.setMap(map);
          
          
        }
      })
      
	  }
	  
       function tm(p,m,i,iwc){
       
       
                   var marker = new google.maps.Marker({
	          position: p,
	          label: labels[labelIndex++ % labels.length],
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