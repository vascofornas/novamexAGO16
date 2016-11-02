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
    $supervisor      = filter_var($_POST["supervisor"], FILTER_SANITIZE_STRING);
    $cliente      = filter_var($_POST["cliente"], FILTER_SANITIZE_STRING);
    $proveedor      = filter_var($_POST["proveedor"], FILTER_SANITIZE_STRING);
    $titulo      = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $texto      = filter_var($_POST["texto"], FILTER_SANITIZE_STRING);
    $periodicidad      = filter_var($_POST["periodicidad"], FILTER_SANITIZE_STRING);
    $repeticiones      = filter_var($_POST["repeticiones"], FILTER_SANITIZE_STRING);
    $fecha      = filter_var($_POST["fecha"], FILTER_SANITIZE_STRING);
    $concepto1      = filter_var($_POST["concepto1"], FILTER_SANITIZE_STRING);
    $concepto2      = filter_var($_POST["concepto2"], FILTER_SANITIZE_STRING);
    $concepto3      = filter_var($_POST["concepto3"], FILTER_SANITIZE_STRING);
    $concepto4      = filter_var($_POST["concepto4"], FILTER_SANITIZE_STRING);
    $sin_puntuar      = filter_var($_POST["sin_puntuar"], FILTER_SANITIZE_STRING);
    $leve      = filter_var($_POST["leve"], FILTER_SANITIZE_STRING);
    $aceptable      = filter_var($_POST["aceptable"], FILTER_SANITIZE_STRING);
    $excepcional      = filter_var($_POST["excepcional"], FILTER_SANITIZE_STRING);

    //additional php validation
    if(strlen($titulo)<4){ // If length is less than 4 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => 'Titulo is too short or empty!'));
        die($output);
    }
    if(strlen($texto)<4){ // If length is less than 4 it will output JSON error.
    	$output = json_encode(array('type'=>'error', 'text' => 'Texto is too short or empty!'));
    	die($output);
    }

    $mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
    
    $sql = "INSERT INTO tb_requerimientos_cliente_interno (cliente_req_interno,
    		supervisor_req_interno,
    		proveedor_req_interno,
    		
    		titulo_req_interno,
    		descripcion_req_interno,
    		fecha_inicio_req_interno,
    		
    		puntos_esfuerzo_leve,
    		puntos_esfuerzo_aceptable,
    		puntos_esfuerzo_excepcional,
    		concepto_1,
    		concepto_2,
    		concepto_3,
    		concepto_4,
    		periodicidad,
    		sin_puntos,
    		repeticiones
    		)  VALUES ('".$cliente."','".$supervisor."','".$proveedor."','".$titulo."',
    				'".$texto."','".$fecha."','".$leve."','".$aceptable."',
    						'".$excepcional."','".$concepto1."','".$concepto2."','".$concepto3."',
    								'".$concepto4."','".$periodicidad."','".$sin_puntuar."','".$repeticiones."')";
    
    if ($mysqli->query($sql) === TRUE) {
    		
    } else {
    
    };
    
    //email body
    $message_body = $message."\r\n\r\n-".$supervisor."\r\nEmail : ".$supervisor."\r\nPhone Number : (".$supervisor.") ". $supervisor ;
    
    //proceed with PHP email.
    $headers = 'From: '.$supervisor.'' . "\r\n" .
    'Reply-To: '.$supervisor.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    $send_mail = mail($to_email, $subject, $message_body, $headers);
    
    if(!$send_mail)
    {
        //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
        die($output);
    }else{
    	$mi_nombre = get_nombre($cliente);
        $output = json_encode(array('type'=>'message', 'text' => '-> '. $lang['REQ_SENT']));
        die($output);
    }
}
?>