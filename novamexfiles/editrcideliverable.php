<?php
include_once 'common.php';
include_once 'funciones.php';

if( $_POST ){
	
    $titulo_entregable = $_POST['titulo_entregable'];
   $descripcion_entregable = $_POST['descripcion_entregable'];
   $proyecto_entregable = $_POST['rci_entregable'];
   $nombre_entregable = $_POST['nombre_entregable'];
 
    



 $db_host = "localhost";
 $db_name = "herasosj_novamex";
 $db_user = "herasosj_novamex";
 $db_pass =  "Papa020432";
 


// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO tb_entregables_rci (titulo_entregable, descripcion_entregable, rci_entregable, nombre_entregable)
VALUES ('$titulo_entregable', '$descripcion_entregable', '$proyecto_entregable', '$nombre_entregable')";

if ($conn->query($sql) === TRUE) {
	$texto = "USUARIO ENVIA ENTREGABLES DE REVISIONES DE RCI";
	$codigo = "044";
	$miemail = get_email($_SESSION['userSession']);
	add_log($texto,$miemail,$codigo);
	//email a superadmin
	$super = get_email_superadmin();
	$r = $_GET['id'];
	$rev = get_rci_de_revision($proyecto_entregable);
	$pro =  get_nombre_rci($rev);
	$men = "El RCI: ".$pro.", tiene nuevos entregables de revisiones";
	send_mail($super,$men,$pro);
	//email al cliente interno
	
	$cliente_interno = get_cliente_interno($rev);
	$proveedor_interno = get_proveedor_interno($rev);
	$email_cliente_interno = get_email($cliente_interno);
	$nombre_cliente_interno = get_nombre($cliente_interno);
	$nombre_proveedor_interno = get_nombre($proveedor_interno);
	
	$idioma_cliente_interno = get_idioma($cliente_interno);
	
	if ($idioma_cliente_interno == "en"){
		$message = "Hi, ".$nombre_cliente_interno."!<br><br>";
	
		$message .= "INTERNAL CUSTOMER REQUIREMENT has new deliverables. Internal Provider: ".$nombre_proveedor_interno."";
	
		$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
		$subject = "INTERNAL CUSTOMER REQUIREMENT has new deliverables ";
		send_mail($email_cliente_interno,$message,$subject);
	}
	else {
		$message = "Hola, ".$nombre_cliente_interno."!<br><br>";
		$message .= "REQUERIMIENTO DE CLIENTE INTERNO tiene nuevos entregables. Proveedor Interno: ".$nombre_proveedor_interno.".";
	
		$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
		$subject = "REQUERIMIENTO DE CLIENTE INTERNO tiene nuevos entregables";
		send_mail($email_cliente_interno,$message,$subject);
	
	}
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
   

?>
    <table class="table table-striped" border="0">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong><?php echo $lang['SUCCESS']?></strong>, <?php echo $lang['CREATED']?>...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['TITLE_DELIVERABLE']?>: </strong></td>
    <td><?php echo $titulo_entregable ?></td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['DESCRIPTION_DELIVERABLE']?>: </strong></td>
    <td><?php echo $descripcion_entregable ?></td>
    </tr>
    
   <tr>
    <td><strong><?php echo $lang['DESCRIPTION_DELIVERABLE']?>: </strong></td>
    <td><?php echo $nombre_entregable ?></td>
    </tr>
    
    <tr>
    
    
    
    </table>
    <?php
	
}