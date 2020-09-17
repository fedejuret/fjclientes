<?php 
	include 'db.php';
	$db = new db();
	$conn = $db->Connect();



	$date = $_POST['date'];
	$cliente = $_POST['cliente'];
	$detalles = $_POST['detalles'];
	$why = $_POST['why'];

  $price = $_POST['price'];
  $date_entregado = $_POST['date-entregado'];
  $entregado = $_POST['entregado'];

  $token = $_POST['token'];

	$status = true;


  	$expression = $conn->prepare("UPDATE `pedidos` SET `COSTO_ARREGLO`='$price', `FECHA_ENTREGA`='$date_entregado', `ENTREGADO`='$entregado' WHERE `CODIGO_PRODUCTO`='$token'");
  	$expression->execute();
  	if(!$expression){
  		$status = false;
  	}

  	echo json_encode(array("status" => $status));
 ?>