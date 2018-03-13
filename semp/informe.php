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
	$title="Informe Cubo Diario de Ventas | Tomza CR";
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
					
			<h4><i class='glyphicon glyphicon-search'></i> Informe de ventas</h4>
		</div>
		
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				<div class="form-group row">
						
							
							<label for="d" class="col-md-2 control-label">Fecha:</label>
							<div class="col-md-2">
								<p><input type="text" id="d" placeholder="Fecha" onchange="excel();"></p>
							</div>
							
							
							
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
       
          
          $('#loader').html('');
            window.open('http://tomzacr.com/semp/classes/vencanal.php?d='+d,'_blank' );
          
     
      }


	 
        
       
        
          
              
      
           
              
	
    </script>

  </body>
</html>
