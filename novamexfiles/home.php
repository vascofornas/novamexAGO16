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
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">


<title><?php echo $row['userName'];?>
</title>
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
body {
	background: rgba(255,220,138,1);
background: -moz-linear-gradient(left, rgba(255,220,138,1) 0%, rgba(255,194,41,1) 54%, rgba(255,210,97,1) 99%, rgba(224,161,0,1) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,220,138,1)), color-stop(54%, rgba(255,194,41,1)), color-stop(99%, rgba(255,210,97,1)), color-stop(100%, rgba(224,161,0,1)));
background: -webkit-linear-gradient(left, rgba(255,220,138,1) 0%, rgba(255,194,41,1) 54%, rgba(255,210,97,1) 99%, rgba(224,161,0,1) 100%);
background: -o-linear-gradient(left, rgba(255,220,138,1) 0%, rgba(255,194,41,1) 54%, rgba(255,210,97,1) 99%, rgba(224,161,0,1) 100%);
background: -ms-linear-gradient(left, rgba(255,220,138,1) 0%, rgba(255,194,41,1) 54%, rgba(255,210,97,1) 99%, rgba(224,161,0,1) 100%);
background: linear-gradient(to right, rgba(255,220,138,1) 0%, rgba(255,194,41,1) 54%, rgba(255,210,97,1) 99%, rgba(224,161,0,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffdc8a', endColorstr='#e0a100', GradientType=1 );
}
</style>
  <style>
div.fixed {
    position: fixed;
    right: 10px;
    top: 10px;
    width: 300px;
 
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
</head> 
<body>
  <div class="fixed">
  <?php 
  $idioma_actual = $_SESSION['lang'];
  
  
  if ($idioma_actual == "es"){?>
  <a href="home.php?lang=es"><img src="mexico.png" width="45" height="45" /></a>
<a href="home.php?lang=en"><img src="usa.png" width="30" height="30" /></a>
  <?php }
  if ($idioma_actual == "en"){?>
  <a href="home.php?lang=en"><img src="usa.png" width="45" height="45" /></a>
  <a href="home.php?lang=es"><img src="mexico.png" width="30" height="30" /></a>

<?php }?>

<?php 

$query = "SELECT * from tb_mensajes WHERE leido ='NO' AND receptor = '".$row['userID']."'";
 if ($result=mysqli_query($conexion,$query))
  {
   if(mysqli_num_rows($result) > 0)
    {
      ?>
      <a href="mensajes_recibidos.php"><img class="blink-image" src="email_open.png" width="40" height="40" /></a>
      <?php 
    }
  else
      echo $lang['NO_MESSAGE'];
  }
else
    echo "Query Failed.";
    ?>

</div>
<br><br><br>
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
            <a href="#" class="navbar-brand"><?php echo $lang['MEMBER_HOME']?></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php"><?php echo $lang['HOME']?></a></li>
                <li><a href="miperfil.php"><?php echo $lang['PROFILE']?></a></li>
                
                <li class="dropdown">
                
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['MESSAGES']?> <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="mensajes_recibidos.php"><?php echo $lang['RECEIVED_MESSAGES']?></a></li>
                        <li><a href="mensajes.php"><?php echo $lang['SENT_MESSAGES']?></a></li>
                     
                        
                        
                    </ul>
                </li>
              
                
                
                
                <?php
				$nivel = $row['userLevel'];
			
				if ($nivel != "Level 1") {
					?>
                    <li>
                    <a href="admin_home.php"><?php echo $lang['ADMIN_ZONE']?></a>
                    </li>
                    <?php 
				}
				?>
                
            </ul>
            
            <ul class="nav pull-right">
            	<li class="dropdown">
                	<a href="#" role="button"  class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span>
                    <?php echo $row['userName']." (". $lang['USER'].$row['userLevel'].")";?> <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu">
                    <li>
                    <a tabindex="-1" href="logout.php"><?php echo $lang['LOGOUT']?></a>
                    </li>
                    
                    </ul>
              </li>
          </ul> 
        </div>
    </nav>
</div>

<div class = "container">
   <div class = "row" >
   
     <div class = "col-xs-6 col-sm-6" >
         
         
        
         
         
         
         <p><?php 
         
         if ($idioma_actual == "es"){
         echo $row_Recordset1['mensaje_es'];}
         if ($idioma_actual == "en"){
         	echo $row_Recordset1['mensaje_en'];}
         	 
         ?></p>
      </div>
      
     <div class = "col-xs-6 col-sm-6" >
       <h2 align="center"><strong><?php echo $lang['NEWS']?></strong></h2>
        
        
        
        
        <?php 
         
         if ($idioma_actual == "es"){
         
         	 do { ?>
          <h4><?php echo $row_Recordset2['title_news']; ?></h4>
         <p><?php echo $row_Recordset2['text_news']; ?></p>
           <p><?php echo $lang['BY']?>: <strong><?php echo $row_Recordset2['user_news']; ?></strong></p>
           <?php echo $row_Recordset2['date_news']; ?>
           <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2)); 
         
         
         
         }
        
         if ($idioma_actual == "en"){
         	 do { ?>
          <h4><?php echo $row_Recordset2['title_news_en']; ?></h4>
         <p><?php echo $row_Recordset2['text_news_en']; ?></p>
           <p><?php echo $lang['BY']?>: <strong><?php echo $row_Recordset2['user_news']; ?></strong></p>
           <?php echo $row_Recordset2['date_news']; ?>
           <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2)); 
         	 }?>
         	 
        
         
     </div>

      <div class = "clearfix visible-xs"></div>
      
   
      
    
      
   </div>
</div>
</body>
</html>