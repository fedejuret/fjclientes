<?php 
	include 'db.php';
	$db = new db();
	$conn = $db->Connect();


  $token = $_POST['token'];

	$status = true;


  	$expression = $conn->prepare("DELETE FROM `pedidos` WHERE `pedidos`.`CODIGO_PRODUCTO` = '$token'");
  	$expression->execute();
  	if(!$expression){
  		$status = false;
  	}

  	echo json_encode(array("status" => $status));
 ?>