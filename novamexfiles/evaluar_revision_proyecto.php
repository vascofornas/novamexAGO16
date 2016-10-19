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
$query_Recordset3 = "SELECT * FROM tb_proyectos LEFT JOIN tb_tipos_proyectos ON tb_proyectos.tipo_proyecto = tb_tipos_proyectos.id_tipo_proyecto LEFT JOIN tb_equipos ON tb_proyectos.equipo_proyecto = tb_equipos.id_equipo LEFT JOIN tbl_users ON tb_proyectos.evaluador_proyecto = tbl_users.userID WHERE id_proyecto = $id";
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
	
	
	$('#reg-form1').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'editevaluacionproyecto.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			$('#form-content1').fadeOut('slow', function(){
				$('#form-content1').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	});
$('#reg-form2').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'editevaluacionproyecto.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			$('#form-content2').fadeOut('slow', function(){
				$('#form-content2').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	});
$('#reg-form3').submit(function(e){
	
	e.preventDefault(); // Prevent Default Submission
	
	$.ajax({
		url: 'editevaluacionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		$('#form-content3').fadeOut('slow', function(){
			$('#form-content3').fadeIn('slow').html(data);
		});
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
});

$('#reg-form4').submit(function(e){
	
	e.preventDefault(); // Prevent Default Submission
	
	$.ajax({
		url: 'editevaluacionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		$('#form-content4').fadeOut('slow', function(){
			$('#form-content4').fadeIn('slow').html(data);
		});
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
});
$('#reg-form5').submit(function(e){
	
	e.preventDefault(); // Prevent Default Submission
	
	$.ajax({
		url: 'editevaluacionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		$('#form-content5').fadeOut('slow', function(){
			$('#form-content5').fadeIn('slow').html(data);
		});
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
});
$('#reg-form6').submit(function(e){
	
	e.preventDefault(); // Prevent Default Submission
	
	$.ajax({
		url: 'editevaluacionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		$('#form-content6').fadeOut('slow', function(){
			$('#form-content6').fadeIn('slow').html(data);
		});
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
});
$('#reg-form7').submit(function(e){
	
	e.preventDefault(); // Prevent Default Submission
	
	$.ajax({
		url: 'editevaluacionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		$('#form-content7').fadeOut('slow', function(){
			$('#form-content7').fadeIn('slow').html(data);
		});
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
});
$('#reg-form8').submit(function(e){
	
	e.preventDefault(); // Prevent Default Submission
	
	$.ajax({
		url: 'editevaluacionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		$('#form-content8').fadeOut('slow', function(){
			$('#form-content8').fadeIn('slow').html(data);
		});
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
});

$('#reg-form9').submit(function(e){
	
	e.preventDefault(); // Prevent Default Submission
	
	$.ajax({
		url: 'editevaluacionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		$('#form-content9').fadeOut('slow', function(){
			$('#form-content9').fadeIn('slow').html(data);
		});
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
});
$('#reg-form10').submit(function(e){
	
	e.preventDefault(); // Prevent Default Submission
	
	$.ajax({
		url: 'editevaluacionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		$('#form-content10').fadeOut('slow', function(){
			$('#form-content10').fadeIn('slow').html(data);
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
  		</h4>   <br>
 
    
    
  </div>
  <?php 
$id = $_GET['id'];
$rev = $_GET['rev'];
//run the query
$loop = mysqli_query($conexion, "SELECT * FROM tb_revisiones_proyectos WHERE id_revisiones_proyectos = $rev")
    or die (mysqli_error($dbh));



//display the results
$num = 0;
while ($row_proyectos = mysqli_fetch_array($loop))
{
$nombre = $row_proyectos['nombre_revision'];
$fecha = $row_proyectos['fecha_revision'];
}?>
  <div class="col-sm-6 col-md-5 col-md-offset-2 col-lg-6 col-lg-offset-0"><H3><?php echo $nombre?></H3>
  <H4><?php echo $lang['REVISION_DATE']." -> ". $fecha?></H4>
  <HR>
 
  
  
<?php
$id = $_GET['id'];
//run the query
$loop = mysqli_query($conexion, "SELECT * FROM tb_evaluaciones_proyectos WHERE revision_evaluada = $rev")
    or die (mysqli_error($dbh));




$num = 0;
while ($row_evaluacion = mysqli_fetch_array($loop))
{
	$num++;



?>

<div id="form-content<?php echo $num;?>">
     <form method="post" id="reg-form<?php echo $num;?>" name="form1" autocomplete="off">
			

	
	<div class="input_container">
	<h3><hr><?php echo $row_evaluacion ['opcion_evaluada'].'</h3><H4><br>';
	
	$codigo = $row_evaluacion['codigo_opcion_evaluacion'];
$loop_puntos = mysqli_query($conexion, "SELECT * FROM tb_evaluaciones_proyectos 
		LEFT JOIN tb_revisiones_proyectos ON tb_evaluaciones_proyectos.revision_evaluada = tb_revisiones_proyectos.id_revisiones_proyectos WHERE codigo_opcion_evaluacion = '$codigo'")
    or die (mysqli_error($dbh));
$suma_puntos = 0;
    while ($row_puntos = mysqli_fetch_array($loop_puntos))
    {
    	$p =  $row_puntos['puntos_obtenidos'];
    	$suma_puntos = $suma_puntos+$p;
    	echo $row_puntos['nombre_revision'].' => '.$p.'<br>';
    }
	?></h4>
	<hr>
	
	
	
	
	<?php echo "<strong>".$lang['TOTAL_POINTS']." ===> ".$row_evaluacion ['puntos_evaluados']."</strong><br>";
echo "<strong>".$lang['PERCENTAGE_ASSIGNED']." ===> ".$row_evaluacion ['porcentaje_evaluado']."%</strong><br>";
echo "<strong>".$lang['POINTS_ASSIGNED']." ===> ".($row_evaluacion ['porcentaje_evaluado'] * $row_evaluacion ['puntos_evaluados']/100)."</strong><br><HR><BR>";
$recomendados = ($row_evaluacion ['puntos_evaluados']*$row_evaluacion ['porcentaje_evaluado'])/100;
echo "<strong>".$lang['RECOMMENDED_POINTS']." ===> ".$recomendados/$row_evaluacion['num_revisiones_item']."</strong><br>";
echo "<strong>".$lang['GIVEN_POINTS']." ===> ".$suma_puntos."</strong><br>";
?>

	
            <label for="puntos_obtenidos"><?php echo $lang['POINTS']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="puntos_obtenidos" id="puntos_obtenidos"<?php echo $num;?> value="<?php echo $row_evaluacion['puntos_obtenidos'] ?>" required>
           <input type="hidden" class="text" name="id_evaluacion_proyectos" id="id_evaluacion_proyectos" value="<?php echo $row_evaluacion['id_evaluacion_proyectos'] ?>" >
            <input type="hidden" class="text" name="proyecto_evaluado" id="proyecto_evaluado" value="<?php echo $row_evaluacion['proyecto_evaluado'] ?>" >
           <input type="hidden" class="text" name="revision_evaluada" id="revision_evaluada" value="<?php echo $row_evaluacion['revision_evaluada'] ?>" >
          <input type="hidden" class="text" name="codigo_opcion_evaluacion" id="codigo_opcion_evaluacion" value="<?php echo $row_evaluacion['codigo_opcion_evaluacion'] ?>" >
            </div>
          </div>	
  	<div class="input_container">

            <label for="comentarios_evaluados"><?php echo $lang['COMMENTS']?>: <span class="required">*</span></label>
            <div class="field_container">
              <textarea   name="comentarios_evaluados" id="comentarios_evaluados"<?php echo $num;?>">  <?php echo $row_evaluacion['comentarios_evaluados'] ?></textarea>
           
            </div>
          </div>

				
		
	<hr />
				
	<div class="form-group">
	<button class="btn btn-primary"><?php echo $lang['UPDATE_DATA']?></button>
	</div>
				
    </form>     
</div>
<?php 
}
if ($num > 0){
	echo '<a href="proyecto_a_evaluar.php?id='.$_GET['id'].'" class="btn btn-primary btn-lg active" role="button">'.$lang['GO'].'</a>';
}
 ?>
 
    
  

   
 
  

  
  
  
  

  
  </div>
</div>
      

</div>
</body>
</html>

