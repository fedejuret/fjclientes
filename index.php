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

	<div id="añadir">
		<div class="container">
			<h2>Añadir un pedido</h2>

			<div class="add-pedido">
				<div class="row">
					<div class="col-6">
						
						<label>Fecha</label>
						<input type="date" class="form-control" id="date">

					</div>

					<div class="col-6">
						
						<label>Cliente</label>
						<input type="text" class="form-control" id="client-name">

					</div>

					<div class="col-12">
						
						<label>Numero de telefono</label>
						<input type="text" class="form-control" id="client-phone">

					</div>

					<div class="col-12">
						
						<label>Detalles del equipo <b>(Si el equipo tiene alguna rotura)</b></label>
						<input type="text" class="form-control" id="product-details">

					</div>

					<div class="col-12">
						
						<label>Problema con el equipo ¿Por qué entró a servicio tecnico?</label>
						<input type="text" class="form-control" id="product-why">

					</div>

				</div>
				<div class="add-btn">
					<button id="p-add">Añadir</button>
				</div>

				<div id="alerts" class="d-none">
					
				</div>
			</div>
		</div>
	</div>


	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>


	<script>
		$('#p-add').on('click', function(){
			const date = document.getElementById('date');
			const cliente = document.getElementById('client-name');
			const detalles = document.getElementById('product-details');
			const why = document.getElementById('product-why');
			const phone = document.getElementById('client-phone');

			var canCont = true;
			if(date.value == null || date.value == ''){
				canCont = false;
			}else if(cliente.value == null || cliente.value == ''){
				canCont = false;
			}else if(why.value == null || why.value == ''){
				canCont = false;
			}

			if(canCont){
				const dataString = 'date='+date.value+'&cliente='+cliente.value+'&detalles='+detalles.value+'&why='+why.value+'&phone='+phone.value;

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
	            request.open('post', 'assets/php/upload-pedido.php');
	            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	            request.send(dataString);


	            function handleResponse (responseObject) {
	                if (responseObject.status) {
	                   $('#alerts').html(`
							<h1>${responseObject.code}</h1>
							<br>
							<h3>Ese es el código del pedido</h3>
	                   	`);
	                   $('#alerts').removeClass("d-none");

	                } else {

	                  alert("Hubo un error al subir el producto.");

	                }
	            }
			}else{
				alert("Hay errores. Verifica todos los campos")
			}
		});
	</script>


</body>
</html>