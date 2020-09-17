<?php 
	include 'assets/php/db.php';
	$db = new db();
	$conn = $db->Connect();

	$sall = $conn->prepare("SELECT * FROM `productos` ORDER BY `ID` DESC");
	$sall->execute();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>FJClientes</title>

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta charset="UTF-8">

	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">FJClientes</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="index.php">Añadir Pedido</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="lista.php">Lista Pedido</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="productos.php">Productos</a>
	      </li>

	    </ul>
	  </div>
	</nav>
	
	<div id="lista">
		<div class="m-5">
			<button class="btn btn-primary" id="up">+ Subir Producto</button>
		</div>
		<div class="container-fluid">
			<h2>Lista de pedidos</h2>
			
			<table class="table table-hover table-striped">
			  <thead>
			    <tr>
			      <th scope="col">ID</th>
			      <th scope="col">CODIGO</th>
			      <th scope="col">NOMBRE</th>
			      <th scope="col">PRECIO</th>
			      <th scope="col">STOCK</th>
			      <th scope="col">Accion</th>
			    </tr>
			  </thead>
			  <tbody>
			    
			    <?php 
			    	
			    	foreach ($sall as $key) {
			    		?>
						
						<tr>
					      <th scope="row"><?php echo $key['ID']; ?></th>
					      <td><?php echo $key['COD']; ?></td>
					      <td><?php echo $key['NOMBRE']; ?></td>
					      <td><?php echo $key['PRECIO']; ?></td>
					      <td><?php echo $key['STOCK']; ?></td>
					      
					      <td><a href="editar-producto.php?token=<?php echo $key['COD']; ?>">Editar</a></td>
					    </tr>
						
			    		<?php
			    	}
			     ?>
			  </tbody>
			</table>
			

			<div id="alerts" class="d-none">
					
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="updateProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Subir un producto</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="mb-3 col-12">
		      		<label for="">Nombre del producto</label>
		        	<input type="text" id="p-name" class="form-control" placeholder="Nombre del producto">
		      	</div>
		      	<div class="mb-3 col-12">
		      		<label for="">Precio</label>
		        	<input type="number" id="p-price" class="form-control" placeholder="Precio del producto">
		      	</div>
		      	<div class="mb-3 col-6">
		      		<label for="">Código del producto</label>
		        	<input type="number" id="p-code" class="form-control" placeholder="Codigo del producto">
		      	</div>
		      	<div class="mb-3 col-6">
		      		<label for="">Stock</label>
		        	<input type="number" id="p-stock" class="form-control" placeholder="Cantidad de stock">
		      	</div>
	      	</div>
			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="button" id="upload" class="btn btn-primary">Subir</button>
	      </div>
	    </div>
	  </div>
	</div>


	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script>
		$('#up').on('click', function(){
			$('#updateProduct').modal("show")
		})

		$('#upload').on("click", function(){
			const name = document.getElementById("p-name");
			const price = document.getElementById("p-price");
			const code = document.getElementById("p-code");
			const stock = document.getElementById("p-stock");

			var cc = true;

			if(name.value == null || name.value == ''){
				cc = false;
			}else if(price.value == null || price.value == ''){
				cc = false;
			}else if(code.value == null || code.value == ''){
				cc=false;
			}else if(stock.value == null || stock.value == ''){
				cc = false;
			}

			if(cc){
				const dataString = 'name='+name.value+'&price='+price.value+'&code='+code.value+'&stock='+stock.value;

	            const request = new XMLHttpRequest();
	            request.onload = () => {
	                let responseObject = null;
	                try {
	                    responseObject = JSON.parse(request.responseText);
	                } catch (e) {
	                    console.error('Error DE AJAX');
	                }
	                if (responseObject) {
	                    handleResponse(responseObject);
	                }
	            };
	            request.open('post', 'assets/php/upload-producto.php');
	            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	            request.send(dataString);


	            function handleResponse (responseObject) {
	                if (responseObject.status) {
	                   window.location = "productos.php";

	                } else {

	                  alert("Hubo un error al subir el producto.");

	                }
	            }
			}
		})
	</script>


</body>
</html>