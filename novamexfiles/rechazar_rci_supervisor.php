<?php 

  


include_once 'funciones.php';



$id = $_GET['id'];

//add log
$texto = "SUPERVISOR RECHAZA REQUERIMIENTO DE CLIENTE INTERNO";
$codigo = "042";
$miemail = get_email($_SESSION['userSession']);
add_log($texto,$miemail,$codigo);



//email al CLIENTE INTERNO
$rci = $_GET['id'];
$c = get_cliente_interno($rci);
$p = get_proveedor_interno($rci);

$cliente_interno = $c;
$email_cliente_interno = get_email($cliente_interno);
$nombre_cliente_interno = get_nombre($cliente_interno);
$idioma_cliente_interno = get_idioma($cliente_interno);

$proveedor_interno = $p;
$email_proveedor_interno = get_email($proveedor_interno);
$nombre_proveedor_interno = get_nombre($proveedor_interno);
$idioma_proveedor_interno = get_idioma($proveedor_interno);



if ($idioma_cliente_interno == "en"){
	$message = "Hi, ".$nombre_cliente_interno."!<br><br>";

	$message .= "You have been assigned as client to an INTERNAL CUSTOMER REQUIREMENT. Internal Provider: ".$nombre_proveedor_interno."";

	$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
	$subject = "REJECTED BY SUPERVISOR. You have been assigned as client to an INTERNAL CUSTOMER REQUIREMENT ";
	send_mail($email_cliente_interno,$message,$subject);
}
else {
	$message = "Hola, ".$nombre_evaluador."!<br><br>";
	$message .= "Te han asignado como cliente en un REQUERIMIENTO DE CLIENTE INTERNO. Proveedor Interno: ".$nombre_proveedor_interno.".";

	$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
	$subject = "DENEGADO POR SUPERVISOR. Te han asignado como cliente en un REQUERIMIENTO DE CLIENTE INTERNO";
	send_mail($email_cliente_interno,$message,$subject);
		
}
//email al PROVEEDOR INTERNO
if ($proveedor_interno == "en"){
	$messagep = "Hi, ".$nombre_proveedor_interno."!<br><br>";
	$messagep .= "You have been assigned as Internal Provider  to an INTERNAL CUSTOMER REQUIREMENT. Internal Customer: .'$nombre_cliente_interno.'";

	$messagep .= "<br><br>Best regards.<br> Your NOVAMEX Team";
	$subjectp = "REJECTED BY SUPERVISOR. You have been assigned as Internal Provider  to an INTERNAL CUSTOMER REQUIREMENT ";
	send_mail($email_proveedor_interno,$messagep,$subjectp);
}
else {
	$messagep = "Hola, ".$nombre_proveedor_interno."!<br><br>";
	$messagep .= "Te han asignado como proveedor interno en un REQUERIMIENTO DE CLIENTE INTERNO. Cliente Interno: ".$nombre_cliente_interno.".";

	$messagep .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
	$subjectp = "DENEGADO POR SUPERVISOR. Te han asignado como proveedor en un REQUERIMIENTO DE CLIENTE INTERNO";
	send_mail($email_proveedor_interno,$messagep,$subjectp);
		
}
//email al SUPERADMIN
$em = get_email_superadmin();
$messagep = "Hi, ".$nombre_proveedor_interno."!<br><br>";
$messagep .= "INTERNAL CUSTOMER REQUIREMENT. Internal Customer: .'$nombre_cliente_interno.'";

$messagep .= "<br><br>Best regards.<br> Your NOVAMEX Team";
$subjectp = "DENEGADA POR EL SUPERVISOR.";
send_mail($em,$messagep,$subjectp);

	
	$conn = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
	$sql = "UPDATE tb_requerimientos_cliente_interno SET approved_by_supervisor = 2 WHERE id_req_interno= '".$id."'";

	if ($conn->query($sql) === TRUE) {
		header('Location: autorizar_rci.php');
	} else {
		echo "Error updating record: " . $conn->error;
	}
