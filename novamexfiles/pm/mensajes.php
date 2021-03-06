<?php require_once('Connections/conexion.php'); 
header('Content-type: text/html; charset=utf-8' , true );
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
  //test dell
}
}

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
<style>
div.fixed {
    position: fixed;
    right: 10px;
    top: 10px;
    width: 300px;
 
}
textarea {
    background: yellow !important;
    color:#000;
    text-shadow:0 1px 0 rgba(0, 0, 0, 0.4);
}
</style>
<title><?php echo $row['userName']?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout.css">
    <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script charset="utf-8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
    <script charset="utf-8" src="//cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
    <script charset="utf-8" src="webapp_departamentos.js"></script>


<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
<style type="text/css">
.styled-select {
   background: url(http://i62.tinypic.com/15xvbd5.png) no-repeat 96% 0;
   height: 29px;
   overflow: hidden;
   width: 240px;
}

.styled-select select {
   background: transparent;
   border: none;
   font-size: 14px;
   height: 29px;
   padding: 5px; /* If you add too much padding here, the options won't show in IE */
   width: 268px;
}

.styled-select.slate {
   background: url(http://i62.tinypic.com/2e3ybe1.jpg) no-repeat right center;
   height: 34px;
   width: 240px;
}

.styled-select.slate select {
   border: 1px solid #ccc;
   font-size: 16px;
   height: 34px;
   width: 268px;
}

/* -------------------- Rounded Corners */
.rounded {
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
}

.semi-square {
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border-radius: 5px;
}

/* -------------------- Colors: Background */
.slate   { background-color: #ddd; }
.green   { background-color: #779126; }
.blue    { background-color: #3b8ec2; }
.yellow  { background-color: #eec111; }
.black   { background-color: #000; }

/* -------------------- Colors: Text */
.slate select   { color: #000; }
.green select   { color: #fff; }
.blue select    { color: #fff; }
.yellow select  { color: #000; }
.black select   { color: #fff; }


/* -------------------- Select Box Styles: danielneumann.com Method */
/* -------------------- Source: http://danielneumann.com/blog/how-to-style-dropdown-with-css-only/ */
#mainselection select {
   border: 0;
   color: #EEE;
   background: transparent;
   font-size: 20px;
   font-weight: bold;
   padding: 2px 10px;
   width: 378px;
   *width: 350px;
   *background: #58B14C;
   -webkit-appearance: none;
}

#mainselection {
   overflow:hidden;
   width:350px;
   -moz-border-radius: 9px 9px 9px 9px;
   -webkit-border-radius: 9px 9px 9px 9px;
   border-radius: 9px 9px 9px 9px;
   box-shadow: 1px 1px 11px #330033;
   background: #58B14C url("http://i62.tinypic.com/15xvbd5.png") no-repeat scroll 319px center;
}


/* -------------------- Select Box Styles: stackoverflow.com Method */
/* -------------------- Source: http://stackoverflow.com/a/5809186 */
select#soflow, select#soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
   background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
   background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   margin: 20px;
   overflow: hidden;
   padding: 5px 10px;
   text-overflow: ellipsis;
   white-space: nowrap;
   width: 300px;
}

select#soflow-color {
   color: #fff;
   background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#779126, #779126 40%, #779126);
   background-color: #779126;
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
   padding-left: 15px;
}
body {
	background-image: url(fondonovamex.jpg);
}
</style>
</head> 
<body>
<div class="fixed">
<a href="mensajes.php?lang=en"><img src="usa.png" width="45" height="45" /></a>
<a href="mensajes.php?lang=es"><img src="mexico.png" width="45" height="45" /></a>

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
                   <li><a href="miperfil.php"><?php echo $lang['PROFILE']?></a></li>
                <li><a href="mensajes.php"><?php echo $lang['MESSAGES']?></a></li>
               
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
</div>
<div class="container">
	<div class="row">

    </div>
    </div>
</div>


    <p>&nbsp;</p>
    <h1 align="center"><?php echo $lang['MESSAGES']?></h1>
    <p align="center">&nbsp;</p>
    <div id="page_container">

      

      <div align="center">
        <button type="button" class="button" id="add_company"><?php echo $lang['ADD_MESSAGE']?></button>
        
      </div>
      <table class="datatable" id="table_companies">
        <thead>
          <tr>
           
            
            <th><?php echo $lang['TITLE']?></th>
            <th><?php echo $lang['RECEPTOR']?></th>
         
            
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
        
        <h2><?php echo $lang['ADD_MESSAGE']?></h2>
        <form class="form add" id="form_company" data-id="" novalidate>
        
         <?php   $sqlBU="SELECT * FROM tbl_users ORDER BY userName";?>
           
<div class="input_container">
        <label for="receptor"><?php echo $lang['TO']?>: <span class="required">*</span></label>
            <div class="styled-select slate">
              <select  id="to" name="to" class="selectpicker"  required>
           
           
        <?php   if ($result=mysqli_query($conexion,$sqlBU))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
    printf ("%s (%s)\n",$row[0],$row[1]);
    echo '<option value='.$row[0].' selected>'.$row[1].' ('.$row[7].' '.$row[8].')'.'</option>';
    }
  // Free result set
  mysqli_free_result($result);
}
     ?>           
                
                
          
          <div class="input_container">
            <label for="nombre_departamento"><?php echo $lang['DEPARTMENT']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="nombre_departamento" id="nombre_departamento" value="" required>
            </div>
          </div>
       
        
                
               
                
                
                
              </select>
            </div>
          </div>
          
         
          <div class="button_container">
            <button type="submit"><?php echo $lang['ADD_DEPARTMENT']?></button>
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
           <?php echo $lang['PROCESSING']?>
          </div>
        </div>
      </div>
    </div>
    
</body>
</html>
<?php

?>
