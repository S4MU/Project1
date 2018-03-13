<html>
	<head>
		<title>Control de Cartera TOMZA CR</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
		
		
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>




		<style>
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
					tfoot {
    display: table-header-group;
}
			.box
			{
				width:100%;
margin:0;
				padding:0px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				
			}
			
		</style>
	</head>
	<body>
		<div class="container box">
			<h1 align="center" id = 'lblCliente'>NOMBRE CLIENTE</h1>
			<h2 align="center" id = 'lblSaldo'>Saldo: 0 </h2>
			
			<br />
			<div class="table-responsive">
				<br />
				<div align="left">
				<label>Seleccionar Cliente:</label><br>
					<select name='cc' id='friends' class="selectpicker" data-live-search="true" data-width="auto"  >
					  
					</select><br>
					


				</div>
				<div align="right">
				
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Agregar Movimiento</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th >Fecha</th>
							<th >Documento</th>
							<th >Saldo</th>
							<th >Abonado</th>
							<th >Acciones</th>
							
							
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th >Fecha</th>
							<th >Documento</th>
							<th >Saldo</th>
							<th >Abonado</th>
							<th >Acciones</th>
						</tr>
					</tfoot>
				</table>
				
			</div>
		</div>
	</body>
</html>

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Agregar Movimiento</h4>
				</div>
				<div class="modal-body">
				<input type="hidden" name="idcliente" id="id_cliente" />
					<input type="hidden" name="idfactura" id="id_factura" />
					<label for="sel1">Tipo de Movimiento</label>
					      <select class="form-control" name="Tipo" id="sel1">
					        <option>Pago</option>
					        <option>Nota de Credito</option>
					        <option>Nota de Debito</option>
					        <option>Adelanto</option>
					      </select>
					<label>Monto</label>
					<input type="number" name="Monto" id="monto" class="form-control" />
					<br />
					<label>Recibo/Documento:</label>
					<input type="text" name="Ref" id="referencia" class="form-control" />
					<br />
					<label>Nota</label>
					<input type="text" name="Nota" id="nota" class="form-control" />
					<br />
					<label>Select User Image</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>
				</div>
				<div class="modal-footer">
					
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</form>
	</div>
</div>


<script type="text/javascript" language="javascript" >



var x = 1764;
$(document).ready(function(){
//alert("comienza");

	

$('.selectpicker').selectpicker({
      style: 'btn-info',
      
  });
    $.ajax({
        //url : "get_list2.php?id=" + $(this).val(),     
        url : "fetchclientes.php",                                               
        type: 'GET',                   
        dataType:'json',                   
        success : function(data) {  
            if (data.success) {
            //alert(data.options);
                $('#friends').html(data.options).selectpicker('refresh');
            }
            else {
                // Handle error
            }
        }
    });
    
//$('#friends').html('<option value="0">Volvo</option>').selectpicker('refresh');



	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Agregar Movimiento");
		$('#action').val("Agregar");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
	});
	
	 $('#user_data tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
    } );
    
    /*
     var dataTable = $('#user_data').DataTable({
    "processing": true,
    "serverSide": true,
   "ajax":"fetch.php"
   ,
    initComplete: function() {
      var api = this.api();

      // Apply the search
      api.columns().every(function() {
        var that = this;

        $('input', this.footer()).on('keyup change', function() {
          if (that.search() !== this.value) {
            that
              .search(this.value)
              .draw();
          }
        });
      });
    }
  });*/


	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		
		 "language": {
		 "search":"Buscar:",
		  "emptyTable":     "Sin datos por el momento",
                  "info":           "Mostrando _START_ a _END_ of _TOTAL_ entradas",
                  "lengthMenu":     "Mostrando _MENU_ entradas",
		 "paginate": {
	        "first":      "Primero",
	        "last":       "Ultimo",
	        "next":       "Siguiente",
	        "previous":   "Anterior"
		    }
		    },
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST",
			data:function( d ){
			
			   d.idcliente = $('#friends').val(); //Codigo cliente
			}
			
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],
		initComplete: function() {
      var api = this.api();

      // Apply the search
      api.columns().every(function() {
        var that = this;

        $('input', this.footer()).on('keyup change', function() {
          if (that.search() !== this.value) {
            that
              .search(this.value)
              .draw();
          }
        });
      });
    }

	});
	$('#friends').change(function() {
	//alert($('#friends').val());
	$('#lblCliente').text($('#friends').find(":selected").text());
		$.ajax({
			url:"fetchsaldo.php",
			method:"POST",
			data:{
			
			   idcliente : $('#friends').val() //Codigo cliente
			},
			
			success:function(data)
			{
			
				$('#lblSaldo').text(data);
				}
		});
	
			
        dataTable.ajax.reload();
    } );
    
	function seleccionarCliente() {
    x = 10;
    
    dataTable.ajax.reload();
}

	 // Apply the search
  /*  dataTable.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );*/

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var firstName = $('#Monto').val();
		var lastName = $('#Ref').val();
		var note= $('#Nota').val();
		var extension = $('#user_image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Invalid Image File");
				$('#user_image').val('');
				return false;
			}
		}	
		if(firstName != '' && lastName != '' )
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Se necesita agregar monto y documento");
		}
	});
	
	$(document).on('click', '.update', function(){
	
		
		
		
		
				$('#userModal').modal('show');
				$('#user_form')[0].reset();
				$('.modal-title').text("Agregar Movimiento");
				$('#action').val("Agregar");
				$('#operation').val("Add");
				$('#id_cliente').val($('#friends').val());
				$('#id_factura').val($(this).attr("id"));	
		
		
	/*
	$('#userModal').modal('show');
				$('#first_name').val(data.first_name);
				$('#last_name').val(data.last_name);
				$('.modal-title').text("Edit User");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Edit");
				$('#operation').val("Edit");
				
		var user_id = $(this).attr("id");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:function( d ){
			
			   d.idcliente = $('#friends').val(); //Codigo cliente
			},
			dataType:"json",
			success:function(data)
			{
				
			}
		})*/
	});
	
	$(document).on('click', '.delete', function(){
			var factura_id = $(this).attr("id");
			
				/*$('#userModal').modal('show');
				$('#user_form')[0].reset();
				$('.modal-title').text("Agregar Movimiento");
				$('#action').val("Agregar");
				$('#operation').val("Add");
				$('#id_cliente').val($('#friends').val());
				$('#id_factura').val(data.idfac);*/	
				
				//$('#userModal').modal('show');
				$('#user_form')[0].reset();
				$('.modal-title').text("Agregar Movimiento");
				$('#action').val("Agregar");
				$('#operation').val("Pago");
				$('#user_uploaded_image').html('');
				
				var user_id = $(this).attr("id");
				
					$.ajax({
						url:"insert.php",
						method:"POST",
						data:{idcliente : $('#friends').val(), idfactura:factura_id ,Ref:"lol",operation:"Pago"},
						success:function(data)
						{
						if(data == "La factura ya ha sido abonada a totalidad") alert(data);
							dataTable.ajax.reload();
						}
					});
		
		
		
		
	});
	
	
});
</script>