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
    $query = "SELECT * FROM tb_tipos_otros_rubros";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['id_tor'] . '" data-name="' . $company['titulo_tor'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['id_tor'] . '" data-name="' . $company['titulo_tor'] . '"><span>Delete</span></a></li>';
		
        $functions .= '</ul></div>';
    
     
        
        if ($company['ambito_tor'] == 1){
        $scope = $lang['INDIVIDUAL'];
        }
        if ($company['ambito_tor'] == 2){
        $scope = $lang['EQUIPO'];
        }
        if ($company['ambito_tor'] == 3){
        $scope = $lang['REEGION'];
        }
        if ($company['ambito_tor'] == 4){
        $scope = $lang['UN'];
        }
        if ($company['ambito_tor'] == 5){
        $scope = $lang['TODOS'];
        }
       
                            
              if ($company['periodicidad_tor'] == 2){
        $periodo = $lang['EVERYDAY'];
        }     
        if ($company['periodicidad_tor'] == 3){
        $periodo = $lang['EVERY_WEEK'];
        }   
        if ($company['periodicidad_tor'] == 4){
        $periodo = $lang['EVERY_TWO_WEEKS'];
        }      
        if ($company['periodicidad_tor'] == 5){
        $periodo = $lang['EVERY_MONTH'];
        }      
        if ($company['periodicidad_tor'] == 6){
        $periodo = $lang['EVERY_TWO_MONTHS'];
        }      
        if ($company['periodicidad_tor'] == 7){
        $periodo = $lang['EVERY_THREE_MONTHS'];
        }  
        if ($company['periodicidad_tor'] == 8){
        $periodo = $lang['EVERY_FOUR_MONTHS'];
        }          
        if ($company['periodicidad_tor'] == 9){
        $periodo = $lang['EVERY_SIX_MONTHS'];
        }      
            
        if ($company['periodicidad_tor'] == 10){
        $periodo = $lang['EVERY_TWELVE_MONTHS'];
        }      
        
        
        
        
        $mysql_data[] = array(
         
     
        		"titulo"    => $company['titulo_tor'],
        		"descripcion"    => $company['descripcion_tor'],
        		"ambito"    => $scope,
        		"periodicidad"    => $periodo,
        		"repeticiones"    => $company['repeticiones_tor'],
        		"nivel"    => $company['nivel_crear'],
        		
        		
        
        		
        		
        
		 
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
      $query = "SELECT * FROM tb_tipos_otros_rubros WHERE id_tor = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
          
          		"titulo_tor"    => $company['titulo_tor'],
        		"descripcion_tor"    =>  $company['descripcion_tor'],
          		"concepto1"    =>  $company['concepto1'],
          		"concepto2"    =>  $company['concepto2'],
          		"concepto3"    =>  $company['concepto3'],
          		"concepto4"    =>  $company['concepto4'],
          		"sin_puntos"    =>  $company['sin_puntos'],
          		"leve"    =>  $company['puntos_esfuerzo_leve'],
          		"aceptable"    =>  $company['puntos_esfuerzo_aceptable'],
          		"excepcional"    =>  $company['puntos_esfuerzo_excepcional'],
          		"nivel_crear"    =>  $company['nivel_crear'],
          		"periodicidad_tor"    =>  $company['periodicidad_tor'],
        		"repeticiones_tor"    => $company['repeticiones_tor']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    
  	
  	
  	//nombre del supervisor
  	
  	
    $query = "INSERT INTO tb_tipos_otros_rubros SET ";
  
   if (isset($_GET['titulo_tor'])) { $query .= "titulo_tor = '" . mysqli_real_escape_string($db_connection, $_GET['titulo_tor']) . "', "; }
    
   if (isset($_GET['descripcion_tor'])) { $query .= "descripcion_tor = '" . mysqli_real_escape_string($db_connection, $_GET['descripcion_tor']) . "', "; } 
   if (isset($_GET['ambito_tor'])) { $query .= "ambito_tor = '" . mysqli_real_escape_string($db_connection, $_GET['ambito_tor']) . "', "; }
   if (isset($_GET['concepto1'])) { $query .= "concepto1 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto1']) . "', "; }
   if (isset($_GET['concepto2'])) { $query .= "concepto2 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto2']) . "', "; }
   if (isset($_GET['nivel_crear'])) { $query .= "nivel_crear = '" . mysqli_real_escape_string($db_connection, $_GET['nivel_crear']) . "', "; }
     
   if (isset($_GET['concepto3'])) { $query .= "concepto3 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto3']) . "', "; }
    
   if (isset($_GET['concepto4'])) { $query .= "concepto4 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto4']) . "', "; }
   if (isset($_GET['sin_puntos'])) { $query .= "sin_puntos = '" . mysqli_real_escape_string($db_connection, $_GET['sin_puntos']) . "', "; }
   if (isset($_GET['leve'])) { $query .= "puntos_esfuerzo_leve = '" . mysqli_real_escape_string($db_connection, $_GET['leve']) . "', "; }
   if (isset($_GET['aceptable'])) { $query .= "puntos_esfuerzo_aceptable = '" . mysqli_real_escape_string($db_connection, $_GET['aceptable']) . "', "; }
   if (isset($_GET['excepcional'])) { $query .= "puntos_esfuerzo_excepcional = '" . mysqli_real_escape_string($db_connection, $_GET['excepcional']) . "', "; }
        
 if (isset($_GET['periodicidad_tor'])) { $query .= "periodicidad_tor = '" . mysqli_real_escape_string($db_connection, $_GET['periodicidad_tor']) . "', "; }
   
   if (isset($_GET['repeticiones_tor'])) { $query .= "repeticiones_tor = '" . mysqli_real_escape_string($db_connection, $_GET['repeticiones_tor']) . "'";   }
	 
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
    	
    	
    	
    
      $query = "UPDATE tb_tipos_otros_rubros SET ";

      if (isset($_GET['titulo_tor'])) { $query .= "titulo_tor = '" . mysqli_real_escape_string($db_connection, $_GET['titulo_tor']) . "', "; }
      
      if (isset($_GET['descripcion_tor'])) { $query .= "descripcion_tor = '" . mysqli_real_escape_string($db_connection, $_GET['descripcion_tor']) . "', "; }
      if (isset($_GET['ambito_tor'])) { $query .= "ambito_tor = '" . mysqli_real_escape_string($db_connection, $_GET['ambito_tor']) . "', "; }
      if (isset($_GET['concepto1'])) { $query .= "concepto1 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto1']) . "', "; }
      if (isset($_GET['concepto2'])) { $query .= "concepto2 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto2']) . "', "; }
      
      if (isset($_GET['concepto3'])) { $query .= "concepto3 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto3']) . "', "; }
      if (isset($_GET['nivel_crear'])) { $query .= "nivel_crear = '" . mysqli_real_escape_string($db_connection, $_GET['nivel_crear']) . "', "; }
          
      if (isset($_GET['concepto4'])) { $query .= "concepto4 = '" . mysqli_real_escape_string($db_connection, $_GET['concepto4']) . "', "; }
      if (isset($_GET['sin_puntos'])) { $query .= "sin_puntos = '" . mysqli_real_escape_string($db_connection, $_GET['sin_puntos']) . "', "; }
      if (isset($_GET['leve'])) { $query .= "puntos_esfuerzo_leve = '" . mysqli_real_escape_string($db_connection, $_GET['leve']) . "', "; }
      if (isset($_GET['aceptable'])) { $query .= "puntos_esfuerzo_aceptable = '" . mysqli_real_escape_string($db_connection, $_GET['aceptable']) . "', "; }
      if (isset($_GET['excepcional'])) { $query .= "puntos_esfuerzo_excepcional = '" . mysqli_real_escape_string($db_connection, $_GET['excepcional']) . "', "; }
      
      if (isset($_GET['periodicidad_tor'])) { $query .= "periodicidad_tor = '" . mysqli_real_escape_string($db_connection, $_GET['periodicidad_tor']) . "', "; }
       
      if (isset($_GET['repeticiones_tor'])) { $query .= "repeticiones_tor = '" . mysqli_real_escape_string($db_connection, $_GET['repeticiones_tor']) . "'";   }
      	
      $query .= "WHERE id_tor  = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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
      $query = "DELETE FROM tb_tipos_otros_rubros WHERE id_tor = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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