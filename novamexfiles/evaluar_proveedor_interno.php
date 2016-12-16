<?php
include 'funciones.php';
include_once 'common.php';
if($_POST)
{
    $to_email       = "modestovasco@gmail.com"; //Recipient email, Replace with own email here
    
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        
        $output = json_encode(array( //create JSON data
            'type'=>'error', 
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    } 
    
    //Sanitize input data using PHP filter_var().
    $eval_c1      = filter_var($_POST["eval_c1"], FILTER_SANITIZE_STRING);
    $eval_c2      = filter_var($_POST["eval_c2"], FILTER_SANITIZE_STRING);
    $eval_c3      = filter_var($_POST["eval_c3"], FILTER_SANITIZE_STRING);
    $eval_c4      = filter_var($_POST["eval_c4"], FILTER_SANITIZE_STRING);
    $eval_id      = filter_var($_POST["eval_id"], FILTER_SANITIZE_STRING);
    $proveedor      = filter_var($_POST["proveedor"], FILTER_SANITIZE_STRING);
    
    
    $suma_nueva = $eval_c1 + $eval_c2 + $eval_c3+ $eval_c4;
    
    $c1_anterior = get_c1($eval_id);
    $c2_anterior = get_c2($eval_id);
    $c3_anterior = get_c3($eval_id);
    $c4_anterior = get_c4($eval_id);
	$suma_anterior = $c1_anterior+$c2_anterior+$c3_anterior+$c4_anterior;
	
	$res = $suma_anterior + $suma_nueva;
	
	// Change the line below to your timezone!
	date_default_timezone_set('America/Chihuahua');
	$date = date('Y-m-d H:i:s');
	
	$texto = "USUARIO EVALUA REVISIONES DE RCI";
	$codigo = "045";
	$miemail = get_email($_SESSION['userSession']);
	add_log($texto,$miemail,$codigo);
	
	//email a superadmin
	$super = get_email_superadmin();
	$r = $_GET['id'];
	$rev = get_rci_de_revision($eval_id);
	$pro =  get_nombre_rci($rev);
	$men = "El RCI: ".$pro.", tiene nuevas evaluaciones de revisiones";
	send_mail($super,$men,$pro);
	
	
	//email al cliente interno
	
	$cliente_interno = get_cliente_interno($rev);
	$proveedor_interno = get_proveedor_interno($rev);
	$email_cliente_interno = get_email($cliente_interno);
	$nombre_cliente_interno = get_nombre($cliente_interno);
	$nombre_proveedor_interno = get_nombre($proveedor_interno);
	$email_proveedor_interno = get_email($proveedor_interno);
	
	$idioma_cliente_interno = get_idioma($cliente_interno);
	$idioma_proveedor_interno = get_idioma($proveedor_interno_interno);
	
	if ($idioma_proveedor_interno == "en"){
		$message = "Hi, ".$nombre_proveedor_interno."!<br><br>";
	
		$message .= "INTERNAL CUSTOMER REQUIREMENT has new evaluations. Internal Customer: ".$nombre_cliente_interno."";
	
		$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
		$subject = "INTERNAL CUSTOMER REQUIREMENT has new evaluations ";
		send_mail($email_proveedor_interno,$message,$subject);
	}
	else {
		$message = "Hola, ".$nombre_proveedor_interno."!<br><br>";
		$message .= "REQUERIMIENTO DE CLIENTE INTERNO tiene nuevas evaluaciones. Cliente Interno: ".$nombre_cliente_interno.".";
	
		$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
		$subject = "REQUERIMIENTO DE CLIENTE INTERNO tiene nuevas evaluaciones";
		send_mail($email_proveedor_interno,$message,$subject);
	
	}
	
	
	
	
	
	
	
	
	
	
	

    $mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
    
    $sql = "UPDATE tb_revisiones_rci SET estado_evaluacion = 1, fecha_evaluacion = '".$date."', evaluacion_c1 = '".$eval_c1."', evaluacion_c2 = '".$eval_c2."', evaluacion_c3 = '".$eval_c3."', evaluacion_c4 = '".$eval_c4."'
    		WHERE id_revisiones_rci = '".$eval_id."'";
    
    if ($mysqli->query($sql) === TRUE) {
    	
    	
    	//comprobar si tiene saldo en puntos dispoibles
    	
    	$ya_tiene_puntos = comprobar_existe_puntos_disponibles($proveedor);
    	if ($ya_tiene_puntos == 0){
    		crear_puntos_disponibles($proveedor,$suma_nueva);
    	}
    	
    	if ($ya_tiene_puntos >0){
    		$puntos_actuales = get_puntos_disponibles($proveedor);
    		$puntos = $puntos_actuales + $suma_nueva-$suma_anterior;
    		update_puntos_disponibles($proveedor, $puntos);
    	}
    	 
    	

    	$output = json_encode(array('type'=>'message', 'text' => ' '. $lang['EVALUATED']."  <a class='btn btn-primary' href='evaluaciones_rci.php' role='button'>".$lang['GO']."</a>"));
    	die($output);
    		
    } else {
    
    }
    

   
}
?>