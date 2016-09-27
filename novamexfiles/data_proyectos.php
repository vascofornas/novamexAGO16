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
    $query = "SELECT * FROM tb_proyectos LEFT JOIN tb_tipos_proyectos ON 
    		tb_proyectos.tipo_proyecto = tb_tipos_proyectos.id_tipo_proyecto LEFT JOIN tb_equipos ON 
    		tb_proyectos.equipo_proyecto =  tb_equipos.id_equipo LEFT JOIN tbl_users ON
    		tb_proyectos.evaluador_proyecto =  tbl_users.userID";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['id_proyecto'] . '" data-name="' . $company['nombre_proyecto'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['id_proyecto'] . '" data-name="' . $company['nombre_proyecto'] . '"><span>Delete</span></a></li>';
		
        $functions .= '</ul></div>';
        $mysql_data[] = array(
         
          "nombre_proyecto"  => $company['nombre_proyecto'],
          "descripcion_proyecto"    => $company['descripcion_proyecto'],
        		"tipo_proyecto"    => $company['nombre_tipo_proyecto'],
        		"equipo_proyecto"    => $company['nombre_equipo'],
        		"evaluador_proyecto"    => $company['userName'],
        		
        		"fecha_inicio_proyecto"    => $company['fecha_inicio_proyecto'],
        		"fecha_final_proyecto"    => $company['fecha_final_proyecto'],
        
		 
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