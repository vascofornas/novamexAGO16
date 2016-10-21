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
    $query = "SELECT * FROM tb_puntos_libres";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['id_puntos_libres'] . '" data-name="' . $company['level5_user'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['id_puntos_libres'] . '" data-name="' . $company['level5_user'] . '"><span>Delete</span></a></li>';
		
        $functions .= '</ul></div>';
        
        $usuario_da = get_nombre($company['level5_user']);
        $usuario_recibe = get_nombre($company['level3_user']);
        $mysql_data[] = array(
         
          "level5_user"  => $usuario_da,
          "level3_user"    => $usuario_recibe,

        		"total_puntos_libres"    => $company['total_puntos_libres'],

        		"max_puntos_libres"    => $company['max_puntos_libres'],
        		
        		"total_puntos_consumidos"    => $company['total_puntos_consumidos'],
        		
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
      $query = "SELECT * FROM tb_puntos_libres WHERE id_puntos_libres = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
                 "level5_user"  =>  $company['level5_user'],
          "level3_user"    =>  $company['level3_user'],

        		"total_puntos_libres"    => $company['total_puntos_libres'],
          		"max_puntos_libres"    => $company['max_puntos_libres'],

        		"total_puntos_consumidos"    => $company['total_puntos_consumidos']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    $query = "INSERT INTO tb_puntos_libres SET ";
    if (isset($_GET['level5_user'])) { $query .= "level5_user = '" . mysqli_real_escape_string($db_connection, $_GET['level5_user']) . "', "; }

    if (isset($_GET['level3_user'])) { $query .= "level3_user = '" . mysqli_real_escape_string($db_connection, $_GET['level3_user']) . "', "; }
    if (isset($_GET['total_puntos_libres'])) { $query .= "total_puntos_libres = '" . mysqli_real_escape_string($db_connection, $_GET['total_puntos_libres']) . "', "; }
    if (isset($_GET['max_puntos_libres'])) { $query .= "max_puntos_libres = '" . mysqli_real_escape_string($db_connection, $_GET['max_puntos_libres']) . "', "; }
    
    if (isset($_GET['total_puntos_consumidos'])) { $query .= "total_puntos_consumidos = '" . mysqli_real_escape_string($db_connection, $_GET['total_puntos_consumidos']) . "'";   }
    
    
	 
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
      $query = "UPDATE tb_puntos_libres SET ";
     if (isset($_GET['level5_user'])) { $query .= "level5_user = '" . mysqli_real_escape_string($db_connection, $_GET['level5_user']) . "', "; }

    if (isset($_GET['level3_user'])) { $query .= "level3_user = '" . mysqli_real_escape_string($db_connection, $_GET['level3_user']) . "', "; }
    if (isset($_GET['max_puntos_libres'])) { $query .= "max_puntos_libres = '" . mysqli_real_escape_string($db_connection, $_GET['max_puntos_libres']) . "', "; }
     
    if (isset($_GET['total_puntos_consumidos'])) { $query .= "total_puntos_consumidos = '" . mysqli_real_escape_string($db_connection, $_GET['total_puntos_consumidos']) . "'";   }
    
    
	 $query .= "WHERE id_puntos_libres = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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
      $query = "DELETE FROM tb_puntos_libres WHERE id_puntos_libres = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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