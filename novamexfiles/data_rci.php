<?php

session_start();
require_once 'class.user.php';
require_once 'funciones.php';
include_once 'common.php';

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
    $query = "SELECT * FROM tb_requerimientos_cliente_interno";
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
		
        $functions .= '</ul></div>';
        $stat = $company['estado_req_interno'];
        
        
      if($stat == 0){
        	$estado = $lang['PENDING_APPROVEMENT'];
        
        }
        if($stat == 1){
        	$estado = $lang['APPROVED'];
        
        }
        if($stat == 2){
        	$estado = $lang['DENIED'];

        }
       
        
        $mysql_data[] = array(
         
          "cliente_req_interno"  => get_nombre($company['cliente_req_interno']),
          "supervisor_req_interno"    => get_nombre($company['supervisor_req_interno']),
        		"proveedor_req_interno"    => get_nombre($company['proveedor_req_interno']),
        		"titulo_req_interno"    => $company['titulo_req_interno'],
        		
        		"fecha_inicio_req_interno"    => $company['fecha_inicio_req_interno'],
        		"estado_req_interno"    => $estado,
        		
        
		 
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
          
        		"proveedor_req_interno"    => $company['proveedor_req_interno'],
        		"titulo_req_interno"    => $company['titulo_req_interno'],
        		
        		"fecha_inicio_req_interno"    => $company['fecha_inicio_req_interno'],
        		"estado_req_interno"    =>  $company['estado_req_interno'],
          		"descripcion_req_interno"    =>  $company['descripcion_req_interno'],
          		"concepto1"    =>  $company['concepto1'],
          		"concepto2"    =>  $company['concepto2'],
          		"concepto3"    =>  $company['concepto3'],
          		"concepto4"    =>  $company['concepto4'],
          		"sin_puntuar"    =>  $company['sin_puntuar'],
          		"leve"    =>  $company['leve'],
          		"aceptable"    =>  $company['aceptable'],
          		"excepcional"    =>  $company['excepcional'],
          		"periodicidad"    =>  $company['periodicidad'],
        		"repeticiones"    => $company['repeticiones']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    
  	
  	
  	//nombre del supervisor
  	
  	$supervisor = get_supervisor($_GET['cliente_req_interno']);
    $query = "INSERT INTO tb_requerimientos_cliente_interno SET ";
    if (isset($_GET['cliente_req_interno'])) { $query .= "cliente_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['cliente_req_interno']) . "', "; }
    if (isset($_GET['cliente_req_interno'])) { $query .= "supervisor_req_interno = '" .$supervisor. "', "; }
     
    if (isset($_GET['proveedor_req_interno'])) { $query .= "proveedor_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['proveedor_req_interno']) . "', "; }
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
      $query = "UPDATE tb_requerimientos_cliente_interno SET ";
        if (isset($_GET['cliente_req_interno'])) { $query .= "cliente_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['cliente_req_interno']) . "', "; }
    if (isset($_GET['cliente_req_interno'])) { $query .= "supervisor_req_interno = '" .$supervisor. "', "; }
     
    if (isset($_GET['proveedor_req_interno'])) { $query .= "proveedor_req_interno = '" . mysqli_real_escape_string($db_connection, $_GET['proveedor_req_interno']) . "', "; }
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
	
      $query .= "WHERE id_req_interno  = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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