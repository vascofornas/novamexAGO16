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


mysqli_select_db($conexion, $database_conexion);
$id = $_GET['id'];
$query_Recordset3 = "SELECT * FROM tb_proyectos LEFT JOIN tb_equipos ON tb_proyectos.equipo_proyecto = tb_equipos.id_equipo LEFT JOIN tbl_users ON tb_proyectos.evaluador_proyecto = tbl_users.userID WHERE id_proyecto = $id";
$Recordset3 = mysqli_query($conexion,$query_Recordset3) or die(mysql_error());

$row_Recordset3 = mysqli_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysqli_num_rows($Recordset3);
 
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
			url: 'editprojectdeliverable.php',
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
    <script> 

function subirimagen()

{

	self.name = 'opener';

	remote = open('subirentregable.php','remote','width=300,height=150,location=no,scrollbars=yes, menubar=no, toolbars=no,resizable=yes,fullscreen=yes, status=yes');

	remote.focus();
	}


</script>
</head> 
<body>

<?php include 'menu.php';?>
<div class = "container">
   <div class = "row" >
   
     
    <div class="row">
  <div class="col-sm-6 col-md-5 col-lg-6"><H3><?php echo $lang['PROJECT_INFO']?></H3>
  <hr>
  <h4>
  <p><strong><?php echo $lang['PROJECT_NAME']?>: </strong><?php echo $row_Recordset3['nombre_proyecto']?></p>
  <p><strong><?php echo $lang['PROJECT_DESCRIPTION']?>: </strong><?php echo $row_Recordset3['descripcion_proyecto']?></p>
  	<p><strong><?php echo $lang['START_DATE_PROJECT']?>: </strong><?php echo $row_Recordset3['fecha_inicio_proyecto']?></p>
  <p><strong><?php echo $lang['END_DATE_PROJECT']?>: </strong><?php echo $row_Recordset3['fecha_final_proyecto']?></p>
  <p><strong><?php echo $lang['PROJECT_TEAM']?>: </strong><?php echo $row_Recordset3['nombre_equipo']?></p>
  <p><strong><?php echo $lang['PROJECT_EVALUATOR']?>: </strong><?php echo $row_Recordset3['nombre_usuario']." ".$row_Recordset3['apellidos_usuario']?></p>
  		   <br>
 
   
    
  </div>
  <div class="col-sm-6 col-md-5 col-md-offset-2 col-lg-6 col-lg-offset-0"><H3><?php echo $lang['POINTS_DISTRIBUTION']?></H3>
  <HR>

 <?php 
$id = $_GET['id'];
//SELECCIONA LOS PUNTOS TEMPORALES DEL PROYECTO ID
$loop = mysqli_query($conexion, "SELECT * FROM tb_puntos_temporales WHERE proyecto_puntos_temporales = $id")
    or die (mysqli_error($dbh));



//display the results
$num_puntos = 0;
while ($row_proyectos = mysqli_fetch_array($loop))
{
	$num_puntos = $num_puntos+
	$sql = "UPDATE
    tb_puntos_temporales pd INNER JOIN tb_puntos_temporales pd2 ON
    (pd.id_puntos_temporales=pd2.id_puntos_temporales )
SET pd2.consolidados_puntos_temporales = pd.puntos_temporales";
	
	
	echo "<br>".get_nombre($row_proyectos['usuario_puntos_temporales']).$lang['HAS'].$row_proyectos['puntos_temporales'].$lang['HAS2']." <BR>";
	
	echo "<br>".$lang['HAS3'].get_nombre($row_proyectos['usuario_puntos_temporales'])."<BR>";
	
	
	
	if ($conexion->query($sql) === TRUE) {
		
		// SE PASAN LOS PUNTOS TEMPORALES A CONSOLIDADOS
		
		
		
	} else {
		//echo "Error updating record: " . $conexion->error;
	}

	
	
}
$loop = mysqli_query($conexion, "SELECT * FROM tb_puntos_temporales WHERE proyecto_puntos_temporales = $id")
or die (mysqli_error($dbh));



//display the results
$num = 0;
while ($row_proyectos = mysqli_fetch_array($loop))
{
	$existen = 0;

	
	$existen =comprobar_existe_puntos_disponibles($row_proyectos['usuario_puntos_temporales']);
	
	if ($existen == 0){
		//creamos registro en puntos disponibles
		
		//ponemos los puntos consolidados en puntos disponibles
		
		$sql1 = "INSERT INTO tb_puntos_disponibles (puntos_conseguidos,usuario_puntos_disponibles) VALUES
		('".$row_proyectos['consolidados_puntos_temporales']."','".$row_proyectos['usuario_puntos_temporales']."')";
		
		if ($conexion->query($sql1) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conexion->error;
		}
		
	}
	if ($existen == 1){
		//creamos registro en puntos disponibles
		
		$suma = get_puntos_disponibles($row_proyectos['usuario_puntos_temporales'])+ $row_proyectos['consolidados_puntos_temporales'];
		
		$sql1 = "UPDATE tb_puntos_disponibles SET puntos_conseguidos = '".$suma."' WHERE usuario_puntos_disponibles = '".$row_proyectos['usuario_puntos_temporales']."'";
		
		if ($conexion->query($sql1) === TRUE) {
			;
		} else {
			echo "Error updating record: " . $conexion->error;
		}
		
		
	}
	if ($existen > 1){
		//creamos registro en puntos disponibles
		echo " TIENE VARIOS REGISTROS EN PUNTOS DISPONIBLES";
	}
	$sql = "UPDATE
	tb_puntos_temporales
	SET puntos_temporales = 0 WHERE proyecto_puntos_temporales = $id";
	
	
;
	
	if ($conexion->query($sql) === TRUE) {
		
	} else {
		echo "Error updating record: " . $conexion->error;
	}
	$sql = "UPDATE
	tb_proyectos
	SET proyecto_cerrado = 1 WHERE id_proyecto = $id";
	
	
	;
	
	if ($conexion->query($sql) === TRUE) {
	
	} else {
		echo "Error updating record: " . $conexion->error;
	}
}
?>
  
</h4>
  
  </div>
</div>
      

</div>
</body>
</html>

