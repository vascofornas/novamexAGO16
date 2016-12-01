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
mysqli_select_db($conexion, $database_conexion);
$id = $_GET['id'];
$query_Recordset3 = "SELECT * FROM tb_tareas_proactividad  WHERE id_tareas_proactividad = $id";
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
  <div class="col-sm-6 col-md-5 col-lg-6"><H3><?php echo $lang['PT_INFO']?></H3>
  <hr>
  <h4>
   <p><strong><?php echo $lang['TITLE_PT']?>: </strong><?php echo $row_Recordset3['titulo_tareas_proactividad']?></p>
  <p><strong><?php echo $lang['DESC_PT']?>: </strong><?php echo $row_Recordset3['descripcion_tareas_proactividad']?></p>
  	<p><strong><?php echo $lang['START_DATE_REQ']?>: </strong><?php echo $row_Recordset3['fecha_inicio_tareas_proactividad']?></p>
  	
  	<?php 
  	
  //get periodicidad
  
$periodo = $row_Recordset3['periodicidad'];
	if ($periodo == 1){
		$result = $lang['ONLY_ONCE'];
	}
	if ($periodo == 2){
		$result = $lang['EVERYDAY'];
	}
	if ($periodo == 3){
		$result = $lang['EVERY_WEEK'];
	}
	if ($periodo == 4){
		$result = $lang['EVERY_TWO_WEEKS'];
	}
	if ($periodo == 5){
		$result = $lang['EVERY_MONTH'];
	}
	if ($periodo == 6){
		$result = $lang['EVERY_TWO_MONTHS'];
	}
	if ($periodo == 7){
		$result = $lang['EVERY_THREE_MONTHS'];
	}
	if ($periodo == 8){
		$result = $lang['EVERY_FOUR_MONTHS'];
	}
	if ($periodo == 9){
		$result = $lang['EVERY_SIX_MONTHS'];
	}
	if ($periodo == 10){
		$result = $lang['EVERY_TWELVE_MONTHS'];
	}
  	?>
  	
  	<p><strong><?php echo $lang['PERIODICITY']?>: </strong><?php echo $result?></p>
  	<p><strong><?php echo $lang['REPEATS']?>: </strong><?php echo $row_Recordset3['repeticiones']?></p>
  <p><strong><?php echo $lang['EVALUATOR']?>: </strong><?php echo get_nombre($row_Recordset3['cliente_tareas_proactividad'])?></p>
	<p><strong><?php echo $lang['EVALUATED']?>: </strong><?php echo get_nombre($row_Recordset3['proveedor_tareas_proactividad'])?></p>
  			   <br>
    
    </h4>
  </div>
  <div class="col-sm-6 col-md-5 col-md-offset-2 col-lg-6 col-lg-offset-0"><H3><?php echo $lang['PT_REVISIONS']?></H3>
  <HR>
 

  
 

  
 
  

  

  
  
    <HR>
  
  
<?php
$id = $_GET['id'];
//run the query
$loop = mysqli_query($conexion, "SELECT * FROM tb_tareas_proactividad WHERE id_tareas_proactividad = $id")
    or die (mysqli_error($dbh));



//display the results

while ($row_proyectos = mysqli_fetch_array($loop))
{//while
	

//periodicidad 1 UNA SOLA VEZ
$periodicidad = $row_proyectos['periodicidad'];
$repeticiones = $row_proyectos['repeticiones'];
$cliente_tareas_proactividad = $row_proyectos['cliente_tareas_proactividad'];
$proveedor_tareas_proactividad = $row_proyectos['proveedor_tareas_proactividad'];
$titulo_tareas_proactividad = $row_proyectos['titulo_tareas_proactividad'];
$fecha_inicio = $row_proyectos['fecha_inicio_tareas_proactividad'];




if ($periodicidad == 2){//if periodicidad EVERY DAY
	
	$num = 0;
	$codigo1 = generateRandomString();
	$newdate = $fecha_inicio;
	$num_revision = 1;
	for ($x = 0; $x < $repeticiones; $x++) {//for
		
		if ($num == 0){
			$newdate = $fecha_inicio;
		}
		else {
		$newdate = strtotime ( '1 day' , strtotime ( $newdate ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );
		}
		$num = $x+1;
		
		$sql = "INSERT INTO tb_revisiones_tareas_proactividad (tareas_proactividad_revisado,nombre_revision,titulo_tareas_proactividad,cliente_tareas_proactividad,proveedor_tareas_proactividad,fecha_inicio_tareas_proactividad)
		VALUES ('$id','Revision # .$num','$titulo_tareas_proactividad','$cliente_tareas_proactividad','$proveedor_tareas_proactividad','$newdate')";
	
		if ($conexion->query($sql) === TRUE) {
			echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
		$last_id = mysqli_insert_id($conexion);
		}//if 
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);
		
		
		}//for

}//FIN PERIODICIDAD EVERY DAY
if ($periodicidad == 3){//if periodicidad EVERY WEEK

	$num = 0;
	$codigo1 = generateRandomString();
	$newdate = $fecha_inicio;
	$num_revision = 1;
	for ($x = 0; $x < $repeticiones; $x++) {//for

		
			$newdate = strtotime ( '+7 days' , strtotime ( $newdate ) ) ;
			$newdate = date ( 'Y-m-j' , $newdate );
		
		$num = $x+1;

		$sql = "INSERT INTO tb_revisiones_rci (rci_revisado,nombre_revision,titulo_rci,cliente_rci,proveedor_rci,fecha_inicio_rci)
		VALUES ('$id','Revision # .$num','$titulo_rci','$cliente_rci','$proveedor_rci','$newdate')";

		if ($conexion->query($sql) === TRUE) {
			echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);


	}//for

}//FIN PERIODICIDAD EVERY WEEK
if ($periodicidad == 4){//if periodicidad EVERY TWO WEEKS

	$num = 0;
	$codigo1 = generateRandomString();
	$newdate = $fecha_inicio;
	$num_revision = 1;
	for ($x = 0; $x < $repeticiones; $x++) {//for


		$newdate = strtotime ( '+14 days' , strtotime ( $newdate ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );

		$num = $x+1;

		$sql = "INSERT INTO tb_revisiones_rci (rci_revisado,nombre_revision,titulo_rci,cliente_rci,proveedor_rci,fecha_inicio_rci)
		VALUES ('$id','Revision # .$num','$titulo_rci','$cliente_rci','$proveedor_rci','$newdate')";

		if ($conexion->query($sql) === TRUE) {
			echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);


	}//for

}//FIN PERIODICIDAD EVERY TWO WEEKS

if ($periodicidad == 5){//if periodicidad EVERY MONTH

	$num = 0;
	$codigo1 = generateRandomString();
	$newdate = $fecha_inicio;
	$num_revision = 1;
	for ($x = 0; $x < $repeticiones; $x++) {//for


		$newdate = strtotime ( '+1 month' , strtotime ( $newdate ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );

		$num = $x+1;

		$sql = "INSERT INTO tb_revisiones_rci (rci_revisado,nombre_revision,titulo_rci,cliente_rci,proveedor_rci,fecha_inicio_rci)
		VALUES ('$id','Revision # .$num','$titulo_rci','$cliente_rci','$proveedor_rci','$newdate')";

		if ($conexion->query($sql) === TRUE) {
			echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);


	}//for

}//FIN PERIODICIDAD EVERY MONTH

if ($periodicidad == 6){//if periodicidad two MONTHs

	$num = 0;
	$codigo1 = generateRandomString();
	$newdate = $fecha_inicio;
	$num_revision = 1;
	for ($x = 0; $x < $repeticiones; $x++) {//for


		$newdate = strtotime ( '+2 months' , strtotime ( $newdate ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );

		$num = $x+1;

		$sql = "INSERT INTO tb_revisiones_rci (rci_revisado,nombre_revision,titulo_rci,cliente_rci,proveedor_rci,fecha_inicio_rci)
		VALUES ('$id','Revision # .$num','$titulo_rci','$cliente_rci','$proveedor_rci','$newdate')";

		if ($conexion->query($sql) === TRUE) {
			echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);


	}//for

}//FIN PERIODICIDAD two MONTHs


if ($periodicidad == 7){//if periodicidad three MONTHs

	$num = 0;
	$codigo1 = generateRandomString();
	$newdate = $fecha_inicio;
	$num_revision = 1;
	for ($x = 0; $x < $repeticiones; $x++) {//for


		$newdate = strtotime ( '+3 months' , strtotime ( $newdate ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );

		$num = $x+1;

		$sql = "INSERT INTO tb_revisiones_rci (rci_revisado,nombre_revision,titulo_rci,cliente_rci,proveedor_rci,fecha_inicio_rci)
		VALUES ('$id','Revision # .$num','$titulo_rci','$cliente_rci','$proveedor_rci','$newdate')";

		if ($conexion->query($sql) === TRUE) {
			echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);


	}//for

}//FIN PERIODICIDAD three MONTHs


if ($periodicidad == 8){//if periodicidad four MONTHs

	$num = 0;
	$codigo1 = generateRandomString();
	$newdate = $fecha_inicio;
	$num_revision = 1;
	for ($x = 0; $x < $repeticiones; $x++) {//for


		$newdate = strtotime ( '+4 months' , strtotime ( $newdate ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );

		$num = $x+1;

		$sql = "INSERT INTO tb_revisiones_rci (rci_revisado,nombre_revision,titulo_rci,cliente_rci,proveedor_rci,fecha_inicio_rci)
		VALUES ('$id','Revision # .$num','$titulo_rci','$cliente_rci','$proveedor_rci','$newdate')";

		if ($conexion->query($sql) === TRUE) {
			echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);


	}//for

}//FIN PERIODICIDAD  six MONTHs
if ($periodicidad == 9){//if periodicidad four MONTHs

	$num = 0;
	$codigo1 = generateRandomString();
	$newdate = $fecha_inicio;
	$num_revision = 1;
	for ($x = 0; $x < $repeticiones; $x++) {//for


		$newdate = strtotime ( '+6 months' , strtotime ( $newdate ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );

		$num = $x+1;

		$sql = "INSERT INTO tb_revisiones_rci (rci_revisado,nombre_revision,titulo_rci,cliente_rci,proveedor_rci,fecha_inicio_rci)
		VALUES ('$id','Revision # .$num','$titulo_rci','$cliente_rci','$proveedor_rci','$newdate')";

		if ($conexion->query($sql) === TRUE) {
			echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);


	}//for

}//FIN PERIODICIDAD  one year
if ($periodicidad == 10){//if periodicidad four MONTHs

	$num = 0;
	$codigo1 = generateRandomString();
	$newdate = $fecha_inicio;
	$num_revision = 1;
	for ($x = 0; $x < $repeticiones; $x++) {//for


		$newdate = strtotime ( '+12 months' , strtotime ( $newdate ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );

		$num = $x+1;

		$sql = "INSERT INTO tb_revisiones_rci (rci_revisado,nombre_revision,titulo_rci,cliente_rci,proveedor_rci,fecha_inicio_rci)
		VALUES ('$id','Revision # .$num','$titulo_rci','$cliente_rci','$proveedor_rci','$newdate')";

		if ($conexion->query($sql) === TRUE) {
			echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
			$last_id = mysqli_insert_id($conexion);
		}//if
		else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}//else
		$last_id = mysqli_insert_id($conexion);


	}//for

}//FIN PERIODICIDAD one year






}//while
	


	

	
	
	
	

if ($num >0){
echo '<br><a href="evaluaciones_rci.php?id='.$_GET['id'].'" class="btn btn-primary btn-lg active" role="button">'.$lang['CONFIGURAR_REVISIONES'].'</a>';
}
	
?>
  

  
  </div>
</div>
      

</div>
</body>
</html>