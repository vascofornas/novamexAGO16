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
    $query = "SELECT * FROM tb_tipos_proyectos";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['id_tipo_proyecto'] . '" data-name="' . $company['nombre_tipo_proyecto'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['id_tipo_proyecto'] . '" data-name="' . $company['nombre_tipo_proyecto'] . '"><span>Delete</span></a></li>';
		
        $functions .= '</ul></div>';
        $mysql_data[] = array(
         
          "nombre_tipo_proyecto"  => $company['nombre_tipo_proyecto'],
          "puntos_tipo_proyecto"    => $company['puntos_tipo_proyecto'],
        		
        		
        
		 
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
      $query = "SELECT * FROM tb_tipos_proyectos WHERE id_tipo_proyecto = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
              "nombre_tipo_proyecto"  => $company['nombre_tipo_proyecto'],
               "puntos_tipo_proyecto"    => $company['puntos_tipo_proyecto'],
        		
          		
          		"opcion1"  => $company['opcion1'],
          		"opcion2"  => $company['opcion2'],
          		"opcion3"  => $company['opcion3'],
          		"opcion4"  => $company['opcion4'],
          		"opcion5"  => $company['opcion5'],
          		"opcion6"  => $company['opcion6'],
          		"opcion7"  => $company['opcion7'],
          		"opcion8"  => $company['opcion8'],
          		"opcion9"  => $company['opcion9'],
          		"opcion10"  => $company['opcion10'],
          		"porcentaje1"  => $company['porcentaje1'],
          		"porcentaje2"  => $company['porcentaje2'],
          		"porcentaje3"  => $company['porcentaje3'],
          		"porcentaje4"  => $company['porcentaje4'],
          		"porcentaje5"  => $company['porcentaje5'],
          		"porcentaje6"  => $company['porcentaje6'],
          		"porcentaje7"  => $company['porcentaje7'],
          		"porcentaje8"  => $company['porcentaje8'],
          		"porcentaje9"  => $company['porcentaje9'],
          		"porcentaje10"  => $company['porcentaje10'],
          		"num_revisiones1"  => $company['num_revisiones1'],

          		"num_revisiones2"  => $company['num_revisiones2'],

          		"num_revisiones3"  => $company['num_revisiones3'],

          		"num_revisiones4"  => $company['num_revisiones4'],

          		"num_revisiones5"  => $company['num_revisiones5'],

          		"num_revisiones6"  => $company['num_revisiones6'],

          		"num_revisiones7"  => $company['num_revisiones7'],

          		"num_revisiones8"  => $company['num_revisiones8'],

          		"num_revisiones9"  => $company['num_revisiones9'],

          		"num_revisiones10"  => $company['num_revisiones10']
          		
          		
          		
        		
        
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    $query = "INSERT INTO tb_tipos_proyectos SET ";
    if (isset($_GET['nombre_tipo_proyecto'])) { $query .= "nombre_tipo_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['nombre_tipo_proyecto']) . "', "; }
   if (isset($_GET['puntos_tipo_proyecto'])) { $query .= "puntos_tipo_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['puntos_tipo_proyecto']) . "', "; }
   if (isset($_GET['opcion1'])) { $query .= "opcion1 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion1']) . "', "; }
   if (isset($_GET['opcion2'])) { $query .= "opcion2 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion2']) . "', "; }
   if (isset($_GET['opcion3'])) { $query .= "opcion3 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion3']) . "', "; }
   if (isset($_GET['opcion4'])) { $query .= "opcion4 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion4']) . "', "; }
   if (isset($_GET['opcion5'])) { $query .= "opcion5 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion5']) . "', "; }
   if (isset($_GET['opcion6'])) { $query .= "opcion6 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion6']) . "', "; }
   if (isset($_GET['opcion7'])) { $query .= "opcion7 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion7']) . "', "; }
   if (isset($_GET['opcion8'])) { $query .= "opcion8 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion8']) . "', "; }
   if (isset($_GET['opcion9'])) { $query .= "opcion9 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion9']) . "', "; }
   if (isset($_GET['opcion10'])) { $query .= "opcion10 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion10']) . "', "; }
   if (isset($_GET['porcentaje1'])) { $query .= "porcentaje1 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje1']) . "', "; }
   if (isset($_GET['porcentaje2'])) { $query .= "porcentaje2 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje2']) . "', "; }
   if (isset($_GET['porcentaje3'])) { $query .= "porcentaje3 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje3']) . "', "; }
   if (isset($_GET['porcentaje4'])) { $query .= "porcentaje4 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje4']) . "', "; }
   if (isset($_GET['porcentaje5'])) { $query .= "porcentaje5 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje5']) . "', "; }
   if (isset($_GET['porcentaje6'])) { $query .= "porcentaje6 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje6']) . "', "; }
   if (isset($_GET['porcentaje7'])) { $query .= "porcentaje7 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje7']) . "', "; }
   if (isset($_GET['porcentaje8'])) { $query .= "porcentaje8 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje8']) . "', "; }
   if (isset($_GET['porcentaje9'])) { $query .= "porcentaje9 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje9']) . "', "; }
   if (isset($_GET['num_revisiones1'])) { $query .= "num_revisiones1 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones1']) . "', "; }
   if (isset($_GET['num_revisiones2'])) { $query .= "num_revisiones2 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones2']) . "', "; }
   if (isset($_GET['num_revisiones3'])) { $query .= "num_revisiones3 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones3']) . "', "; }
   if (isset($_GET['num_revisiones4'])) { $query .= "num_revisiones4 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones4']) . "', "; }
   if (isset($_GET['num_revisiones5'])) { $query .= "num_revisiones5 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones5']) . "', "; }
   if (isset($_GET['num_revisiones6'])) { $query .= "num_revisiones6 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones6']) . "', "; }
   if (isset($_GET['num_revisiones7'])) { $query .= "num_revisiones7 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones7']) . "', "; }
   if (isset($_GET['num_revisiones8'])) { $query .= "num_revisiones8 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones8']) . "', "; }
   if (isset($_GET['num_revisiones9'])) { $query .= "num_revisiones9 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones9']) . "', "; }
   if (isset($_GET['num_revisiones10'])) { $query .= "num_revisiones10 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones10']) . "', "; }
     
    if (isset($_GET['porcentaje10'])) { $query .= "porcentaje10 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje10']) . "'";   }
	 
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
      $query = "UPDATE tb_tipos_proyectos SET ";
        if (isset($_GET['nombre_tipo_proyecto'])) { $query .= "nombre_tipo_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['nombre_tipo_proyecto']) . "', "; }
   if (isset($_GET['puntos_tipo_proyecto'])) { $query .= "puntos_tipo_proyecto = '" . mysqli_real_escape_string($db_connection, $_GET['puntos_tipo_proyecto']) . "', "; }
   if (isset($_GET['opcion1'])) { $query .= "opcion1 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion1']) . "', "; }
   if (isset($_GET['opcion2'])) { $query .= "opcion2 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion2']) . "', "; }
   if (isset($_GET['opcion3'])) { $query .= "opcion3 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion3']) . "', "; }
   if (isset($_GET['opcion4'])) { $query .= "opcion4 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion4']) . "', "; }
   if (isset($_GET['opcion5'])) { $query .= "opcion5 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion5']) . "', "; }
   if (isset($_GET['opcion6'])) { $query .= "opcion6 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion6']) . "', "; }
   if (isset($_GET['opcion7'])) { $query .= "opcion7 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion7']) . "', "; }
   if (isset($_GET['opcion8'])) { $query .= "opcion8 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion8']) . "', "; }
   if (isset($_GET['opcion9'])) { $query .= "opcion9 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion9']) . "', "; }
   if (isset($_GET['opcion10'])) { $query .= "opcion10 = '" . mysqli_real_escape_string($db_connection, $_GET['opcion10']) . "', "; }
   if (isset($_GET['porcentaje1'])) { $query .= "porcentaje1 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje1']) . "', "; }
   if (isset($_GET['porcentaje2'])) { $query .= "porcentaje2 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje2']) . "', "; }
   if (isset($_GET['porcentaje3'])) { $query .= "porcentaje3 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje3']) . "', "; }
   if (isset($_GET['porcentaje4'])) { $query .= "porcentaje4 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje4']) . "', "; }
   if (isset($_GET['porcentaje5'])) { $query .= "porcentaje5 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje5']) . "', "; }
   if (isset($_GET['porcentaje6'])) { $query .= "porcentaje6 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje6']) . "', "; }
   if (isset($_GET['porcentaje7'])) { $query .= "porcentaje7 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje7']) . "', "; }
   if (isset($_GET['porcentaje8'])) { $query .= "porcentaje8 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje8']) . "', "; }
   if (isset($_GET['porcentaje9'])) { $query .= "porcentaje9 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje9']) . "', "; }
   if (isset($_GET['num_revisiones1'])) { $query .= "num_revisiones1 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones1']) . "', "; }
   if (isset($_GET['num_revisiones2'])) { $query .= "num_revisiones2 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones2']) . "', "; }
   if (isset($_GET['num_revisiones3'])) { $query .= "num_revisiones3 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones3']) . "', "; }
   if (isset($_GET['num_revisiones4'])) { $query .= "num_revisiones4 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones4']) . "', "; }
   if (isset($_GET['num_revisiones5'])) { $query .= "num_revisiones5 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones5']) . "', "; }
   if (isset($_GET['num_revisiones6'])) { $query .= "num_revisiones6 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones6']) . "', "; }
   if (isset($_GET['num_revisiones7'])) { $query .= "num_revisiones7 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones7']) . "', "; }
   if (isset($_GET['num_revisiones8'])) { $query .= "num_revisiones8 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones8']) . "', "; }
   if (isset($_GET['num_revisiones9'])) { $query .= "num_revisiones9 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones9']) . "', "; }
   if (isset($_GET['num_revisiones10'])) { $query .= "num_revisiones10 = '" . mysqli_real_escape_string($db_connection, $_GET['num_revisiones10']) . "', "; }
   
    if (isset($_GET['porcentaje10'])) { $query .= "porcentaje10 = '" . mysqli_real_escape_string($db_connection, $_GET['porcentaje10']) . "'";   }
	
      $query .= "WHERE id_tipo_proyecto = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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
      $query = "DELETE FROM tb_tipos_proyectos WHERE id_tipo_proyecto = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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