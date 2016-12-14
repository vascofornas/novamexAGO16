<?php

session_start();
require_once 'class.user.php';
include_once 'funciones.php';
$user_home = new USER();
if (!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// Database details
$db_server   = 'localhost';
$db_username = 'herasosj_novamex';
$db_password = 'Papa020432';
$db_name     = 'herasosj_novamex';

// Get job (and id)
$job = '';
$id  = '';
if (isset($_GET['job'])){
  $job = $_GET['job'];
  if ($job == 'get_companies' ||
      $job == 'get_company'   ||
      $job == 'add_company'   ||
      $job == 'edit_company'  ||
      $job == 'delete_company'){
    if (isset($_GET['id'])){
      $id = $_GET['id'];
      if (!is_numeric($id)){
        $id = '';
      }
    }
  } else {
    $job = '';
  }
}

// Prepare array
$mysql_data = array();

// Valid job found
if ($job != ''){
  
  // Connect to database
  $db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);
  mysqli_set_charset($db_connection, 'utf8');
  if (mysqli_connect_errno()){
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
    $job     = '';
  }
  
  // Execute job
  if ($job == 'get_companies'){
    
    // Get companies
    $query = "SELECT * FROM tb_requerimientos_cliente_interno WHERE rci_activo = 1";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['id_req_interno'] . '" data-name="' . $company['titulo_req_interno'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['id_req_interno'] . '" data-name="' . $company['titulo_req_interno'] . '"><span>Delete</span></a></li>';
		
         $stat = $company['estado_req_interno'];
        
        
      if($stat == 0){
        	$estado = $lang['PENDING_APPROVEMENT'];
        
        }
        if($stat == 1){
        	$estado = $lang['APPROVED'];
        
        }
        if($stat == 2){
        	$estado = $lang['REJECTED'];

        }
       
        $functions .= '</ul></div>';
        $mysql_data[] = array(
         
          "cliente"  => get_nombre($company['cliente_req_interno']),
           "supervisor"  => get_nombre($company['supervisor_req_interno']),
        	"proveedor"  => get_nombre($company['proveedor_req_interno']),
        		"titulo"    => $company['titulo_req_interno'],
         	 "fecha"    => $company['fecha_inicio_req_interno'],
        	
       		 "estado"    => $estado,
        		
		 
          "functions"     => $functions
        );
      }
    }
    
  } elseif ($job == 'get_company'){
  	
  	
    
    // Get company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "SELECT * FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
        	
        
        	
        	
        	
          $mysql_data[] = array(
            "cliente_req_interno"  => $company['cliente_req_interno'],
        	"proveedor_req_interno"  => $company['proveedor_req_interno'],
        		"titulo_req_interno"    => $company['titulo_req_interno'],
          		"descripcion_req_interno"    => $company['descripcion_req_interno'],
          		
          		"fecha_inicio_req_interno"    => $company['fecha_inicio_req_interno'],
          		"estado_req_interno"    => $company['estado_req_interno'],
          		"concepto1"    => $company['concepto_1'],
          		"concepto2"    => $company['concepto_2'],
          		"concepto3"    => $company['concepto_3'],
          		"concepto4"    => $company['concepto_4'],
          		"sin_puntuar"    => $company['sin_puntos'],
          		"leve"    => $company['puntos_esfuerzo_leve'],
          		"aceptable"    => $company['puntos_esfuerzo_aceptable'],
          		"excepcional"    => $company['puntos_esfuerzo_excepcional'],
          		"periodicidad"    => $company['periodicidad'],
          		"repeticiones"    => $company['repeticiones']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
  
  	
  	//add log
  	$texto = "SUPERADMIN CREA NUEVO REQUERIMIENTO DE CLIENTE INTERNO";
  	$codigo = "035";
  	$miemail = get_email($_SESSION['userSession']);
  	add_log($texto,$miemail,$codigo);
  	//add log
  	$texto = "SUPERADMIN BORRA REQUERIMIENTO DE CLIENTE INTERNO";
  	$codigo = "038";
  	$miemail = get_email($_SESSION['userSession']);
  	add_log($texto,$miemail,$codigo);
  	
  	if ($_GET['estado_req_interno'] == 1){
  		$texto = "SUPERADMIN AUTORIZA REQUERIMIENTO DE CLIENTE INTERNO";
  		$codigo = "039";
  		$miemail = get_email($_SESSION['userSession']);
  		add_log($texto,$miemail,$codigo);
  	}
  	if ($_GET['estado_req_interno'] ==2){
  		$texto = "SUPERADMIN RECHAZA REQUERIMIENTO DE CLIENTE INTERNO";
  		$codigo = "040";
  		$miemail = get_email($_SESSION['userSession']);
  		add_log($texto,$miemail,$codigo);
  	}
  	 
  
  	 
  	//email al CLIENTE INTERNO
  	$cliente_interno = $_GET['cliente_req_interno'];
  	$email_cliente_interno = get_email($cliente_interno);
  	$nombre_cliente_interno = get_nombre($cliente_interno);
  	$idioma_cliente_interno = get_idioma($cliente_interno);
  	
  	$proveedor_interno = $_GET['proveedor_req_interno'];
  	$email_proveedor_interno = get_email($proveedor_interno);
  	$nombre_proveedor_interno = get_nombre($proveedor_interno);
  	$idioma_proveedor_interno = get_idioma($proveedor_interno);
  	
  	$supervisor_interno = get_supervisor($cliente_interno);
  	$email_supervisor_interno = get_email($supervisor_interno);
  	$nombre_supervisor_interno = get_nombre($supervisor_interno);
  	$idioma_supervisor_interno = get_idioma($supervisor_interno);
  	
  	if ($idioma_cliente_interno == "en"){
  		$message = "Hi, ".$nombre_cliente_interno."!<br><br>";
  		
  		$message .= "You have been assigned as client to an INTERNAL CUSTOMER REQUIREMENT. Internal Provider: ".$nombre_proveedor_interno."";
  		
  		$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
  		$subject = "You have been assigned as client to an INTERNAL CUSTOMER REQUIREMENT ";
  		send_mail($email_cliente_interno,$message,$subject);
  	}
  	else {
  		$message = "Hola, ".$nombre_evaluador."!<br><br>";
  		$message .= "Te han asignado como cliente en un REQUERIMIENTO DE CLIENTE INTERNO. Proveedor Interno: ".$nombre_proveedor_interno.".";

  		$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
  		$subject = "Te han asignado como cliente en un REQUERIMIENTO DE CLIENTE INTERNO";
  		send_mail($email_cliente_interno,$message,$subject);
  			
  	}
  	//email al PROVEEDOR INTERNO
  	if ($proveedor_interno == "en"){
  		$messagep = "Hi, ".$nombre_proveedor_interno."!<br><br>";
  		$messagep .= "You have been assigned as Internal Provider  to an INTERNAL CUSTOMER REQUIREMENT. Internal Customer: .'$nombre_cliente_interno.'";
  		
  		$messagep .= "<br><br>Best regards.<br> Your NOVAMEX Team";
  		$subjectp = "You have been assigned as Internal Provider  to an INTERNAL CUSTOMER REQUIREMENT ";
  		send_mail($email_proveedor_interno,$messagep,$subjectp);
  	}
  	else {
  		$messagep = "Hola, ".$nombre_proveedor_interno."!<br><br>";
  		$messagep .= "Te han asignado como proveedor interno en un REQUERIMIENTO DE CLIENTE INTERNO. Cliente Interno: ".$nombre_cliente_interno.".";
  		
  		$messagep .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
  		$subjectp = "Te han asignado como proveedor en un REQUERIMIENTO DE CLIENTE INTERNO";
  		send_mail($email_proveedor_interno,$messagep,$subjectp);
  			
  	}
  	//email al SUPERVISOR
  	if ($supervisor_interno == "en"){
  		$messages = "Hi, ".$nombre_supervisor_interno_interno."!<br><br>";
  		$messages .= "You have been assigned as Supervisor  to an INTERNAL CUSTOMER REQUIREMENT. Internal Customer: .'$nombre_cliente_interno.'";
  		
  		$messages .= "<br><br>Best regards.<br> Your NOVAMEX Team";
  		$subjects = "You have been assigned as Supervisor  to an INTERNAL CUSTOMER REQUIREMENT ";
  		send_mail($email_supervisor_interno,$messages,$subjects);
  	}
  	else {
  		$messages = "Hola, ".$nombre_supervisor_interno_interno."!<br><br>";
  		$messages .= "Te han asignado como supervisor en un REQUERIMIENTO DE CLIENTE INTERNO. Cliente Interno: ".$nombre_cliente_interno.".";
  		
  		$messages .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
  		$subjects = "Te han asignado como supervisor en un REQUERIMIENTO DE CLIENTE INTERNO";
  		send_mail($email_supervisor_interno,$messages,$subjects);
  			
  	}
  	 
  	
  	
  	
  	
  	
  	$supervisor = get_supervisor($_GET['cliente_req_interno']);
  	
  	
    $query = "INSERT INTO tb_requerimientos_cliente_interno SET ";
    if (isset($_GET['cliente_req_interno'])) { $query .= "cliente_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['cliente_req_interno']) . "', "; }
    if (isset($_GET['proveedor_req_interno'])) { $query .= "proveedor_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['proveedor_req_interno']) . "', "; }
  if (isset($_GET['cliente_req_interno'])) { $query .= "supervisor_req_interno = '" .$supervisor. "', "; }
  if (isset($_GET['fecha_inicio_req_interno'])) { $query .= "fecha_inicio_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['fecha_inicio_req_interno']) . "', "; }
  
  if (isset($_GET['titulo_req_interno'])) { $query .= "titulo_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['titulo_req_interno']) . "', "; }
  
  if (isset($_GET['descripcion_req_interno'])) { $query .= "descripcion_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['descripcion_req_interno']) . "', "; }
  if (isset($_GET['concepto1'])) { $query .= "concepto_1 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto1']) . "', "; }
  
  if (isset($_GET['concepto2'])) { $query .= "concepto_2 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto2']) . "', "; }
  
  if (isset($_GET['concepto3'])) { $query .= "concepto_3 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto3']) . "', "; }
  
  if (isset($_GET['concepto4'])) { $query .= "concepto_4 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto4']) . "', "; }
   
  if (isset($_GET['sin_puntuar'])) { $query .= "sin_puntos = '" . mysqli_real_escape_string($db_connection, $_GET['sin_puntuar']) . "', "; }
  if (isset($_GET['leve'])) { $query .= "puntos_esfuerzo_leve = '" . mysqli_real_escape_string($db_connection, $_GET['leve']) . "', "; }
  
  if (isset($_GET['aceptable'])) { $query .= "puntos_esfuerzo_aceptable = '" . mysqli_real_escape_string($db_connection, $_GET['aceptable']) . "', "; }
   
  if (isset($_GET['excepcional'])) { $query .= "puntos_esfuerzo_excepcional = '" . mysqli_real_escape_string($db_connection, $_GET['excepcional']) . "', "; }
  
  if (isset($_GET['periodicidad'])) { $query .= "periodicidad = '" . mysqli_real_escape_string($db_connection, $_GET['periodicidad']) . "', "; }
   
  if (isset($_GET['estado_req_interno'])) { $query .= "estado_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['estado_req_interno']) . "', "; }
   
  
  if (isset($_GET['repeticiones'])) { $query .= "repeticiones = '" . mysqli_real_escape_string($db_connection, $_GET['repeticiones']) . "'";   }
  
	 
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      
    }
  
  } elseif ($job == 'edit_company'){
    
    // Edit company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
    
    	
    	$supervisor = get_supervisor($_GET['cliente_req_interno']);
    	

    	//add log
    	$texto = "SUPERADMIN EDITA REQUERIMIENTO DE CLIENTE INTERNO";
    	$codigo = "037";
    	$miemail = get_email($_SESSION['userSession']);
    	add_log($texto,$miemail,$codigo);
    	
    	//add log
    	$texto = "SUPERADMIN BORRA REQUERIMIENTO DE CLIENTE INTERNO";
    	$codigo = "038";
    	$miemail = get_email($_SESSION['userSession']);
    	add_log($texto,$miemail,$codigo);
    	
    	if ($_GET['estado_req_interno'] == 1){
    		$texto = "SUPERADMIN AUTORIZA REQUERIMIENTO DE CLIENTE INTERNO";
    		$codigo = "039";
    		$miemail = get_email($_SESSION['userSession']);
    		add_log($texto,$miemail,$codigo);
    	}
    	if ($_GET['estado_req_interno'] ==2){
    		$texto = "SUPERADMIN RECHAZA REQUERIMIENTO DE CLIENTE INTERNO";
    		$codigo = "040";
    		$miemail = get_email($_SESSION['userSession']);
    		add_log($texto,$miemail,$codigo);
    	}
    	 
    	
    	//email al CLIENTE INTERNO
    	$cliente_interno = $_GET['cliente_req_interno'];
    	$email_cliente_interno = get_email($cliente_interno);
    	$nombre_cliente_interno = get_nombre($cliente_interno);
    	$idioma_cliente_interno = get_idioma($cliente_interno);
    	 
    	$proveedor_interno = $_GET['proveedor_req_interno'];
    	$email_proveedor_interno = get_email($proveedor_interno);
    	$nombre_proveedor_interno = get_nombre($proveedor_interno);
    	$idioma_proveedor_interno = get_idioma($proveedor_interno);
    	 
    	$supervisor_interno = get_supervisor($cliente_interno);
    	$email_supervisor_interno = get_email($supervisor_interno);
    	$nombre_supervisor_interno = get_nombre($supervisor_interno);
    	$idioma_supervisor_interno = get_idioma($supervisor_interno);
    	 
    	if ($idioma_cliente_interno == "en"){
    		$message = "Hi, ".$nombre_cliente_interno."!<br><br>";
    	
    		$message .= "INTERNAL CUSTOMER REQUIREMENT has been edited. Internal Provider: ".$nombre_proveedor_interno."";
    	
    		$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
    		$subject = "INTERNAL CUSTOMER REQUIREMENT edited ";
    		send_mail($email_cliente_interno,$message,$subject);
    	}
    	else {
    		$message = "Hola, ".$nombre_evaluador."!<br><br>";
    		$message .= "REQUERIMIENTO DE CLIENTE INTERNO editado. Proveedor Interno: ".$nombre_proveedor_interno.".";
    	
    		$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
    		$subject = "REQUERIMIENTO DE CLIENTE INTERNO editado";
    		send_mail($email_cliente_interno,$message,$subject);
    			
    	}
    	//email al PROVEEDOR INTERNO
    	if ($proveedor_interno == "en"){
    		$messagep = "Hi, ".$nombre_proveedor_interno."!<br><br>";
    		$messagep .= "INTERNAL CUSTOMER REQUIREMENT has been edited. Internal Customer: .'$nombre_cliente_interno.'";
    	
    		$messagep .= "<br><br>Best regards.<br> Your NOVAMEX Team";
    		$subjectp = "INTERNAL CUSTOMER REQUIREMENT has been edited ";
    		send_mail($email_proveedor_interno,$messagep,$subjectp);
    	}
    	else {
    		$messagep = "Hola, ".$nombre_proveedor_interno."!<br><br>";
    		$messagep .= "REQUERIMIENTO DE CLIENTE INTERNO editado. Cliente Interno: ".$nombre_cliente_interno.".";
    	
    		$messagep .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
    		$subjectp = "REQUERIMIENTO DE CLIENTE INTERNO editado";
    		send_mail($email_proveedor_interno,$messagep,$subjectp);
    			
    	}
    	//email al SUPERVISOR
    	if ($supervisor_interno == "en"){
    		$messages = "Hi, ".$nombre_supervisor_interno_interno."!<br><br>";
    		$messages .= "INTERNAL CUSTOMER REQUIREMENT edited. Internal Customer: .'$nombre_cliente_interno.'";
    	
    		$messages .= "<br><br>Best regards.<br> Your NOVAMEX Team";
    		$subjects = "INTERNAL CUSTOMER REQUIREMENT edited ";
    		send_mail($email_supervisor_interno,$messages,$subjects);
    	}
    	else {
    		$messages = "Hola, ".$nombre_supervisor_interno_interno."!<br><br>";
    		$messages .= "REQUERIMIENTO DE CLIENTE INTERNO editado. Cliente Interno: ".$nombre_cliente_interno.".";
    	
    		$messages .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
    		$subjects = "REQUERIMIENTO DE CLIENTE INTERNO editado";
    		send_mail($email_supervisor_interno,$messages,$subjects);
    			
    	}
    	
    	 
    	 
    	
      $query = "UPDATE tb_requerimientos_cliente_interno SET ";
        if (isset($_GET['cliente_req_interno'])) { $query .= "cliente_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['cliente_req_interno']) . "', "; }
    if (isset($_GET['proveedor_req_interno'])) { $query .= "proveedor_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['proveedor_req_interno']) . "', "; }
  if (isset($_GET['cliente_req_interno'])) { $query .= "supervisor_req_interno = '" .$supervisor. "', "; }
  if (isset($_GET['fecha_inicio_req_interno'])) { $query .= "fecha_inicio_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['fecha_inicio_req_interno']) . "', "; }
  
  if (isset($_GET['titulo_req_interno'])) { $query .= "titulo_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['titulo_req_interno']) . "', "; }
  if (isset($_GET['estado_req_interno'])) { $query .= "estado_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['estado_req_interno']) . "', "; }
  
  if (isset($_GET['descripcion_req_interno'])) { $query .= "descripcion_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['descripcion_req_interno']) . "', "; }
  if (isset($_GET['concepto1'])) { $query .= "concepto_1 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto1']) . "', "; }
  
  if (isset($_GET['concepto2'])) { $query .= "concepto_2 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto2']) . "', "; }
  
  if (isset($_GET['concepto3'])) { $query .= "concepto_3 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto3']) . "', "; }
  
  if (isset($_GET['concepto4'])) { $query .= "concepto_4 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto4']) . "', "; }
   
  if (isset($_GET['sin_puntuar'])) { $query .= "sin_puntos = '" . mysqli_real_escape_string($db_connection, $_GET['sin_puntuar']) . "', "; }
  if (isset($_GET['leve'])) { $query .= "puntos_esfuerzo_leve = '" . mysqli_real_escape_string($db_connection, $_GET['leve']) . "', "; }
  
  if (isset($_GET['aceptable'])) { $query .= "puntos_esfuerzo_aceptable = '" . mysqli_real_escape_string($db_connection, $_GET['aceptable']) . "', "; }
   
  if (isset($_GET['excepcional'])) { $query .= "puntos_esfuerzo_excepcional = '" . mysqli_real_escape_string($db_connection, $_GET['excepcional']) . "', "; }
  
  if (isset($_GET['periodicidad'])) { $query .= "periodicidad = '" . mysqli_real_escape_string($db_connection, $_GET['periodicidad']) . "', "; }
   
  if (isset($_GET['repeticiones'])) { $query .= "repeticiones = '" . mysqli_real_escape_string($db_connection, $_GET['repeticiones']) . "'";   }
  
      $query .= "WHERE id_req_interno = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query  = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
    
  } elseif ($job == 'delete_company'){
  
    // Delete company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
    	
    	 
    	//add log
    	$texto = "SUPERADMIN BORRA REQUERIMIENTO DE CLIENTE INTERNO";
    	$codigo = "038";
    	$miemail = get_email($_SESSION['userSession']);
    	add_log($texto,$miemail,$codigo);
    	 
    	if ($_GET['estado_req_interno'] == 1){
    		$texto = "SUPERADMIN AUTORIZA REQUERIMIENTO DE CLIENTE INTERNO";
    		$codigo = "039";
    		$miemail = get_email($_SESSION['userSession']);
    		add_log($texto,$miemail,$codigo);
    	}
    	if ($_GET['estado_req_interno'] ==2){
    		$texto = "SUPERADMIN RECHAZA REQUERIMIENTO DE CLIENTE INTERNO";
    		$codigo = "040";
    		$miemail = get_email($_SESSION['userSession']);
    		add_log($texto,$miemail,$codigo);
    	}
    	
    	
    	 
    	//email al CLIENTE INTERNO
    	$cliente_interno = $_GET['cliente_req_interno'];
    	$email_cliente_interno = get_email($cliente_interno);
    	$nombre_cliente_interno = get_nombre($cliente_interno);
    	$idioma_cliente_interno = get_idioma($cliente_interno);
    	
    	$proveedor_interno = $_GET['proveedor_req_interno'];
    	$email_proveedor_interno = get_email($proveedor_interno);
    	$nombre_proveedor_interno = get_nombre($proveedor_interno);
    	$idioma_proveedor_interno = get_idioma($proveedor_interno);
    	
    	$supervisor_interno = get_supervisor($cliente_interno);
    	$email_supervisor_interno = get_email($supervisor_interno);
    	$nombre_supervisor_interno = get_nombre($supervisor_interno);
    	$idioma_supervisor_interno = get_idioma($supervisor_interno);
    	
    	if ($idioma_cliente_interno == "en"){
    		$message = "Hi, ".$nombre_cliente_interno."!<br><br>";
    		 
    		$message .= "INTERNAL CUSTOMER REQUIREMENT has been deleted. Internal Provider: ".$nombre_proveedor_interno."";
    		 
    		$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
    		$subject = "INTERNAL CUSTOMER REQUIREMENT deleted ";
    		send_mail($email_cliente_interno,$message,$subject);
    	}
    	else {
    		$message = "Hola, ".$nombre_evaluador."!<br><br>";
    		$message .= "REQUERIMIENTO DE CLIENTE INTERNO borrado. Proveedor Interno: ".$nombre_proveedor_interno.".";
    		 
    		$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
    		$subject = "REQUERIMIENTO DE CLIENTE INTERNO borrado";
    		send_mail($email_cliente_interno,$message,$subject);
    		 
    	}
    	//email al PROVEEDOR INTERNO
    	if ($proveedor_interno == "en"){
    		$messagep = "Hi, ".$nombre_proveedor_interno."!<br><br>";
    		$messagep .= "INTERNAL CUSTOMER REQUIREMENT has been deleted. Internal Customer: .'$nombre_cliente_interno.'";
    		 
    		$messagep .= "<br><br>Best regards.<br> Your NOVAMEX Team";
    		$subjectp = "INTERNAL CUSTOMER REQUIREMENT has been deleted ";
    		send_mail($email_proveedor_interno,$messagep,$subjectp);
    	}
    	else {
    		$messagep = "Hola, ".$nombre_proveedor_interno."!<br><br>";
    		$messagep .= "REQUERIMIENTO DE CLIENTE INTERNO borrado. Cliente Interno: ".$nombre_cliente_interno.".";
    		 
    		$messagep .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
    		$subjectp = "REQUERIMIENTO DE CLIENTE INTERNO borrado";
    		send_mail($email_proveedor_interno,$messagep,$subjectp);
    		 
    	}
    	//email al SUPERVISOR
    	if ($supervisor_interno == "en"){
    		$messages = "Hi, ".$nombre_supervisor_interno_interno."!<br><br>";
    		$messages .= "INTERNAL CUSTOMER REQUIREMENT deleted. Internal Customer: .'$nombre_cliente_interno.'";
    		 
    		$messages .= "<br><br>Best regards.<br> Your NOVAMEX Team";
    		$subjects = "INTERNAL CUSTOMER REQUIREMENT deleted ";
    		send_mail($email_supervisor_interno,$messages,$subjects);
    	}
    	else {
    		$messages = "Hola, ".$nombre_supervisor_interno_interno."!<br><br>";
    		$messages .= "REQUERIMIENTO DE CLIENTE INTERNO borrado. Cliente Interno: ".$nombre_cliente_interno.".";
    		 
    		$messages .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
    		$subjects = "REQUERIMIENTO DE CLIENTE INTERNO borrado";
    		send_mail($email_supervisor_interno,$messages,$subjects);
    		 
    	}
    	 
    	
    	
    	
    	
    	
    	
    	
      $query = "DELETE FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
  
  }
  
  // Close database connection
  mysqli_close($db_connection);

}

// Prepare data
$data = array(
  "result"  => $result,
  "message" => $message,
  "data"    => $mysql_data
);

// Convert PHP array to JSON array
$json_data = json_encode($data);
print $json_data;
?>