<?php 
	include 'assets/php/db.php';
	$db = new db();
	$conn = $db->Connect();

	$sall = $conn->prepare("SELECT * FROM `pedidos` ORDER BY `ID` DESC");
	$sall->execute();
	// 
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
		<div class="container-fluid">
			<h2>Lista de pedidos</h2>
			
			<table class="table table-hover table-striped">
			  <thead>
			    <tr>
			      <th scope="col">Fecha</th>
			      <th scope="col">Cliente</th>
			      <th scope="col">Codigo</th>
			      <th scope="col">Detalles-Producto</th>
			      <th scope="col">Problema</th>
			      <th scope="col">Precio</th>
			      <th scope="col">Entregado</th>
			      <th scope="col">Fecha</th>
			      <th scope="col">Accion</th>
				  
			    </tr>
			  </thead>
			  <tbody>
			    
			    <?php 
			    	$total = 0;
			    	foreach ($sall as $key) {
			    		$total += $key['COSTO_ARREGLO'];
			    		?>
						
						<tr>
					      <th scope="row"><?php echo $key['FECHA']; ?></th>
					      <td><?php echo $key['CLIENTE']; ?></td>
					      <td><span class="badge badge-primary" style="font-size: 19px;"><?php echo $key['CODIGO_PRODUCTO']; ?></span></td>
					      <td><?php echo $key['DETALLES']; ?></td>
					      <td><?php echo $key['PROBLEMA']; ?></td>
					      <td>$<?php echo $key['COSTO_ARREGLO']; ?></td>
					      <?php 
					      	if($key['ENTREGADO'] == 'Si'){
					      		?>
									<td><span class="badge badge-success">Si</span></td>
					      		<?php
					      	}else{
					      		?>
									<td><span class="badge badge-warning">No</span></td>
					      		<?php
					      	}
					       ?>
					      <td><?php echo $key['FECHA_ENTREGA']; ?></td>
					      <td><a href="editar.php?token=<?php echo $key['CODIGO_PRODUCTO']; ?>">Editar</a></td>
					    </tr>
						
			    		<?php
			    	}
			     ?>
			     <tr>
					      <th scope="row"></th>
					      <td></td>
					      <td></td>
					      <td></td>
					      <td class="text-right"><b>Total:</b></td>
					      <td><b>$<?php echo $total; ?></b></td>
					      <td></td>
					      <td></td>
					      <td></td>
					    </tr>
			  </tbody>
			</table>
			

			<div id="alerts" class="d-none">
					
			</div>
		</div>
	</div>


	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>



</body>
</html>