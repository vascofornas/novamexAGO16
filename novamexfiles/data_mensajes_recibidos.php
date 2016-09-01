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
    $query = "SELECT * FROM tb_mensajes LEFT JOIN tbl_users ON tb_mensajes.emisor = tbl_users.userID WHERE receptor ='".$row['userID']."' ORDER BY timestamp desc";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['id_mensaje'] . '" data-name="' . $company['titulo'] . '"><span>Delete</span></a></li>';
		
        $functions .= '</ul></div>';
        $mysql_data[] = array(
         
          "titulo"  => $company['titulo'],
        		"texto"  => $company['texto'],
        		
          "userName"    => $company['userName']." (".$company['nombre_usuario']." ".$company['apellidos_usuario'].")",
        		"timestamp"    => $company['timestamp'],
        		
        		"contestado"    => $company['contestado'],
        			
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
      $query = "SELECT * FROM tb_mensajes WHERE id_mensaje = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
             "titulo"  => $company['titulo'],
          "texto"    => $company['texto']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    $query = "INSERT INTO tb_mensajes SET ";
    if (isset($_GET['titulo'])) { $query .= "titulo = '" . mysqli_real_escape_string($db_connection, $_GET['titulo']) . "', "; }
    if (isset($_GET['texto'])) { $query .= "texto = '" . mysqli_real_escape_string($db_connection, $_GET['texto']) . "', "; }
    if (isset($_GET['receptor'])) { $query .= "receptor = '" . mysqli_real_escape_string($db_connection, $_GET['receptor']) . "', "; }
     
   
    	$query .= "emisor = '" . $row['userID'] . "'";   
    
	 
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
      $query = "UPDATE tb_departamentos SET ";
      if (isset($_GET['nombre_departamento'])) { $query .= "nombre_departamento = '" . mysqli_real_escape_string($db_connection, $_GET['nombre_departamento']) . "', "; }
      
      if (isset($_GET['unidad_negocio_departamento'])) { $query .= "unidad_negocio_departamento = '" . mysqli_real_escape_string($db_connection, $_GET['unidad_negocio_departamento']) . "'";   }
      $query .= "WHERE id_departamento = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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
      $query = "DELETE FROM tb_mensajes WHERE id_mensaje = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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