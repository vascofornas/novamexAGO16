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
    
  	
  	
  	
    $query = "SELECT * FROM tb_puntos_libres_otorgados WHERE id_puntos = '".$_SESSION['puntos_libres']."'";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
      //  $functions .= '<li class="function_edit"><a data-id="'   . $company['id_puntos_libres_otorgados'] . '" data-name="' . $company['otorga_usuario'] . '"><span>Edit</span></a></li>';
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
    
  	
  	//ACTUALIZAR PUNTOS CONSUMIDOS DE PUNTOS LIBRES
  	$con = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
  		//GET TOTAL PUNTOS OTORGADOS ACTUALES
  		
  	$puntos_ya_consumidos = get_puntos_consumidos_puntos_libres();
  	$total_puntos_consumidos = $puntos_ya_consumidos + $_GET['puntos_otorgados'];
  	update_puntos_consumidos_puntos_libres($total_puntos_consumidos);
  	
  	
  	//FIN ACTUALIZAR PUNTOS CONSUMIDOS
  	//ACTUALIZAR PUNTOS LIBRES USUARIO
  	$existe = comprobar_si_existe_puntos_libres_usuario($_GET['recibe_usuario']);
  		//si existe ACTUALIZAR
  		if ($existe == 1){
  			$puntos_actuales = get_puntos_libres_usuario($_GET['recibe_usuario']);
  			$puntos_actualizados = $puntos_actuales+$_GET['puntos_otorgados'];
  			update_puntos_libres($_GET['recibe_usuario'],$puntos_actualizados);
  		}
  		//si no  existe CREAR
  		if ($existe == 0){
  			$puntos_actualizados = $_GET['puntos_otorgados'];
  			crear_puntos_libres_usuario($_GET['recibe_usuario'],$puntos_actualizados);
  		}
  	
  	
  	
  	
  	
  	
  	//FIN ACTUALIZAR PUNTOS LIBRES USUARIO
  	//ACTUALIZAR PUNTOS DISPONIBLES
  	
  $existe = comprobar_existe_puntos_disponibles($_GET['recibe_usuario']);
  		//si existe ACTUALIZAR
  		if ($existe == 1){
  			$puntos_actuales = get_puntos_disponibles($_GET['recibe_usuario']);
  			$puntos_actualizados = $puntos_actuales+$_GET['puntos_otorgados'];
  			update_puntos_disponibles($_GET['recibe_usuario'],$puntos_actualizados);
  		}
  		//si no  existe CREAR
  		if ($existe == 0){
  			$puntos_actualizados = $_GET['puntos_otorgados'];
  			crear_puntos_disponibles($_GET['recibe_usuario'],$puntos_actualizados);
  		}
  		 
  		
  		
  		
  	//FIN ACTUALIZAR PUNTOS DISPONIBLES
  	  
  	
    // Add company
    $yo = $row['userID'];
    
 
    
    
    $query = "INSERT INTO tb_puntos_libres_otorgados SET ";
    if (isset($_SESSION['userSession'])) { $query .= "otorga_usuario = '" . mysqli_real_escape_string($db_connection, $_SESSION['userSession']) . "', "; }

    if (isset($_GET['recibe_usuario'])) { $query .= "recibe_usuario = '" . mysqli_real_escape_string($db_connection, $_GET['recibe_usuario']) . "', "; }
    if (isset($_GET['puntos_otorgados'])) { $query .= "puntos_otorgados = '" . mysqli_real_escape_string($db_connection, $_GET['puntos_otorgados']) . "', "; }
    if (isset($_GET['puntos_otorgados'])) { $query .= "id_puntos = '" . mysqli_real_escape_string($db_connection, $_SESSION['puntos_libres']) . "', "; }
    
    if (isset($_GET['comentarios_otorgados'])) { $query .= "comentarios_otorgados = '" . mysqli_real_escape_string($db_connection, $_GET['comentarios_otorgados']). "'";   }
    
    
    
	 
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
    	
    	//ACTUALIZAR PUNTOS CONSUMIDOS
    	
    		//GET ID PUNTOS OTORGADOS
    	
    			$id_puntos_otorgados = $id;
    		//GET USER PUNTOS OTORGADOS
    		
    			$usuario_recibe = get_id_usuario_puntos_otorgados( $id);//OK
    			
    			//GET PUNTOS OTORGADOS
    			$puntos_a_restar = get_puntos_otorgados($id);//OK
    			 
    			//ACTUALIZAR PUNTOS OTORGADOS
    			//get puntos libres actuales del usuario
    			
    			$puntos_libres_actuales = get_puntos_libres_usuario($usuario_recibe);//OK
    	//ACTUALIZAR PUNTOS LIBRES USUARIO
    		$puntos_restantes = $puntos_libres_actuales - $puntos_a_restar;//OK
    update_puntos_libres_borrados($usuario_recibe,$puntos_restantes); //OK
    
    
    
    	//ACTUALIZAR PUNTOS DISPONIBLES USUARIO
    	
    
    	$puntos_disponibles_actuales = get_puntos_disponibles($usuario_recibe);//ok
   	$puntos_disponibles_resultantes = $puntos_disponibles_actuales - $puntos_a_restar;//ok
    	update_puntos_disponibles_borrar($usuario_recibe,$puntos_disponibles_resultantes);//PD
    	
    	
    	//ACTualizar puntos consumidos
    	
    	$puntos_ya_otorgados = get_puntos_consumidos_puntos_libres();
    	$puntos_consumidos_actuales = $puntos_ya_otorgados - $puntos_a_restar;
    	update_puntos_consumidos_puntos_libres($puntos_consumidos_actuales);
    	
    	
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