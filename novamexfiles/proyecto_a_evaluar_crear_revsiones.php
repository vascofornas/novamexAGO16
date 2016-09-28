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
body {
	background-image: url(white.jpg);
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
  <div class="fixed">
  <?php 
  $idioma_actual = $_SESSION['lang'];
  
  
  if ($idioma_actual == "es"){?>
  <a href="proyecto_a_evaluar_crear_revsiones.php?lang=es&id=<?php echo $_GET['id']?>"><img src="mexico.png" width="45" height="45" /></a>
<a href="proyecto_a_evaluar_crear_revsiones.php?lang=en&id=<?php echo $_GET['id']?>"><img src="usa.png" width="30" height="30" /></a>
  <?php }
  if ($idioma_actual == "en"){?>
  <a href="proyecto_a_evaluar_crear_revsiones.php?lang=en&id=<?php echo $_GET['id']?>"><img src="usa.png" width="45" height="45" /></a>
  <a href="proyecto_a_evaluar_crear_revsiones.php?lang=es&id=<?php echo $_GET['id']?>"><img src="mexico.png" width="30" height="30" /></a>

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
<br><br><br><br>
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
                <li class="dropdown">
                
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['PROFILE']?> <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="miperfil.php"><?php echo $lang['DATOS_PERSONALES']?></a></li>
                         <li><a href="misproyectos.php"><?php echo $lang['MY_PROJECTS']?></a></li>
                         <li><a href="eval_proveedor_interno.php"><?php echo $lang['EVALUACION_PROVEEDOR_INTERNO']?></a></li>
                          <li><a href="requerimientos_cliente_interno.php"><?php echo $lang['REQUERIMIENTOS_CLIENTE_INTERNO']?></a></li>
                      <li><a href="tareas_proactividad.php"><?php echo $lang['TAREAS_PROACTIVIDAD']?></a></li>
                    
                      <li class="divider"></li>
                       <li><a href="misreconocimientos.php"><?php echo $lang['MIS_RECONOCIMIENTOS']?></a></li>
                       
                     
                        
                        
                    </ul>
                </li>
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
  <div class="col-sm-6 col-md-5 col-lg-6"><H3><?php echo $lang['PROJECT_INFO']?></H3>
  <hr>
  
  <p><strong><?php echo $lang['PROJECT_NAME']?>: </strong><?php echo $row_Recordset3['nombre_proyecto']?></p>
  <p><strong><?php echo $lang['PROJECT_DESCRIPTION']?>: </strong><?php echo $row_Recordset3['descripcion_proyecto']?></p>
  	<p><strong><?php echo $lang['START_DATE_PROJECT']?>: </strong><?php echo $row_Recordset3['fecha_inicio_proyecto']?></p>
  <p><strong><?php echo $lang['END_DATE_PROJECT']?>: </strong><?php echo $row_Recordset3['fecha_final_proyecto']?></p>
  <p><strong><?php echo $lang['PROJECT_TEAM']?>: </strong><?php echo $row_Recordset3['nombre_equipo']?></p>
  <p><strong><?php echo $lang['PROJECT_EVALUATOR']?>: </strong><?php echo $row_Recordset3['nombre_usuario']." ".$row_Recordset3['apellidos_usuario']?></p>
  		   <br>
 
    
    
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
{
	
$numero_revisiones =  $row_proyectos['num_revisiones'];


if ($row_proyectos['porcentaje1'] >0){
	$porcentaje1 = 1;
	$puntostotales1 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo1 = $row_proyectos['porcentaje1'];
	$opcion1 = $row_proyectos['opcion1'];
	
}
if ($row_proyectos['porcentaje2'] >0){
	$porcentaje2 = 1;
	$puntostotales2 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo2 = $row_proyectos['porcentaje2'];
	$opcion2 = $row_proyectos['opcion2'];
}
if ($row_proyectos['porcentaje3'] >0){
	$porcentaje3 = 1;
	$puntostotales3 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo3 = $row_proyectos['porcentaje3'];
	$opcion3 = $row_proyectos['opcion3'];
}
if ($row_proyectos['porcentaje4'] >0){
	$porcentaje4 = 1;
	$puntostotales4 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo4 = $row_proyectos['porcentaje4'];
	$opcion4 = $row_proyectos['opcion4'];
}
if ($row_proyectos['porcentaje5']>0){
	$porcentaje5 = 1;
	$puntostotales5 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo5 = $row_proyectos['porcentaje5'];
	$opcion5 = $row_proyectos['opcion5'];
}
if ($row_proyectos['porcentaje6'] >0){
	$porcentaje6 = 1;
	$puntostotales6 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo6 = $row_proyectos['porcentaje6'];
	$opcion6 = $row_proyectos['opcion6'];
}
if ($row_proyectos['porcentaje7'] >0){
	$porcentaje7 = 1;
	$puntostotales7 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo7 = $row_proyectos['porcentaje7'];
	$opcion7 = $row_proyectos['opcion7'];
}
if ($row_proyectos['porcentaje8'] >0){
	$porcentaje8 = 1;
	$puntostotales8 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo8 = $row_proyectos['porcentaje8'];
	$opcion8 = $row_proyectos['opcion8'];
}
if ($row_proyectos['porcentaje9'] >0){
	$porcentaje9 = 1;
	$puntostotales9 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo9 = $row_proyectos['porcentaje9'];
	$opcion9 = $row_proyectos['opcion9'];
}
if ($row_proyectos['porcentaje10'] >0){
	$porcentaje10 = 1;
	$puntostotales10 = $row_proyectos['puntos_tipo_proyecto'];
	$porcentajetipo10 = $row_proyectos['porcentaje10'];
	$opcion10 = $row_proyectos['opcion10'];
}
}
	

echo $lang['#_REVISIONS'].": <h3>".$numero_revisiones."</H3> <BR>";
$num_revision = 1;
for ($x = 0; $x < $numero_revisiones; $x++) {
	$num = $x+1;
	$sql = "INSERT INTO tb_revisiones_proyectos (proyecto_revisado,nombre_revision)
VALUES ('$id','Revision # .$num')";
	
	if ($conexion->query($sql) === TRUE) {
		echo "Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $conexion->error;
	}
	$last_id = mysqli_insert_id($conexion);
	
	if ($porcentaje1 == 1){
	
	$sql1 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados)
	VALUES ('$last_id','$porcentajetipo1','$opcion1','$id','$puntostotales1')";
	
	if ($conexion->query($sql1) === TRUE) {
		
	} else {
		echo "Error: " . $sql1 . "<br>" . $conexion->error;
	}
	
	
	}
	

	if ($porcentaje2 == 1){
		
		$sql2 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados)
		VALUES ('$last_id','$porcentajetipo2','$opcion2','$id','$puntostotales2')";
	
		if ($conexion->query($sql2) === TRUE) {
			
		} else {
			echo "Error: " . $sql2 . "<br>" . $conexion->error;
		}
	
	
	}
	if ($porcentaje3 == 1){
	
		$sql3 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados)
		VALUES ('$last_id','$porcentajetipo3','$opcion3','$id','$puntostotales3')";
	
		if ($conexion->query($sql3) === TRUE) {
				
		} else {
			echo "Error: " . $sql3 . "<br>" . $conexion->error;
		}
	
	
	}
	if ($porcentaje4 == 1){
	
		$sql4 = "INSERT INTO tb_evaluaciones_proyectos (revision_evaluada,porcentaje_evaluado,opcion_evaluada,proyecto_evaluado,puntos_evaluados)
		VALUES ('$last_id','$porcentajetipo4','$opcion4','$id','$puntostotales4')";
	
		if ($conexion->query($sql4) === TRUE) {
	
		} else {
			echo "Error: " . $sql4 . "<br>" . $conexion->error;
		}
	
	
	}
	
	
   } //for

if ($num >0){
echo '<a href="proyecto_a_evaluar_editar_revsiones.php?id='.$_GET['id'].'" class="btn btn-primary btn-lg active" role="button">'.$lang['CONFIGURAR_REVISIONES'].'</a>';
}
	
?>
  

  
  </div>
</div>
      

</div>
</body>
</html>

