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
	<?php include("heads.php");?>

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
					
			<h4><i class='glyphicon glyphicon-search'></i> Reporte Cubo</h4>
		</div>
		
			<div class="panel-body">
				<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Filtros</legend>
<!-- Select Basic -->
<div class="form-group">
  <label for="q" class="col-md-4 control-label">Filtro:</label>
							<div class="col-md-4">
							<select id="q" onchange="initMap();">
							<optgroup label="Especial">
							<option value="991">Ruta</option>
							<option value="990">Cilza</option>  
							<option value="999">Codigo Cliente</option> 
							<option value="998">Nombre del negocio</option> 
							<option value="997">Descuento arriba de</option> 
							<option value="996">Descuento abajo de</option>
							<option value="995">Volumen en kilos arriba de</option>
							<option value="994">Volumen en kilos abajo de</option>
							<option value="993">Total arriba de</option>
							<option value="992">Total abajo de</option>
							</optgroup>
							  <optgroup label="General">
							  
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

							    
							  </optgroup>
							  <optgroup label="Super Gas">
							    <option value="2">Todas las rutas</option>
							    <option value="21">Tiendas</option>
							    <option value="22">Pulperias</option>
							    <option value="23">Granel</option>
							    
							  </optgroup>
							  <optgroup label="Atlatico">
							    <option value="3">Todas las rutas</option>
							    <option value="31">Tiendas</option>
							    <option value="32">Pulperias</option>
							    
							  </optgroup>
							  <optgroup label="Perez">
							    <option value="4">Todas las rutas</option>
							    <option value="41">Tiendas</option>
							    <option value="42">Pulperias</option>
							    <option value="43">Granel</option>
							  </optgroup>
							  <optgroup label="La cruz">
							    <option value="5">Todas las rutas</option>
							    <option value="51">Tiendas</option>
							    <option value="52">Pulperias</option>
							    <option value="53">Granel</option>
							    
							  </optgroup>
							</select>
							
							</div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="codcliente">Criterio de busqueda:</label>  
  <div class="col-md-4">
  <input id="codcliente" name="codcliente" type="text" placeholder="ej 20541" class="form-control input-md">
  <span class="help-block">Codigo de cliente para historico</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
<label for="d" class="col-md-4 control-label">Fecha Desde:</label>
							<div class="col-md-4">
								<p><input type="text" id="d" placeholder="Fecha" ></p>
							</div>
</div>

<div class="form-group">
							<label for="dd" class="col-md-4 control-label">Fecha Hasta:</label>
							<div class="col-md-4">
								<p><input type="text" id="dd" placeholder="Hasta" ></p>
							</div>
</div>



<!-- Prepended checkbox -->
<div class="form-group">
  <label class="col-md-4 control-label" for="ordenarmayor">Ordenar Fecha Reciente</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">     
          <input  id="ordenarmayor" type="checkbox" value="1" placeholder="si/no" >  si <br>   
      </span>
      
    </div>
    
  </div>
</div>



<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="subcanal">SubCanal</label>
  <div class="col-md-4">
    <select id="subcanal" name="subcanal" class="form-control">
      <option value="0">Cadena de supermercados</option>
      <option value="1">Supermercados independientes</option>
      <option value="2">Cadenas de comidas rapidas</option>
      <option value="3">Tiendas Mixtas</option>
      <option value="4">Tiendas Express</option>
      <option value="5">Supermercados Chinos</option>
      <option value="6">Abastecedores</option>
      <option value="7">Pulperias</option>
      <option value="8">Hoteles</option>
      <option value="9">Restaurantes</option>
      <option value="10">Bares</option>
      <option value="11">Sodas</option>
      <option value="12">Panaderias</option>
      <option value="13">Carnicerias</option>
      <option value="14">Depositos de materiales</option>
      <option value="15">Industrial</option>
      <option value="16">Domestico(VIP)</option>
      <option value="17">Industrial/Supermercado</option>
    </select>
  </div>
</div>



<!-- Select Basic 
<div class="form-group">
  <label class="col-md-4 control-label" for="unidadnegocio">Unidad de negocios</label>
  <div class="col-md-4">
    <select id="unidadnegocio" name="unidadnegocio" class="form-control">
      <option value="0">General</option>
      <option value="1">Cartago</option>
      <option value="2">Super Gas</option>
      <option value="3">Atlantico</option>
      <option value="4">Perez Zeledon</option>
      <option value="5">La Cruz</option>
    </select>
  </div>
</div>-->

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="canal">Canal</label>
  <div class="col-md-4">
    <select id="canal" name="canal" class="form-control">
      <option value="0">Pulperias</option>
      <option value="1">Distribuidores</option>
      <option value="2">Venta Publico</option>
    </select>
  </div>
</div>

</fieldset>
</form>

				<form class="form-horizontal" role="form" id="datos_cotizacion">
				<div class="form-group row">
						
							
							
							
							
							
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='excel();'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
			
		        
		      
		        
			
			 
		</div>	
		
		
				
				
				
				
	</div>

	<hr>
	
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	
	  <script>
	  
	  	 function excel(){
	  	 
         var d= $("#d").val();
         var dd= $("#dd").val();
         var q= $("#q").val();
         var cod = $("#codcliente").val();
       
          
          $('#loader').html('');
            window.open('http://tomzacr.com/semp/classes/cubocilza.php?d='+d+'&dd='+dd+'&q='+q+'&cod='+cod,'_blank' );
          
     
      }


	 
        
       
        
          
              
      
           
              
	
    </script>

  </body>
</html>
