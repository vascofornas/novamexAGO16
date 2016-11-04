<?php 

  



	$id = $_GET['id'];

	

	
	$conn = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
	$sql = "UPDATE tb_requerimientos_cliente_interno SET approved_by_supervisor = 2 WHERE id_req_interno= '".$id."'";

	if ($conn->query($sql) === TRUE) {
		header('Location: autorizar_rci.php');
	} else {
		echo "Error updating record: " . $conn->error;
	}
