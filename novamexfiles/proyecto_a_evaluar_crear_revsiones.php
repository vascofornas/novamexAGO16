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
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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

<?php include 'menu.php'?>
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
 
    
    </h4>
  </div>
  <div class="col-sm-6 col-md-6 col-lg-6 col-lg-offset-0"><H3><?php echo $lang['PROJECT_REVISIONS_CREATING']?></H3>
  <HR>
 
  
 

  
 
  

  

  
  
    <HR>
  
  
<?php
$id = $_GET['id'];


//run the query
$loop = mysqli_query($conexion, "SELECT * FROM tb_proyectos LEFT JOIN tb_tipos_proyectos ON 
		tb_proyectos.tipo_proyecto = tb_tipos_proyectos.id_tipo_proyecto WHERE id_proyecto = $id")
    or die (mysqli_error($dbh));



//display the results

while ($row_proyectos = mysqli_fetch_array($loop))
{//while
	



if ($row_proyectos['porcentaje1'] >0){//if porcentaje1
	$porcentaje1 = 1;
	$puntostotales1 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo1 = $row_proyectos['porcentaje1'];
	$opcion1 = $row_proyectos['opcion1'];
	$num_revisiones1 = $row_proyectos['num_revisiones1'];
	
	$codigo1 = generateRandomString();
	
	$num_revision = 1;
	for ($x = 0; $x < $num_revisiones1; $x++) {//for
		$num = $x+1;
		$nom = $opcion1." - Revision # ".$num;
		$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision,opcion_revision,codigo_opcion)
		VALUES ('$id', '$nom','$opcion1','$codigo1')";
		
		if ($conexion->query($sql) === TRUE) {
			echo $row_proyectos['opcion1']." - Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
		$last_id = mysqli_insert_id($conexion);
		}//if 
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);
		
		$sql1 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados,estado_evaluacion,num_revisiones_item,codigo_opcion_evaluacion)
		VALUES ('$last_id','$porcentajetipo1','$opcion1','$id','$puntostotales1',0,'$num_revisiones1','$codigo1')";
		
		if ($conexion->query($sql1) === TRUE) {
			
			
			
			$texto = "USUARIO CREA REVISIONES DE  PROYECTO";
			$codigo = "031";
			$miemail = get_email($_SESSION['userSession']);
			add_log($texto,$miemail,$codigo);
			send_mail_miembros_equipos_proyecto_revisiones($row_Recordset3['equipo_proyecto'],$row_Recordset3['nombre_proyecto']);
			//email a superadmin
			$super = get_email_superadmin();
			$pro = $row_Recordset3['nombre_proyecto'];
			$men = "El proyecto ".$pro." tiene nuevas revisiones";
			send_mail($super,$men,$pro);
		}//if 
		else {
			echo "Error: " . $sql1 . "<br>" . $conexion->error;
		}//else
	
}//for

}//if opcion1
if ($row_proyectos['porcentaje2'] >0){//if porcentaje2
	$porcentaje2 = 1;
	$puntostotales2 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo2 = $row_proyectos['porcentaje2'];
	$opcion2 = $row_proyectos['opcion2'];
	$num_revisiones2 = $row_proyectos['num_revisiones2'];

	$codigo2 = generateRandomString();

	$num_revision = 1;
	for ($x = 0; $x < $num_revisiones2; $x++) {//for
		$num = $x+1;
		$nom = $opcion2." - Revision # ".$num;
		$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision,opcion_revision,codigo_opcion)
		VALUES ('$id','$nom','$opcion2','$codigo2')";

		if ($conexion->query($sql) === TRUE) {
			echo $row_proyectos['opcion2']." - Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);

		$sql2 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados,estado_evaluacion,num_revisiones_item,codigo_opcion_evaluacion)
		VALUES ('$last_id','$porcentajetipo2','$opcion2','$id','$puntostotales2',0,'$num_revisiones2','$codigo2')";

		if ($conexion->query($sql2) === TRUE) {
			$texto = "USUARIO CREA REVISIONES DE  PROYECTO";
			$codigo = "031";
			$miemail = get_email($_SESSION['userSession']);
			add_log($texto,$miemail,$codigo);
			send_mail_miembros_equipos_proyecto_revisiones($row_Recordset3['equipo_proyecto'],$row_Recordset3['nombre_proyecto']);
			//email a superadmin
			$super = get_email_superadmin();
			$pro = $row_Recordset3['nombre_proyecto'];
			$men = "El proyecto ".$pro." tiene nuevas revisiones";
			send_mail($super,$men,$pro);

		}//if
		else {
			echo "Error: " . $sql2 . "<br>" . $conexion->error;
		}//else

	}//for

}//if opcion2


if ($row_proyectos['porcentaje3'] >0){//if porcentaje3
	$porcentaje3 = 1;
	$puntostotales3 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo3 = $row_proyectos['porcentaje3'];
	$opcion3 = $row_proyectos['opcion3'];
	$num_revisiones3 = $row_proyectos['num_revisiones3'];
	$codigo3 = generateRandomString();
	$num_revision = 1;
	for ($x = 0; $x < $num_revisiones3; $x++) {//for
		$num = $x+1;
		$nom = $opcion3." - Revision # ".$num;
		$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision,opcion_revision,codigo_opcion)
		VALUES ('$id','$nom','$opcion3','$codigo3')";

		if ($conexion->query($sql) === TRUE) {
			echo $row_proyectos['opcion3']." - Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);

		$sql3 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados,estado_evaluacion,num_revisiones_item,codigo_opcion_evaluacion)
		VALUES ('$last_id','$porcentajetipo3','$opcion3','$id','$puntostotales3',0,'$num_revisiones3','$codigo3')";

		if ($conexion->query($sql3) === TRUE) {
			$texto = "USUARIO CREA REVISIONES DE  PROYECTO";
			$codigo = "031";
			$miemail = get_email($_SESSION['userSession']);
			add_log($texto,$miemail,$codigo);
			send_mail_miembros_equipos_proyecto_revisiones($row_Recordset3['equipo_proyecto'],$row_Recordset3['nombre_proyecto']);
			//email a superadmin
			$super = get_email_superadmin();
			$pro = $row_Recordset3['nombre_proyecto'];
			$men = "El proyecto ".$pro." tiene nuevas revisiones";
			send_mail($super,$men,$pro);

		}//if
		else {
			echo "Error: " . $sql3 . "<br>" . $conexion->error;
		}//else

	}//for

}//if opcion3

if ($row_proyectos['porcentaje4'] >0){//if porcentaje4
	$porcentaje4 = 4;
	$puntostotales4 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo4 = $row_proyectos['porcentaje4'];
	$opcion4 = $row_proyectos['opcion4'];
	$num_revisiones4 = $row_proyectos['num_revisiones4'];
	$codigo4 = generateRandomString();
	$num_revision = 1;
	for ($x = 0; $x < $num_revisiones4; $x++) {//for
		$num = $x+1;
		$nom = $opcion4." - Revision # ".$num;
		$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision,opcion_revision,codigo_opcion)
		VALUES ('$id','$nom','$opcion4','$codigo4')";

		if ($conexion->query($sql) === TRUE) {
			echo $row_proyectos['opcion4']." - Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);

		$sql4 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados,estado_evaluacion,num_revisiones_item,codigo_opcion_evaluacion)
		VALUES ('$last_id','$porcentajetipo4','$opcion4','$id','$puntostotales4',0,'$num_revisiones4','$codigo4')";

		if ($conexion->query($sql4) === TRUE) {
			$texto = "USUARIO CREA REVISIONES DE  PROYECTO";
			$codigo = "031";
			$miemail = get_email($_SESSION['userSession']);
			add_log($texto,$miemail,$codigo);
			send_mail_miembros_equipos_proyecto_revisiones($row_Recordset3['equipo_proyecto'],$row_Recordset3['nombre_proyecto']);
			//email a superadmin
			$super = get_email_superadmin();
			$pro = $row_Recordset3['nombre_proyecto'];
			$men = "El proyecto ".$pro." tiene nuevas revisiones";
			send_mail($super,$men,$pro);
		}//if
		else {
			echo "Error: " . $sql4 . "<br>" . $conexion->error;
		}//else

	}//for

}//if opcion4

if ($row_proyectos['porcentaje5'] >0){//if porcentaje5
	$porcentaje5 = 5;
	$puntostotales5 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo5 = $row_proyectos['porcentaje5'];
	$opcion5 = $row_proyectos['opcion5'];
	$num_revisiones5 = $row_proyectos['num_revisiones5'];
	$codigo5 = generateRandomString();
	$num_revision = 1;
	for ($x = 0; $x < $num_revisiones5; $x++) {//for
		$num = $x+1;
		$nom = $opcion5." - Revision # ".$num;
		$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision,opcion_revision,codigo_opcion)
		VALUES ('$id','$nom','$opcion5','$codigo5')";

		if ($conexion->query($sql) === TRUE) {
			echo $row_proyectos['opcion5']." - Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);

		$sql5 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados,estado_evaluacion,num_revisiones_item,codigo_opcion_evaluacion)
		VALUES ('$last_id','$porcentajetipo5','$opcion5','$id','$puntostotales5',0,'$num_revisiones5','$codigo5')";

		if ($conexion->query($sql5) === TRUE) {
			$texto = "USUARIO CREA REVISIONES DE  PROYECTO";
			$codigo = "031";
			$miemail = get_email($_SESSION['userSession']);
			add_log($texto,$miemail,$codigo);
			send_mail_miembros_equipos_proyecto_revisiones($row_Recordset3['equipo_proyecto'],$row_Recordset3['nombre_proyecto']);
			//email a superadmin
			$super = get_email_superadmin();
			$pro = $row_Recordset3['nombre_proyecto'];
			$men = "El proyecto ".$pro." tiene nuevas revisiones";
			send_mail($super,$men,$pro);
		}//if
		else {
			echo "Error: " . $sql5 . "<br>" . $conexion->error;
		}//else

	}//for

}//if opcion5


if ($row_proyectos['porcentaje6'] >0){//if porcentaje6
	$porcentaje6 = 6;
	$puntostotales6 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo6 = $row_proyectos['porcentaje6'];
	$opcion6 = $row_proyectos['opcion6'];
	$num_revisiones6 = $row_proyectos['num_revisiones6'];
	$codigo6 = generateRandomString();
	$num_revision = 1;
	for ($x = 0; $x < $num_revisiones6; $x++) {//for
		$num = $x+1;
		$nom = $opcion6." - Revision # ".$num;
		$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision,opcion_revision,codigo_opcion)
		VALUES ('$id','$nom','$opcion6','$codigo6')";

		if ($conexion->query($sql) === TRUE) {
			echo $row_proyectos['opcion6']." - Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);

		$sql6 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados,estado_evaluacion,num_revisiones_item,codigo_opcion_evaluacion)
		VALUES ('$last_id','$porcentajetipo6','$opcion6','$id','$puntostotales6',0,'$num_revisiones6','$codigo6')";

		if ($conexion->query($sql6) === TRUE) {
			$texto = "USUARIO CREA REVISIONES DE  PROYECTO";
			$codigo = "031";
			$miemail = get_email($_SESSION['userSession']);
			add_log($texto,$miemail,$codigo);
			send_mail_miembros_equipos_proyecto_revisiones($row_Recordset3['equipo_proyecto'],$row_Recordset3['nombre_proyecto']);
			//email a superadmin
			$super = get_email_superadmin();
			$pro = $row_Recordset3['nombre_proyecto'];
			$men = "El proyecto ".$pro." tiene nuevas revisiones";
			send_mail($super,$men,$pro);
		}//if
		else {
			echo "Error: " . $sql6 . "<br>" . $conexion->error;
		}//else

	}//for

}//if opcion6

if ($row_proyectos['porcentaje7'] >0){//if porcentaje7
	$porcentaje7 = 7;
	$puntostotales7 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo7 = $row_proyectos['porcentaje7'];
	$opcion7 = $row_proyectos['opcion7'];
	$num_revisiones7 = $row_proyectos['num_revisiones7'];
	$codigo7 = generateRandomString();
	$num_revision = 1;
	for ($x = 0; $x < $num_revisiones7; $x++) {//for
		$num = $x+1;
		$nom = $opcion7." - Revision # ".$num;
		$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision,opcion_revision,codigo_opcion)
		VALUES ('$id','$nom','$opcion7','$codigo7')";

		if ($conexion->query($sql) === TRUE) {
			echo $row_proyectos['opcion7']." - Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);

		$sql7 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados,estado_evaluacion,num_revisiones_item,codigo_opcion_evaluacion)
		VALUES ('$last_id','$porcentajetipo7','$opcion7','$id','$puntostotales7',0,'$num_revisiones7','$codigo7')";

		if ($conexion->query($sql7) === TRUE) {
			$texto = "USUARIO CREA REVISIONES DE  PROYECTO";
			$codigo = "031";
			$miemail = get_email($_SESSION['userSession']);
			add_log($texto,$miemail,$codigo);
			send_mail_miembros_equipos_proyecto_revisiones($row_Recordset3['equipo_proyecto'],$row_Recordset3['nombre_proyecto']);
			//email a superadmin
			$super = get_email_superadmin();
			$pro = $row_Recordset3['nombre_proyecto'];
			$men = "El proyecto ".$pro." tiene nuevas revisiones";
			send_mail($super,$men,$pro);
		}//if
		else {
			echo "Error: " . $sql7 . "<br>" . $conexion->error;
		}//else

	}//for

}//if opcion7

if ($row_proyectos['porcentaje8'] >0){//if porcentaje8
	$porcentaje8 = 8;
	$puntostotales8 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo8 = $row_proyectos['porcentaje8'];
	$opcion8 = $row_proyectos['opcion8'];
	$num_revisiones8 = $row_proyectos['num_revisiones8'];
	$codigo8 = generateRandomString();
	$num_revision = 1;
	for ($x = 0; $x < $num_revisiones8; $x++) {//for
		$num = $x+1;
		$nom = $opcion8." - Revision # ".$num;
		$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision,opcion_revision,codigo_opcion)
		VALUES ('$id','$nom','$opcion8','$codigo8')";

		if ($conexion->query($sql) === TRUE) {
			echo $row_proyectos['opcion8']." - Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);

		$sql8 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados,estado_evaluacion,num_revisiones_item,codigo_opcion_evaluacion)
		VALUES ('$last_id','$porcentajetipo8','$opcion8','$id','$puntostotales8',0,'$num_revisiones8','$codigo8')";

		if ($conexion->query($sql8) === TRUE) {
			$texto = "USUARIO CREA REVISIONES DE  PROYECTO";
			$codigo = "031";
			$miemail = get_email($_SESSION['userSession']);
			add_log($texto,$miemail,$codigo);
			send_mail_miembros_equipos_proyecto_revisiones($row_Recordset3['equipo_proyecto'],$row_Recordset3['nombre_proyecto']);
			//email a superadmin
			$super = get_email_superadmin();
			$pro = $row_Recordset3['nombre_proyecto'];
			$men = "El proyecto ".$pro." tiene nuevas revisiones";
			send_mail($super,$men,$pro);
		}//if
		else {
			echo "Error: " . $sql8 . "<br>" . $conexion->error;
		}//else

	}//for

}//if opcion8

if ($row_proyectos['porcentaje9'] >0){//if porcentaje9
	$porcentaje9 = 9;
	$puntostotales9 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo9 = $row_proyectos['porcentaje9'];
	$opcion9 = $row_proyectos['opcion9'];
	$num_revisiones9 = $row_proyectos['num_revisiones9'];
	$codigo9 = generateRandomString();
	$num_revision = 1;
	for ($x = 0; $x < $num_revisiones9; $x++) {//for
		$num = $x+1;
		$nom = $opcion9." - Revision # ".$num;
		$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision,opcion_revision,codigo_opcion)
		VALUES ('$id','$nom','$opcion9','$codigo9')";

		if ($conexion->query($sql) === TRUE) {
			echo $row_proyectos['opcion9']." - Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);

		$sql9 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados,estado_evaluacion,num_revisiones_item,codigo_opcion_evaluacion)
		VALUES ('$last_id','$porcentajetipo9','$opcion9','$id','$puntostotales9',0,'$num_revisiones9','$codigo9')";

		if ($conexion->query($sql9) === TRUE) {
			$texto = "USUARIO CREA REVISIONES DE  PROYECTO";
			$codigo = "031";
			$miemail = get_email($_SESSION['userSession']);
			add_log($texto,$miemail,$codigo);
			send_mail_miembros_equipos_proyecto_revisiones($row_Recordset3['equipo_proyecto'],$row_Recordset3['nombre_proyecto']);
			//email a superadmin
			$super = get_email_superadmin();
			$pro = $row_Recordset3['nombre_proyecto'];
			$men = "El proyecto ".$pro." tiene nuevas revisiones";
			send_mail($super,$men,$pro);
		}//if
		else {
			echo "Error: " . $sql9 . "<br>" . $conexion->error;
		}//else

	}//for

}//if opcion9

if ($row_proyectos['porcentaje10'] >0){//if porcentaje10
	$porcentaje10 = 10;
	$puntostotales10 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo10 = $row_proyectos['porcentaje10'];
	$opcion10 = $row_proyectos['opcion10'];
	$num_revisiones10 = $row_proyectos['num_revisiones10'];
	$codigo10 = generateRandomString();
	$num_revision = 1;
	for ($x = 0; $x < $num_revisiones10; $x++) {//for
		$num = $x+1;
		$nom = $opcion10." - Revision # ".$num;
		
		$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision,opcion_revision,codigo_opcion)
		VALUES ('$id','$nom','$opcion10','$codigo10')";

		if ($conexion->query($sql) === TRUE) {
			echo $row_proyectos['opcion10']." - Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);

		$sql10 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados,estado_evaluacion,num_revisiones_item,codigo_opcion_evaluacion)
		VALUES ('$last_id','$porcentajetipo10','$opcion10','$id','$puntostotales10',0,'$num_revisiones10','$codigo10')";

		if ($conexion->query($sql10) === TRUE) {
			$texto = "USUARIO CREA REVISIONES DE  PROYECTO";
			$codigo = "031";
			$miemail = get_email($_SESSION['userSession']);
			add_log($texto,$miemail,$codigo);
			send_mail_miembros_equipos_proyecto_revisiones($row_Recordset3['equipo_proyecto'],$row_Recordset3['nombre_proyecto']);
			//email a superadmin
			$super = get_email_superadmin();
			$pro = $row_Recordset3['nombre_proyecto'];
			$men = "El proyecto ".$pro." tiene nuevas revisiones";
			send_mail($super,$men,$pro);
		}//if
		else {
			echo "Error: " . $sql10 . "<br>" . $conexion->error;
		}//else

	}//for

}//if opcion10








}//while
	


	

	
	
	
	

if ($num >0){
echo '<br><a href="proyecto_a_evaluar_editar_revsiones.php?id='.$_GET['id'].'" class="btn btn-primary btn-lg active" role="button">'.$lang['CONFIGURAR_REVISIONES'].'</a>';
}
	
?>
  

  
  </div>
</div>
      

</div>
</body>
</html>