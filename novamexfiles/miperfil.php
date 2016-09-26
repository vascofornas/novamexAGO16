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
  <div class="fixed">
<a href="miperfil.php?lang=en"><img src="usa.png" width="45" height="45" /></a>
<a href="miperfil.php?lang=es"><img src="mexico.png" width="45" height="45" /></a>

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
            <a href="#" class="navbar-brand"><?php echo $lang['MEMBER_HOME']?></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li ><a href="home.php"><?php echo $lang['HOME']?></a></li>
                <li class="active"><a href="miperfil.php"><?php echo $lang['PROFILE']?></a></li>
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
                       <img src="usuarios/<?php echo $row['imagen_usuario']?>" alt="<?php echo $row['userName']?>" height="70" width="70">
    
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
   
     
    <div class="row">
  <div class="col-sm-6 col-md-5 col-lg-6"><H3><?php echo $lang['PERSONAL_INFO']?></H3>
  <hr>
  <h4><?php echo $lang['NOT_EDITABLE_DATA']?></h4>
  <p><strong><?php echo $lang['USERNAME']?>: </strong><?php echo $row['userName']?></p>
  <p><strong>Email: </strong><?php echo $row['userEmail']?></p>
  <p><strong><?php echo $lang['USER_LEVEL']?>: </strong><?php echo $row['userLevel']?></p>
   <p><strong><?php echo $lang['BUSINESS_UNIT']?>: </strong><?php echo $row['uni']?></p>
   		   <p><strong>Supervisor: </strong><?php echo $row['super']?></p>
   		   <br>
  <h4><?php echo $lang['EDITABLE_DATA']?></h4>
  
    <div id="form-content">
     <form method="post" id="reg-form" name="form1" autocomplete="off">
			
	<div class="form-group">
	<label><?php echo $lang['FIRST_NAME']?></label>
	<input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" placeholder="<?php echo $lang['FIRST_NAME']?>" value ="<?php echo $row['nombre_usuario']?>"required />
	</div>
				
	<div class="form-group">
	<label><?php echo $lang['LAST_NAME']?></label>
	<input type="text" class="form-control" name="apellidos_usuario" id="apellidos_usuario" placeholder="<?php echo $lang['LAST_NAME']?>" value ="<?php echo $row['apellidos_usuario']?>"required />
	<input type="hidden" class="form-control" name="userID" id="userID" placeholder="<?php echo $lang['LAST_NAME']?>" value ="<?php echo $row['userID']?>"required />
	
	</div>
	
	<div class="form-group">
	<label><?php echo $lang['LANGUAGE']?></label>
    <select class="form-control" name="idioma_usuario" id="idioma_usuario">
    <option value="en">English</option>
    <option value="es">Spanish</option>
    
  	</select>
  </div>		
   <div class="form-group" id="imagenTicket">
        <label><?php echo $lang['IMAGE']?></label>
        <img src="usuarios/<?php echo $row['imagen_usuario']?>" alt="<?php echo $row['userName']?>" height="100" width="100">
      <input name="imagen_usuario" type="text" id="imagen_usuario" class="form-control"  placeholder="<?php echo $row['imagen_usuario']?>" value="<?php echo $row['imagen_usuario']?>" readonly>
             
              <input type="button" name="button" id="button" value="<?php echo $lang['SELECT_FILE']?>" onclick="javascript:subirimagen();" />
      
      
    </div>
				

				
		
	<hr />
				
	<div class="form-group">
	<button class="btn btn-primary"><?php echo $lang['UPDATE_DATA']?></button>
	</div>
				
    </form>     
</div>
    
    
  </div>
  <div class="col-sm-6 col-md-5 col-md-offset-2 col-lg-6 col-lg-offset-0"><H3><?php echo $lang['MY_PROJECTS']?></H3>
  <HR>
  <h4><?php echo $lang['AS_TEAM_MEMBER']?></h4>
  
<?php

//run the query
$loop = mysqli_query($conexion, "SELECT * FROM tb_proyectos")
    or die (mysqli_error($dbh));



//display the results
while ($row_proyectos = mysqli_fetch_array($loop))
{
	//run the query
	$loop_miembros = mysqli_query($conexion, "SELECT * FROM tb_miembros_equipos")
	or die (mysqli_error($dbh));
	while ($row_miembros = mysqli_fetch_array($loop_miembros))
	{
	
	if ($row_miembros['usuario'] == $row['userID'] && $row_miembros['equipo'] == $row_proyectos['equipo_proyecto'])
	{
echo "<strong><a href='proyecto_evaluado.php?id=".$row_proyectos['id_proyecto']."'>".$row_proyectos['nombre_proyecto'] ." (".$lang['POINTS'].": ".$row_proyectos['puntos_proyecto'].")"."</strong></a><br> " . $row_proyectos['descripcion_proyecto']."<hr>";
	}
	else{}
	}
	}
?>
  
   <HR>
  <h4><?php echo $lang['AS_EVALUATOR']?></h4>
  
<?php

//run the query
$loop = mysqli_query($conexion, "SELECT * FROM tb_proyectos")
    or die (mysqli_error($dbh));



//display the results
while ($row_proyectos = mysqli_fetch_array($loop))
{
	//run the query
	if ($row_proyectos['evaluador_proyecto'] == $row['userID']){
echo "<strong><a href='proyecto_evaluado.php'>".$row_proyectos['nombre_proyecto'] ." (".$lang['POINTS'].": ".$row_proyectos['puntos_proyecto'].")"."</strong></a><br> " . $row_proyectos['descripcion_proyecto']."<hr>";
	}
}
	
?>
  
  </div>
</div>
      
     <div class="row">
  <div class="col-sm-6 col-md-5 col-lg-6">EVALUACION A PROVEEDOR INTERNO
  </div>
  <div class="col-sm-6 col-md-5 col-md-offset-2 col-lg-6 col-lg-offset-0">REQUERIMIENTOS DE CLIENTES INTERNOS</div>
</div>
  <div class="row">
  <div class="col-sm-6 col-md-5 col-lg-6">MIS RECONOCIMIENTOS</div>
  <div class="col-sm-6 col-md-5 col-md-offset-2 col-lg-6 col-lg-offset-0">TAREAS DE PROACTIVIDAD</div>
</div> 
      
   </div>
</div>
</body>
</html>

