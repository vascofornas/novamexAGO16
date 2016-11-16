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
$texto = "USUARIO ENTRA EN ZONA DE ADMINISTRADORES";
$codigo = "007";
$miemail = get_email($_SESSION['userSession']);
add_log($texto,$miemail,$codigo);
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
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
<style type="text/css">
body {
	
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
.blink-image {
    -moz-animation: blink normal 2s infinite ease-in-out; /* Firefox */
    -webkit-animation: blink normal 2s infinite ease-in-out; /* Webkit */
    -ms-animation: blink normal 2s infinite ease-in-out; /* IE */
    animation: blink normal 2s infinite ease-in-out; /* Opera and prob css3 final iteration */
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
<!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
 <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


</head> 
<body>
<?php include 'menu_admin.php';?>

<div class="container">
<!-- Small boxes (Stat box) -->
         
             <div class="row">
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><?php echo '<font color="WHITE">'.get_noticias().'</font>' ?></h3>
                  
                  <H4><?php echo $lang['NEWS']?></h4>
                </div>
                <div class="icon">
                 <i class="ion ion-speakerphone"></i>
                </div>
                <a href="admin_news.php" class="small-box-footer">
                  <?php echo $lang['MORE_INFO']?> <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo '<font color="WHITE">'.get_un().'</font>' ?></h3>
                  <H4><?php echo $lang['BUSINESS_UNITS']?></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-briefcase"></i>
                </div>
                <a href="admin_bu.php" class="small-box-footer">
                  <?php echo $lang['MORE_INFO']?> <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo '<font color="WHITE">'.get_departamentos().'</font>' ?></h3>
                  <H4><?php echo $lang['DEPARTMENTS']?></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-pie"></i>
                </div>
                <a href="admin_departamentos.php" class="small-box-footer">
                  <?php echo $lang['MORE_INFO']?> <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            
          </div><!-- /.row -->
          <!-- Small boxes (Stat box) -->
         
             <div class="row">
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-orange">
                <div class="inner">
                 <h3><?php echo '<font color="WHITE">'.get_equipos().'</font>' ?></h3> 
                  <H4><?php echo $lang['TEAMS']?></h4>
                </div>
                <div class="icon">
                 <i class="ion ion-person-stalker"></i>
                </div>
                <a href="admin_equipos.php" class="small-box-footer">
                  <?php echo $lang['MORE_INFO']?> <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo '<font color="WHITE">'.get_num_proyectos().'</font>' ?></h3> 
                  <H4><?php echo $lang['PROJECTS']?></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="admin_proyectos.php" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                    <h3><?php echo get_puntos_tp_total()." PTS"?></h3>
                  <H4><?php echo $lang['TAREAS_PROACTIVIDAD']?></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-nuclear"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            
          </div><!-- /.row -->
  <!-- Small boxes (Stat box) -->
         
             <div class="row">
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo '<font color="WHITE">'.get_puntos_libres_totales()." PTS".'</font>' ?></h3>
                  
                  <H4><?php echo $lang['FREE_POINTS']?></h4>
                </div>
                <div class="icon">
                 <i class="ion ion-ribbon-a"></i>
                </div>
                <a href="admin_free_points.php" class="small-box-footer">
                  <?php echo $lang['MORE_INFO']?> <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                   <h3><?php echo '<font color="WHITE">'.get_num_usuarios().'</font>' ?></h3>
                  <H4><?php echo $lang['USERS']?></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="admin_usuarios.php" class="small-box-footer">
                  <?php echo $lang['MORE_INFO']?> <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-maroon">
                <div class="inner">
                 <h3><?php echo get_puntos_epi_total()." PTS"?></h3>
                 <H4><?php echo $lang['EVALUACION_PROVEEDOR_INTERNO']?></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-happy-outline"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            
          </div><!-- /.row -->
  <!-- Small boxes (Stat box) -->
         
             <div class="row">
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo get_puntos_disponibles_totales()." PTS"?></h3>
                  
                  <H4><?php echo $lang['POINTS']?></h4>
                </div>
                <div class="icon">
                 <i class="ion ion-ribbon-a"></i>
                </div>
                <a href="#" class="small-box-footer">
                  <?php echo $lang['MORE_INFO']?> <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>0</h3>
                  <H4><?php echo $lang['OTHER_PROJECTS']?></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-filing"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>0</h3>
                 <H4><?php echo $lang['EXCHANGE_POINTS']?></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            
          </div><!-- /.row -->
          <!-- Small boxes (Stat box) -->
         
             <div class="row">
            <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-teal">
                <div class="inner">
                 <h3><?php echo get_messages_totales()?></h3>
                   
                  <H4><?php echo $lang['MESSAGES']?></h4>
                </div>
                <div class="icon">
                 <i class="ion ion-email"></i>
                </div>
                <a href="mensajes.php" class="small-box-footer">
                  <?php echo $lang['MORE_INFO']?> <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
          
           <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                   <h3><?php echo get_rci_created_total($_SESSION['userSession'])?></h3>
                  <H4><?php echo $lang['REQUERIMIENTOS_CLIENTE_INTERNO']?></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-happy-outline"></i>
                </div>
                <a href="admin_rci.php" class="small-box-footer">
                  <?php echo $lang['MORE_INFO']?><i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            
         
          <div class="col-lg-4 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                   <h3><?php echo get_historico()?></h3>
                  <H4><?php echo $lang['HISTORICO']?></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-recording"></i>
                </div>
                <a href="admin_historico.php" class="small-box-footer">
                  <?php echo $lang['MORE_INFO']?><i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            
          </div><!-- /.row -->

  </div>
</body>
</html>
<?php

?>
