<?php 
	include 'db.php';
	$db = new db();
	$conn = $db->Connect();



	$name = $_POST['name'];
	$price = $_POST['price'];
	$code = $_POST['code'];
	$stock = $_POST['stock'];

	$status = true;



  	$expression = $conn->prepare("INSERT INTO `productos` (ID, COD, NOMBRE,PRECIO, STOCK) 
  		values (NULL, '$code', '$name', '$price', '$stock')");
  	$expression->execute();
  	if(!$expression){
  		$status = false;
  	}

  	echo json_encode(array("status" => $status));
 ?>