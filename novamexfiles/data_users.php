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
  if (mysqli_connect_errno()){
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
    $job     = '';
  }
  
  // Execute job
  if ($job == 'get_companies'){
    
    // Get companies
    $query = "SELECT * FROM tbl_users LEFT JOIN tb_unidades_negocio ON 
    		tbl_users.unidad_negocio_usuario =  tb_unidades_negocio.id_unidades_negocio
    		LEFT JOIN tb_departamentos ON 
    		tbl_users.region_usuario =  tb_departamentos.id_departamento
    		ORDER BY apellidos_usuario";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['userID'] . '" data-name="' . $company['userName'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['userID'] . '" data-name="' . $company['userName'] . '"><span>Delete</span></a></li>';
		
        $functions .= '</ul></div>';
        if ( $company['autorizado'] ==1){
        	$autorizado = "Y";
        }
        if ( $company['autorizado'] ==0){
        	$autorizado = "N";
        }
        $mysql_data[] = array(
         
          "userName"  => $company['userName'],
          "nombre_usuario"    => $company['nombre_usuario'],
		  "apellidos_usuario"    => $company['apellidos_usuario'],
        		"unidad_negocio"  => $company['unidad_negocio'],
        		"region_usuario"  => $company['nombre_departamento'],
        		"supervisor_usuario"  => get_nombre($company['supervisor_usuario']),
		  "userLevel"  => $company['userLevel'],
		  "userStatus"  => $company['userStatus'],
        		"autorizado"  => $autorizado,
		  
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
      $query = "SELECT * FROM tbl_users WHERE userID = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
		  
            "userName"  => $company['userName'],
          "nombre_usuario"    => $company['nombre_usuario'],
		  "apellidos_usuario"    => $company['apellidos_usuario'],
		  "userEmail"    => $company['userEmail'],
          "unidad_negocio_usuario"    => $company['unidad_negocio_usuario'],
          		"region_usuario"    => $company['region_usuario'],
          		"supervisor_usuario"    => $company['supervisor_usuario'],
          		
		  "userLevel"  => $company['userLevel'],
          		
		  "userStatus"  => $company['userStatus'],
          		"autorizado"  => $company['autorizado']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    $query = "INSERT INTO tbl_users SET ";
    if (isset($_GET['userName'])) { $query .= "userName = '" . mysqli_real_escape_string($db_connection, $_GET['userName']) . "', "; }
    if (isset($_GET['nombre_usuario']))   { $query .= "nombre_usuario   = '" . mysqli_real_escape_string($db_connection, $_GET['nombre_usuario'])   . "', "; }
	if (isset($_GET['apellidos_usuario']))   { $query .= "apellidos_usuario   = '" . mysqli_real_escape_string($db_connection, $_GET['apellidos_usuario'])   . "', "; }
	if (isset($_GET['userEmail']))   { $query .= "userEmail   = '" . mysqli_real_escape_string($db_connection, $_GET['userEmail'])   . "', "; }
	
	if (isset($_GET['unidad_negocio_usuario']))   { $query .= "unidad_negocio_usuario   = '" . (mysqli_real_escape_string($db_connection, $_GET['unidad_negocio_usuario']))   . "', "; }
	if (isset($_GET['region_usuario']))   { $query .= "region_usuario   = '" . (mysqli_real_escape_string($db_connection, $_GET['region_usuario']))   . "', "; }
	
	if (isset($_GET['supervisor_usuario']))   { $query .= "supervisor_usuario   = '" . (mysqli_real_escape_string($db_connection, $_GET['supervisor_usuario']))   . "', "; }
	
	if (isset($_GET['userLevel']))   { $query .= "userLevel   = '" . mysqli_real_escape_string($db_connection, $_GET['userLevel'])   . "', "; }
	if (isset($_GET['autorizado']))   { $query .= "autorizado   = '" . mysqli_real_escape_string($db_connection, $_GET['autorizado'])   . "', "; }
	
	if (isset($_GET['userStatus'])) { $query .= "userStatus = '" . mysqli_real_escape_string($db_connection, $_GET['userStatus']) . "'";   }
	 
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
      $query = "UPDATE tbl_users SET ";
        if (isset($_GET['userName'])) { $query .= "userName = '" . mysqli_real_escape_string($db_connection, $_GET['userName']) . "', "; }
    if (isset($_GET['nombre_usuario']))   { $query .= "nombre_usuario   = '" . mysqli_real_escape_string($db_connection, $_GET['nombre_usuario'])   . "', "; }
	if (isset($_GET['apellidos_usuario']))   { $query .= "apellidos_usuario   = '" . mysqli_real_escape_string($db_connection, $_GET['apellidos_usuario'])   . "', "; }
	if (isset($_GET['userEmail']))   { $query .= "userEmail   = '" . mysqli_real_escape_string($db_connection, $_GET['userEmail'])   . "', "; }
	
	if (isset($_GET['unidad_negocio_usuario']))   { $query .= "unidad_negocio_usuario   = '" . (mysqli_real_escape_string($db_connection, $_GET['unidad_negocio_usuario']))   . "', "; }
	if (isset($_GET['region_usuario']))   { $query .= "region_usuario   = '" . (mysqli_real_escape_string($db_connection, $_GET['region_usuario']))   . "', "; }
	
	if (isset($_GET['supervisor_usuario']))   { $query .= "supervisor_usuario   = '" . (mysqli_real_escape_string($db_connection, $_GET['supervisor_usuario']))   . "', "; }
	
	if (isset($_GET['userLevel']))   { $query .= "userLevel   = '" . mysqli_real_escape_string($db_connection, $_GET['userLevel'])   . "', "; }
	if (isset($_GET['autorizado']))   { $query .= "autorizado   = '" . mysqli_real_escape_string($db_connection, $_GET['autorizado'])   . "', "; }
	
	if (isset($_GET['userStatus'])) { $query .= "userStatus = '" . mysqli_real_escape_string($db_connection, $_GET['userStatus']) . "'";   }
      $query .= "WHERE userID = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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
      $query = "DELETE FROM tbl_users WHERE userID = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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