
<html>
	<head>
		<title>Control de Cartera TOMZA CR</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" />
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
				width:1270px;
				padding:20px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
		<div class="container box">
			<h1 align="center">NOMBRE CLIENTE</h1>
			<h2 align="center">Factura No: 6587</h2>
			<h3 align="center">Fecha: 05/02/18</h3>
			<h3 align="center">Saldo: 0</h3>
			<br />
			<div class="table-responsive">
				<br />
				<div align="left">
		
				</div>
				
				<div align="right">
				
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Agregar Movimiento</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">Fecha</th>
							<th width="10%">Tipo de movimiento</th>
							<th width="10%">Recibo No</th>
							<th width="10%">Monto</th>
							<th width="10%">Nota</th>
							<th width="10%">Acciones</th>
							
							
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th width="10%">Fecha</th>
							<th width="10%">Tipo de movimiento</th>
							<th width="10%">Recibo No</th>
							<th width="10%">Monto</th>
							<th width="10%">Nota</th>
							<th width="10%">Acciones</th>
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
				<input type="hidden" name="idcliente" value="1" />
				<input type="hidden" name="idfac" value="10" />
					<label for="sel1">Tipo de Movimiento</label>
					      <select class="form-control" name="Tipo" id="sel1">
					        <option>Pago</option>
					        <option>Nota de Credito</option>
					        <option>Nota de Debito</option>
					        <option>Adelanto</option>
					      </select>
					<label>Monto</label>
					<input type="number" name="Monto" id="first_name" class="form-control" />
					<br />
					<label>Referencia</label>
					<input type="text" name="Ref" id="last_name" class="form-control" />
					<br />
					<label>Nota</label>
					<input type="text" name="Nota" id="nota" class="form-control" />
					<br />
					<label>Select User Image</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" language="javascript" >
var editor;
var id = <?php if (isset($_GET["id"])) echo $_GET["id"].";"; else echo "0;"; ?>
$(document).ready(function(){
//alert(id);
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
			data:{
			"idfac":id
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
		var user_id = $(this).attr("id");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#first_name').val(data.first_name);
				$('#last_name').val(data.last_name);
				$('.modal-title').text("Edit User");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
</script>