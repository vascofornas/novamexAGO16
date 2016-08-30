<?php require_once('Connections/conexion.php'); 
include_once 'common.php';
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
//TEST

mysqli_select_db($conexion,$database_conexion);
$query_Recordset1 = "SELECT * FROM tb_welcome_message WHERE tb_welcome_message.id_mensaje =1";
$Recordset1 = mysqli_query($conexion,$query_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

mysqli_select_db($conexion,$database_conexion);
$query_Recordset2 = "SELECT * FROM tb_news WHERE tb_news.active_news = 1";
$Recordset2 = mysqli_query($conexion,$query_Recordset2) or die(mysql_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
 
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<title><?php echo $row['userName']?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
div.fixed {
    position: fixed;
    right: 10px;
    top: 10px;
    width: 300px;
 
}
</style>

<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout.css">
    <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script charset="utf-8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
    <script charset="utf-8" src="//cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
    <script charset="utf-8" src="webapp_bu.js"></script>


<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
<style type="text/css">
body {
	background-image: url(fondonovamex.jpg);
}
</style>
</head> 
<body>
<div class="fixed">
<a href="admin_bu.php?lang=en"><img src="usa.png" width="45" height="45" /></a>
<a href="admin_bu.php?lang=es"><img src="mexico.png" width="45" height="45" /></a>

</div>
<br><br>
<div class="bs-example">
    <nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand"><?php echo $lang['ADMIN_ZONE']?></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="admin_home.php"><?php echo $lang['ADMIN_ZONE']?></a></li>
                <li ><a href="home.php"><?php echo $lang['MEMBER_HOME']?></a></li>
                <li><a href="#"><?php echo $lang['PROFILE']?></a></li>
                     <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['MESSAGES']?><b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#"><?php echo $lang['INBOX']?></a></li>
                        <li><a href="#"><?php echo $lang['SENT']?></a></li>
                        
                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['LEVEL_5_OPTIONS']?> <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="admin_welcome_message.php"><?php echo $lang['WELCOME_MESSAGE']?></a></li>
                        <li><a href="admin_news.php"><?php echo $lang['NEWS']?></a></li>
                        <li><a href="admin_bu.php"><?php echo $lang['BUSINESS_UNITS']?></a></li>
                        <li><a href="admin_departamentos.php"><?php echo $lang['DEPARTMENTS']?></a></li>
                        <li><a href="admin_usuarios.php"><?php echo $lang['USERS']?></a></li>
                        
                        <li class="divider"></li>
                        
                    </ul>
                </li>
                
                
                
                
                
            </ul>
            
            <ul class="nav pull-right">
            	<li class="dropdown">
                	<a href="#" role="button"  class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span>
                     <?php echo $row['userName']." (". $lang['USER'].$row['userLevel'].")";?> <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu">
                    <li>
                    <a tabindex="-1" href="logout.php">Logout</a>
                    </li>
                    
                    </ul>
              </li>
          </ul> 
        </div>
    </nav>
</div><div class="container">
	<div class="row">

    </div>
    </div>
</div>


    <p>&nbsp;</p>
    <h1 align="center"><?php echo $lang['BUSINESS_UNITS']?></h1>
    <p align="center">&nbsp;</p>
    <div id="page_container">

      

      <div align="center">
        <button type="button" class="button" id="add_company"><?php echo $lang['ADD_BU']?></button>
        
      </div>
      <table class="datatable" id="table_companies">
        <thead>
          <tr>
           
            
            <th><?php echo $lang['BUSINESS_UNIT']?></th>
            
            
            <th><?php echo $lang['ACTIONS']?></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

</div>

    <div class="lightbox_bg"></div>

    <div class="lightbox_container">
      <div class="lightbox_close"></div>
      <div class="lightbox_content">
        
        <h2><?php echo $lang['ADD_BU']?></h2>
        <form class="form add" id="form_company" data-id="" novalidate>
          
          <div class="input_container">
            <label for="unidad_negocio"><?php echo $lang['BUSINESS_UNIT']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="unidad_negocio" id="unidad_negocio" value="" required>
            </div>
          </div>
         
          
         
          <div class="button_container">
            <button type="submit"><?php echo $lang['ADD_BU']?></button>
          </div>
        </form>
        
      </div>
    </div>

    <noscript id="noscript_container">
      <div id="noscript" class="error">
        <p>JavaScript support is needed to use this page.</p>
      </div>
    </noscript>

    <div id="message_container">
      <div id="message" class="success">
        <p>This is a success message.</p>
      </div>
    </div>

    <div id="loading_container">
      <div id="loading_container2">
        <div id="loading_container3">
          <div id="loading_container4">
            Procesando datos, espere, por favor...
          </div>
        </div>
      </div>
    </div>
    
</body>
</html>
<?php

?>
