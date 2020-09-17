<?php 

	$token = $_GET['token'];
	include 'assets/php/db.php';
	$db = new db();
	$conn = $db->Connect();

	$sall = $conn->prepare("SELECT * FROM `pedidos` WHERE `CODIGO_PRODUCTO`='$token'");
	$sall->execute();

	$cliente = "";
	$fecha = "";
	$detalles = "";
	$why = "";
	foreach ($sall as $key) {
		$cliente = $key['CLIENTE'];
		$fecha = $key['FECHA'];
		$detalles = $key['DETALLES'];
		$why = $key['PROBLEMA'];
	}
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

	    </ul>
	  </div>
	</nav>

	<div id="añadir">
		<div class="container">
			<h2>Editar pedido</h2>

			<div class="add-pedido">
				<div class="row">
					<div class="col-6">
						
						<label>Fecha</label>
						<input type="date" class="form-control" disabled id="date" value="<?php echo $fecha; ?>">

					</div>

					<div class="col-6">
						
						<label>Cliente</label>
						<input type="text" class="form-control" id="client-name" disabled value="<?php echo $cliente; ?>">

					</div>

					<div class="col-12">
						
						<label>Detalles del equipo <b>(Si el equipo tiene alguna rotura)</b></label>
						<input type="text" class="form-control" id="product-details" disabled value="<?php echo $detalles; ?>">

					</div>

					<div class="col-12">
						
						<label>Problema con el equipo ¿Por qué entró a servicio tecnico?</label>
						<input type="text" class="form-control" id="product-why" value="<?php echo $why; ?>">

					</div>

					<div class="col-4">
						
						<label>Precio del arreglo</label>
						<input type="number" class="form-control" id="product-price">

					</div>
					<div class="col-4">
						
						<label>Fecha de entrega</label>
						<input type="date" class="form-control" id="product-entregado-fecha">

					</div>
					<div class="col-4">
						
						<label>Entregado</label>
						<select id="entregado" class="custom-select">
							<option value="Si">Si</option>
							<option value="No" selected>No</option>
						</select>

					</div>

					<div class="col-12">
						<input type="text" id="token" value="<?php echo $token; ?>" hidden disabled>
					</div>

				</div>
				<div class="add-btn mt-5">
					<button id="p-up">Actualizar</button>
					<button id="p-del">Eliminar pedido</button>
				</div>

				<div id="alerts" class="d-none">
					
				</div>
			</div>
		</div>
	</div>


	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>


	<script>

		$('#p-del').on('click', function(){
			const token = document.getElementById('token');

			const dataString = 'token='+token.value;

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
            request.open('post', 'assets/php/delete-pedido.php');
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.send(dataString);


            function handleResponse (responseObject) {
                if (responseObject.status) {
                   alert("Eliminado con exito");
                   window.location = 'lista.php';

                } else {

                  alert("Hubo un error al eliminar el producto.");

                }
            }
		});
		$('#p-up').on('click', function(){
			const date = document.getElementById('date');
			const cliente = document.getElementById('client-name');
			const detalles = document.getElementById('product-details');
			const why = document.getElementById('product-why');

			const price = document.getElementById('product-price');
			const date_entregado = document.getElementById('product-entregado-fecha');
			const entregado = document.getElementById('entregado');
			const token = document.getElementById('token');

			const dataString = 'date='+date.value+'&cliente='+cliente.value+'&detalles='+detalles.value+'&why='+why.value+'&price='+price.value+'&date-entregado='+date_entregado.value+'&entregado='+entregado.value+'&token='+token.value;

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
	            request.open('post', 'assets/php/update-pedido.php');
	            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	            request.send(dataString);


	            function handleResponse (responseObject) {
	                if (responseObject.status) {
	                   alert("Actualizado con exito");
	                   window.location = 'lista.php';

	                } else {

	                  alert("Hubo un error al subir el producto.");

	                }
	            }
		});
	</script>


</body>
</html>