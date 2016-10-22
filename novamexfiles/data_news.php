<?php

session_start();
require_once 'class.user.php';
include_once 'funciones.php';
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
    $query = "SELECT * FROM tb_news ORDER BY date_news";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class=><a href="admin_editar_noticia.php?id='   . $company['id_news'] . '" data-name="' . $company['title_news'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['id_news'] . '" data-name="' . $company['title_news'] . '"><span>Delete</span></a></li>';
		
        $functions .= '</ul></div>';
        $mysql_data[] = array(
         
          "text_news"  => $company['text_news'],

        		"text_news_en"  => $company['text_news_en'],
          "title_news"    => $company['title_news'],
        		"title_news_en"    => $company['title_news_en'],
		  "user_news"    => $company['user_news'],
		  "date_news"    => $company['date_news'],
          "active_news"  => $company['active_news'],
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
      $query = "SELECT * FROM tb_news WHERE id_news = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
             "title_news"  => $company['title_news'],
          "text_news"    => $company['text_news'],
          		"title_news_en"  => $company['title_news_en'],
          		"text_news_en"    => $company['text_news_en'],
          "active_news"  => $company['active_news']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    $query = "INSERT INTO tb_news SET ";
    if (isset($_GET['title_news'])) { $query .= "title_news = '" . mysqli_real_escape_string($db_connection, $_GET['title_news']) . "', "; }
    if (isset($_GET['text_news']))   { $query .= "text_news   = '" . mysqli_real_escape_string($db_connection, $_GET['text_news'])   . "', "; }
    if (isset($_GET['title_news_en'])) { $query .= "title_news_en = '" . mysqli_real_escape_string($db_connection, $_GET['title_news_en']) . "', "; }
    if (isset($_GET['text_news_en']))   { $query .= "text_news_en   = '" . mysqli_real_escape_string($db_connection, $_GET['text_news_en'])   . "', "; }
    
    
    $query .= "user_news = '".$row['userName']. "', ";
    if (isset($_GET['active_news'])) { $query .= "active_news = '" . mysqli_real_escape_string($db_connection, $_GET['active_news']) . "'";   }
	 
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
      $query = "UPDATE tb_news SET ";
      if (isset($_GET['title_news'])) { $query .= "title_news = '" . mysqli_real_escape_string($db_connection, $_GET['title_news']) . "', "; }
      if (isset($_GET['text_news']))   { $query .= "text_news   = '" . mysqli_real_escape_string($db_connection, $_GET['text_news'])   . "', "; }
      if (isset($_GET['title_news_en'])) { $query .= "title_news_en = '" . mysqli_real_escape_string($db_connection, $_GET['title_news_en']) . "', "; }
      if (isset($_GET['text_news_en']))   { $query .= "text_news_en   = '" . mysqli_real_escape_string($db_connection, $_GET['text_news_en'])   . "', "; }
      
      if (isset($_GET['active_news'])) { $query .= "active_news = '" . mysqli_real_escape_string($db_connection, $_GET['active_news']) . "'";   }
      $query .= "WHERE id_news = '" . mysqli_real_escape_string($db_connection, $id) . "'";
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
      $query = "DELETE FROM tb_news WHERE id_news = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      $texto = "USUARIO ELIMINA NOTICIA";
      $codigo = "012";
      $miemail = get_email($_SESSION['userSession']);
      add_log($texto,$miemail,$codigo);
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