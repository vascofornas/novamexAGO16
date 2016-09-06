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
    $query = "SELECT * FROM tb_miembros_equipos LEFT JOIN tbl_users ON tb_miembros_equipos.usuario = tbl_users.userID LEFT JOIN tb_equipos ON tb_miembros_equipos.equipo = tb_equipos.id_equipo LEFT JOIN tb_unidades_negocio ON tb_equipos.unidad_negocio_equipo = tb_unidades_negocio.id_unidades_negocio  ORDER BY nombre_equipo";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['id_miembro'] . '" data-name="' . $company['userName'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['id_miembro'] . '" data-name="' . $company['userName'] . '"><span>Delete</span></a></li>';
		
        $functions .= '</ul></div>';
        $mysql_data[] = array(
         
          "usuario"  => $company['userName'],
          "equipo"    => $company['nombre_equipo'],
        		"unidad_negocio"    => $company['unidad_negocio'],
        "fecha_alta"    => $company['fecha_alta'],
        		"fecha_baja"    => $company['fecha_baja'],
		 
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
      $query = "SELECT * FROM tb_miembros_equipos WHERE id_miembro = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
             "usuario"  => $company['usuario'],

          		"equipo"  => $company['equipo'],
          
          		"fecha_alta"    => $company['fecha_alta'],
          		"fecha_baja"    => $company['fecha_baja']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    $query = "INSERT INTO tb_miembros_equipos SET ";
    if (isset($_GET['usuario'])) { $query .= "usuario = '" . mysqli_real_escape_string($db_connection, $_GET['usuario']) . "', "; }
    if (isset($_GET['equipo'])) { $query .= "equipo = '" . mysqli_real_escape_string($db_connection, $_GET['equipo']) . "', "; }

    if (isset($_GET['fecha_alta'])) { $query .= "fecha_alta = '" . mysqli_real_escape_string($db_connection, $_GET['fecha_alta']) . "', "; }
   
    if (isset($_GET['fecha_baja'])) { $query .= "fecha_baja = '" . mysqli_real_escape_string($db_connection, $_GET['fecha_baja']) . "'";   }
	 
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
      $query = "UPDATE tb_miembros_equipos SET ";
      if (isset($_GET['usuario'])) { $query .= "usuario = '" . mysqli_real_escape_string($db_connection, $_GET['usuario']) . "', "; }
      if (isset($_GET['equipo'])) { $query .= "equipo = '" . mysqli_real_escape_string($db_connection, $_GET['equipo']) . "', "; }
      
      if (isset($_GET['fecha_baja'])) { $query .= "fecha_baja = '" . mysqli_real_escape_string($db_connection, $_GET['fecha_baja']) . "'";   }
      $query .= "WHERE id_miembro = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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
      $query = "DELETE FROM tb_miembros_equipos WHERE id_miembro = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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