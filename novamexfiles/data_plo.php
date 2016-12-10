<?php

session_start();
require_once 'class.user.php';
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
    $query = "SELECT * FROM tb_puntos_libres_otorgados ORDER BY fecha_otorgacion DESC ";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
       
      
        
        $asigna = get_nombre($company['otorga_usuario']);
        $recibe = get_nombre($company['recibe_usuario']);
        
        $mysql_data[] = array(
         
          "asigna"  => $asigna,
          "recibe"    => $recibe,
        		"comentarios"    => $company['comentarios_otorgados'],
        		
        		"fecha"    => $company['fecha_otorgacion'],
        		"puntos"    =>  $company['puntos_otorgados']
        		
        		
        
		 
        );
      }
    }
    
  } elseif ($job == 'get_company'){
    
    // Get company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "SELECT * FROM tb_proyectos WHERE id_proyecto = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
             "nombre_proyecto"  => $company['nombre_proyecto'],
          "descripcion_proyecto"    => $company['descripcion_proyecto'],
        		"tipo_proyecto"    => $company['tipo_proyecto'],
        		"equipo_proyecto"    => $company['equipo_proyecto'],
        		"evaluador_proyecto"    => $company['evaluador_proyecto'],
        		
        		"fecha_inicio_proyecto"    => $company['fecha_inicio_proyecto'],
        		"fecha_final_proyecto"    => $company['fecha_final_proyecto']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
  	//add log
  	$texto = "USUARIO CREA NUEVO PROYECTO";
  	$codigo = "025";
  	$miemail = get_email($_SESSION['userSession']);
  	add_log($texto,$miemail,$codigo);
  	
  	$usuario_miembro = $_GET['usuario'];
  	$email_usuario = get_email($usuario_miembro);
  	$idioma_miembro =  get_idioma($usuario_miembro);
  	$nombre_usuario = get_nombre($usuario_miembro);
  	$equipo = $_GET['equipo_proyecto'];
  	$evaluador = $_GET['evaluador_proyecto'];
  	$idioma_evaluador = get_idioma($evaluador);
  	$proyecto = $_GET['nombre_proyecto'];
  	$email_evaluador = get_email($evaluador);
  	$nombre_evaluador = get_nombre($evaluador);
  	$fecha_inicio = $_GET['fecha_inicio_proyecto'];
  	$fecha_final = $_GET['fecha_final_proyecto'];
  	
  	
  	//email a los miembros
  	send_mail_miembros_equipos_proyecto($equipo,$proyecto,$fecha_inicio,$fecha_final);
  	
  	
  	//email al evaluador
  	if ($idioma_evaluador == "en"){
  		$message = "Hi, ".$nombre_evaluador."!<br><br>";
  		$message .= "You have been assigned as EVALUATOR to project: ".$proyecto.".";
  		$message .= "<br>from ".$_GET['fecha_inicio_proyecto']." to ".$_GET['fecha_final_proyecto'];
  		$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
  		$subject = "You have been assigned as EVALUATOR to project ".$proyecto;
  		send_mail($email_evaluador,$message,$subject);
  	}
  	else {
  		$message = "Hola, ".$nombre_evaluador."!<br><br>";
  		$message .= "Te han asignado como EVALUADOR del proyecto: ".$proyecto.".";
  		$message .= "<br>desde el ".$_GET['fecha_inicio_proyecto']." al ".$_GET['fecha_final_proyecto'];
  		$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
  		$subject = "Te han asignado como EVALUADOR del proyecto: ".$proyecto.".";
  		send_mail($email_evaluador,$message,$subject);
  		 
  	}
  	
  	
  	
  	
    // Add company
    $query = "INSERT INTO tb_proyectos SET ";
    if (isset($_GET['nombre_proyecto'])) { $query .= "nombre_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['nombre_proyecto']) . "', "; }
   if (isset($_GET['descripcion_proyecto'])) { $query .= "descripcion_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['descripcion_proyecto']) . "', "; }
   if (isset($_GET['tipo_proyecto'])) { $query .= "tipo_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['tipo_proyecto']) . "', "; }
   if (isset($_GET['equipo_proyecto'])) { $query .= "equipo_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['equipo_proyecto']) . "', "; }
   if (isset($_GET['evaluador_proyecto'])) { $query .= "evaluador_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['evaluador_proyecto']) . "', "; }
   if (isset($_GET['fecha_inicio_proyecto'])) { $query .= "fecha_inicio_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['fecha_inicio_proyecto']) . "', "; }
   
    if (isset($_GET['fecha_final_proyecto'])) { $query .= "fecha_final_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['fecha_final_proyecto']) . "'";   }
	 
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
    	
    	
    	$texto = "USUARIO EDITA PROYECTO";
    	$codigo = "026";
    	$miemail = get_email($_SESSION['userSession']);
    	add_log($texto,$miemail,$codigo);
    	 
    	$usuario_miembro = $_GET['usuario'];
    	$email_usuario = get_email($usuario_miembro);
    	$idioma_miembro =  get_idioma($usuario_miembro);
    	$nombre_usuario = get_nombre($usuario_miembro);
    	$equipo = $_GET['equipo_proyecto'];
    	$evaluador = $_GET['evaluador_proyecto'];
    	$idioma_evaluador = get_idioma($evaluador);
    	$proyecto = $_GET['nombre_proyecto'];
    	$email_evaluador = get_email($evaluador);
    	$nombre_evaluador = get_nombre($evaluador);
    	$fecha_inicio = $_GET['fecha_inicio_proyecto'];
    	$fecha_final = $_GET['fecha_final_proyecto'];
    	 
    	 
    	//email a los miembros
    	send_mail_miembros_equipos_proyecto_editado($equipo,$proyecto,$fecha_inicio,$fecha_final);
    	 
    	 
    	//email al evaluador
    	if ($idioma_evaluador == "en"){
    		$message = "Hi, ".$nombre_evaluador."!<br><br>";
    		$message .= "The project  ".$proyecto." has been updated.";
    		$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
    		$subject = "The project  ".$proyecto." has been updated.";
    		send_mail($email_evaluador,$message,$subject);
    	}
    	else {
    		$message = "Hola, ".$nombre_evaluador."!<br><br>";
    		$message .= "El proyecto  ".$proyecto." ha sido modificado.";
    		
    		$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
    		$subject = "El proyecto  ".$proyecto." ha sido modificado.";
    		send_mail($email_evaluador,$message,$subject);
    			
    	}
    	 
    	 
    	
    	
    	
    	
    	
      $query = "UPDATE tb_proyectos SET ";
        if (isset($_GET['nombre_proyecto'])) { $query .= "nombre_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['nombre_proyecto']) . "', "; }
   if (isset($_GET['descripcion_proyecto'])) { $query .= "descripcion_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['descripcion_proyecto']) . "', "; }
   if (isset($_GET['tipo_proyecto'])) { $query .= "tipo_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['tipo_proyecto']) . "', "; }
   if (isset($_GET['equipo_proyecto'])) { $query .= "equipo_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['equipo_proyecto']) . "', "; }
   if (isset($_GET['evaluador_proyecto'])) { $query .= "evaluador_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['evaluador_proyecto']) . "', "; }
   if (isset($_GET['fecha_inicio_proyecto'])) { $query .= "fecha_inicio_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['fecha_inicio_proyecto']) . "', "; }
  
    if (isset($_GET['fecha_final_proyecto'])) { $query .= "fecha_final_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['fecha_final_proyecto']) . "'";   }
	 
      $query .= "WHERE id_proyecto = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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
    	
    	

    	$texto = "USUARIO CANCELA PROYECTO";
    	$codigo = "027";
    	$miemail = get_email($_SESSION['userSession']);
    	add_log($texto,$miemail,$codigo);
    	 
    	 
    	$proyecto = $id;
    	
    	$evaluador = get_evaluador_proyecto($id);
    	$nombre_evaluador = get_nombre($evaluador);
    	$email_evaluador = get_email($evaluador);
    	$idioma_evaluador = get_idioma($evaluador);
    	$equipo = get_equipo_proyecto($id);
    	$proyecto_nombre = get_nombre_proyecto($id);
    	 
    	 
    	
    	 
    	 
    	//email a los miembros
    	send_mail_miembros_equipos_proyecto_cancelado($equipo,$proyecto);
    	 
    	 
    	//email al evaluador
    	if ($idioma_evaluador == "en"){
    		$message = "Hi, ".$nombre_evaluador."!<br><br>";
    		$message .= "The project  ".$proyecto_nombre." has been canceled.";
    		$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
    		$subject = "The project  ".$proyecto_nombre." has been canceled.";
    		send_mail($email_evaluador,$message,$subject);
    	}
    	else {
    		$message = "Hola, ".$nombre_evaluador."!<br><br>";
    		$message .= "El proyecto  ".$proyecto_nombre." ha sido cancelado.";
    		
    		$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
    		$subject = "El proyecto  ".$proyecto_nombre." ha sido cancelado.";
    		send_mail($email_evaluador,$message,$subject);
    			
    	}
    	 
    	 
    	 
    	 
    	
    	
    	
    	
    	
    	
      $query = "DELETE FROM tb_proyectos WHERE id_proyecto = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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