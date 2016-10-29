<?php

session_start();
require_once 'class.user.php';

require_once 'funciones.php';
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
    
  	
  	
  	
    $query = "SELECT * FROM tb_puntos_libres_otorgados";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['id_puntos_libres_otorgados'] . '" data-name="' . $company['otorga_usuario'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['id_puntos_libres_otorgados'] . '" data-name="' . $company['otorga_usuario'] . '"><span>Delete</span></a></li>';
		
        $functions .= '</ul></div>';
        
        $otorga_usuario = get_nombre($row['userID']);
        $recibe_usuario = get_nombre($company['recibe_usuario']);
        $mysql_data[] = array(
         
          "otorga_usuario"  => $otorga_usuario,
          "recibe_usuario"    => $recibe_usuario,

        		"fecha_otorgacion"    => $company['fecha_otorgacion'],

        		"puntos_otorgados"    => $company['puntos_otorgados'],
        		
        		"comentarios_otorgados"    => $company['comentarios_otorgados'],
        		"puntos_libres_id"    => $company['puntos_libres_id'],
        		 
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
      $query = "SELECT * FROM tb_puntos_libres_otorgados WHERE id_puntos_libres_otorgados = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
                 "recibe_usuario"  =>  $company['recibe_usuario'],
          "puntos_otorgados"    =>  $company['puntos_otorgados'],

        	
        		"comentarios_otorgados"    => $company['comentarios_otorgados']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    $yo = $row['userID'];
    $query = "INSERT INTO tb_puntos_libres_otorgados SET ";
    if (isset($_SESSION['userSession'])) { $query .= "otorga_usuario = '" . mysqli_real_escape_string($db_connection, $_SESSION['userSession']) . "', "; }

    if (isset($_GET['recibe_usuario'])) { $query .= "recibe_usuario = '" . mysqli_real_escape_string($db_connection, $_GET['recibe_usuario']) . "', "; }
    if (isset($_GET['puntos_otorgados'])) { $query .= "puntos_otorgados = '" . mysqli_real_escape_string($db_connection, $_GET['puntos_otorgados']) . "', "; }
    if (isset($_GET['id_puntos'])) { $query .= "id_puntos = '" . mysqli_real_escape_string($db_connection, $_GET['id_puntos']) . "', "; }
    if (isset($_GET['comentarios_otorgados'])) { $query .= "comentarios_otorgados = '" . mysqli_real_escape_string($db_connection, $_GET['comentarios_otorgados']) . "'";   }
    
    
	 
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
      $query = "UPDATE tb_puntos_libres_otorgados SET ";
     if (isset($_GET['recibe_usuario'])) { $query .= "recibe_usuario = '" . mysqli_real_escape_string($db_connection, $_GET['recibe_usuario']) . "', "; }

    if (isset($_GET['puntos_otorgados'])) { $query .= "puntos_otorgados = '" . mysqli_real_escape_string($db_connection, $_GET['puntos_otorgados']) . "', "; }
    if (isset($_GET['puntos_libres_id'])) { $query .= "puntos_libres_id = '" . mysqli_real_escape_string($db_connection, $_GET['puntos_libres_id']) . "', "; }
    
    if (isset($_GET['comentarios_otorgados'])) { $query .= "comentarios_otorgados = '" . mysqli_real_escape_string($db_connection, $_GET['comentarios_otorgados']) . "'";   }
    
    
	 $query .= "WHERE id_puntos_libres_otorgados = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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
      $query = "DELETE FROM tb_puntos_libres_otorgados WHERE id_puntos_libres_otorgados = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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