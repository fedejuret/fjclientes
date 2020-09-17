<?php 
	include 'db.php';
	$db = new db();
	$conn = $db->Connect();



	$date = $_POST['date'];
	$cliente = $_POST['cliente'];
	$detalles = $_POST['detalles'];
	$why = $_POST['why'];
  $phone = $_POST['phone'];

	$status = true;


	$token = "";
  	$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  	$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
  	$codeAlphabet.= "0123456789";
  	$max = strlen($codeAlphabet); // edited

  	for ($i=0; $i < 5; $i++) {
    	 $token .= $codeAlphabet[random_int(0, $max-1)];
  	}

  	$expression = $conn->prepare("INSERT INTO `pedidos` (ID, CLIENTE, FECHA, CODIGO_PRODUCTO, DETALLES, PROBLEMA, ENTREGADO) 
  		values (NULL, '$cliente', '$date', '$token', '$detalles', '$why', 'No')");
  	$expression->execute();
  	if(!$expression){
  		$status = false;
  	}

  	echo json_encode(array("status" => $status, "code" => $token));
 ?>