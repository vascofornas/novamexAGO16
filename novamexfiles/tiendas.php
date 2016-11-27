<?php 

header('Content-type: text/html; charset=utf-8' , true );
include_once 'common.php';

require_once('Connections/conexion.php');
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

mysqli_select_db( $conexion,$database_conexion);
$query_Recordset1 = "SELECT * FROM tb_welcome_message WHERE tb_welcome_message.id_mensaje =1";
$Recordset1 = mysqli_query( $conexion,$query_Recordset1) or die(mysqli_error());

$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

mysqli_select_db($conexion, $database_conexion);
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
$stmt = $user_home->runQuery("SELECT t1.* , t3.unidad_negocio as uni, t2.userName as super FROM tbl_users t1 LEFT JOIN tb_unidades_negocio t3 ON t1.unidad_negocio_usuario = t3.id_unidades_negocio LEFT JOIN tbl_users t2 ON t1.supervisor_usuario = t2.userID WHERE t1.userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">

  

<title><?php echo $row['userName']?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
<style type="text/css">
html, body{
  height: 100%;
}
body { 
			background-image: url(sLSdbm.jpg) ;
			background-position: center center;
			background-repeat:  no-repeat;
			background-attachment: fixed;
			background-size:  cover;
			background-color: #999;
  
}
</style>
  <style>
div.fixed {
    position: fixed;
    right: 10px;
    top: 10px;
    width: 300px;
 
}
div.logo {
    position: fixed;
    left: 20px;
    top: 10px;
    width: 414px;
 
}
</style>
<style>
/* Firefox old*/
@-moz-keyframes blink {
    0% {
        opacity:1;
    }
    50% {
        opacity:0;
    }
    100% {
        opacity:1;
    }
} 

@-webkit-keyframes blink {
    0% {
        opacity:1;
    }
    50% {
        opacity:0;
    }
    100% {
        opacity:1;
    }
}
/* IE */
@-ms-keyframes blink {
    0% {
        opacity:1;
    }
    50% {
        opacity:0;
    }
    100% {
        opacity:1;
    }
} 
/* Opera and prob css3 final iteration */
@keyframes blink {
    0% {
        opacity:1;
    }
    50% {
        opacity:0;
    }
    100% {
        opacity:1;
    }
} 
.blink-image {
    -moz-animation: blink normal 2s infinite ease-in-out; /* Firefox */
    -webkit-animation: blink normal 2s infinite ease-in-out; /* Webkit */
    -ms-animation: blink normal 2s infinite ease-in-out; /* IE */
    animation: blink normal 2s infinite ease-in-out; /* Opera and prob css3 final iteration */
}
</style>
<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'edituser.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			$('#form-content').fadeOut('slow', function(){
				$('#form-content').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	});
	
});
</script>
<script type="text/javascript">
function subirimagen()

{

	self.name = 'opener';

	remote = open('subirfoto.php','remote','width=300,height=150,location=no,scrollbars=yes, menubar=no, toolbars=no,resizable=yes,fullscreen=yes, status=yes');

	remote.focus();
	}


</script>
</head> 
<body>

<?php include 'menu.php';?>

<div class = "container">
 
   <?php $un =  get_unidad_negocio_usuario($_SESSION['userSession']);
   
   
   if ($un != 4){?>
     
    <div class="row">

<div class="col-sm-4 col-md-4 col-lg-4">
<a href="https://www.walmart.com.mx/" target="_blank">
<img border="0" alt="Walmart Mexico" src="WALMART.png" width="270" height="120">
   		   </div>
   		    <div class="col-sm-4 col-md-4 col-lg-4">

 <a href="http://www.costco.com.mx/" target="_blank">
<img border="0" alt="COSTCO Mexico" src="costco.png" width="270" height="120">
   		   </div>
   		   <div class="col-sm-4 col-md-4 col-lg-4">

 <a href="https://www.sams.com.mx/" target="_blank">
<img border="0" alt="SAMS Mexico" src="sams.png" width="150" height="150">
   		   </div>
   		   
   		   
   		      <div class="row">
  <div class="col-sm-4 col-md-4 col-lg-4">

 <a href="https://www.soriana.com/" target="_blank">
<img border="0" alt="SORIANA" src="soriana.png" width="270" height="120">
   		   </div>
   		     
   		     
   		     </div>
  
   <?php }
   else {?>		     
     
    <div class="row">

<div class="col-sm-4 col-md-4 col-lg-4">
<a href="https://www.walmart.com/" target="_blank">
<img border="0" alt="Walmart" src="WALMART.png" width="270" height="120">
   		   </div>
   		    <div class="col-sm-4 col-md-4 col-lg-4">

 <a href="http://www.costco.com/" target="_blank">
<img border="0" alt="COSTCO" src="costco.png" width="270" height="120">
   		   </div>
   		   <div class="col-sm-4 col-md-4 col-lg-4">

 <a href="https://www.sams.com/" target="_blank">
<img border="0" alt="SAMS Mexico" src="sams.png" width="150" height="150">
   		   </div>
   		   
   		   
   		      <div class="row">
  <div class="col-sm-4 col-md-4 col-lg-4">

 <a href="https://www.bestbuy.com/" target="_blank">
<img border="0" alt="BESTBUY" src="bestbuy.png" width="270" height="120">
   		   </div>
   		     <div class="col-sm-4 col-md-4 col-lg-4">

 <a href="https://www.target.com/" target="_blank">
<img border="0" alt="TARGET" src="target.png" width="180" height="210">
   		   </div>
   		     
   		     
   		     </div>
  
   		 <?php }?>  
   		   
   		   
   		  
   		   
   		   
   		   
   		  
   		   
   		   


 












  
</div>
    
    
  </div>
  
</div>
</body>
</html>
