<?php 

header('Content-type: text/html; charset=utf-8' , true );
include_once 'common.php';
include_once 'funciones.php';

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
$query_Recordset3 = "SELECT * FROM tb_revisiones_rci  WHERE id_revisiones_rci = $id";
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
			url: 'editrcideliverable.php',
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

	remote = open('subirentregablerci.php','remote','width=300,height=150,location=no,scrollbars=yes, menubar=no, toolbars=no,resizable=yes,fullscreen=yes, status=yes');

	remote.focus();
	}


</script>
</head> 
<body>
<?php include 'menu.php';?>

<div class = "container">
   <div class = "row" >
   
     
    <div class="row">
  <div class="col-sm-6 col-md-5 col-lg-6"><H3><?php echo $lang['RCI_INFO']?></H3>
  <hr>
  <h4>
  <p><strong><?php echo $lang['TITLE_REQ']?>: </strong><?php echo $row_Recordset3['titulo_rci']?></p>
  <p><strong><?php echo $lang['DESC_REQ']?>: </strong><?php echo get_descripcion_rci($row_Recordset3['rci_revisado'])?></p>
  	<p><strong><?php echo $lang['EVALUATION_DATE']?>: </strong><?php echo $row_Recordset3['fecha_inicio_rci']?></p>
  	
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
  	

  <p><strong><?php echo $lang['CUSTOMER']?>: </strong><?php echo get_nombre($row_Recordset3['cliente_rci'])?></p>
  	<p><strong><?php echo $lang['INTERNAL_SUPPLIER']?>: </strong><?php echo get_nombre($row_Recordset3['proveedor_rci'])." ".$row_Recordset3['apellidos_usuario']?></p>
  			   <br>
    
    
  </div>
  <div class="col-sm-6 col-md-5 col-md-offset-2 col-lg-6 col-lg-offset-0"><H3><?php echo $row_Recordset3['nombre_revision']." / ".$lang['DELIVERABLES']?></H3>
  <HR>
  <h4><?php echo $lang['NEW_DELIVERABLE']?></h4>
  
    <div id="form-content">
     <form method="post" id="reg-form" name="form1" autocomplete="off">
			
	<div class="form-group">
	<label><?php echo $lang['TITLE_DELIVERABLE']?></label>
	<input type="text" class="form-control" name="titulo_entregable" id="titulo_entregable" placeholder="<?php echo $lang['TITLE_DELIVERABLE']?>" required />
	</div>
				
	<div class="form-group">
	<label><?php echo $lang['DESCRIPTION_DELIVERABLE']?></label>
	<input type="text" class="form-control" name="descripcion_entregable" id="descripcion_entregable" placeholder="<?php echo $lang['DESCRIPTION_DELIVERABLE']?>" "required />
	<input type="hidden" class="form-control" name="rci_entregable" id="rci_entregable" placeholder="<?php echo $lang['LAST_NAME']?>" value ="<?php echo $_GET['id']?>"required />
	
	</div>
			
				
 <div class="form-group" id="imagenTicket">
        <label><?php echo $lang['FILE_DELIVERABLE']?></label>
      <input name="nombre_entregable" type="text" id="nombre_entregable" class="form-control"  placeholder="<?php echo $lang['FILE_NAME']?>" value="" readonly>
             
              <input type="button" name="button" id="button" value="<?php echo $lang['SELECT_FILE']?>" onclick="javascript:subirimagen();" />
      
      
    </div>

				
		
	<hr />
				
	<div class="form-group">
	<button class="btn btn-primary"><?php echo $lang['UPLOAD_DELIVERABLE']?></button>
	</div>
				
    </form>     

  
 
  

  
  </div>
  
  
    <HR>
  <h4><?php echo $lang['DELIVERABLES']?></h4>
  
<?php
$id = $_GET['id'];
//run the query
$loop = mysqli_query($conexion, "SELECT * FROM tb_entregables_rci WHERE rci_entregable = $id")
    or die (mysqli_error($dbh));



//display the results
while ($row_proyectos = mysqli_fetch_array($loop))
{
	
echo "<strong><a href='entregables_rci/".$row_proyectos['nombre_entregable']."' target='_blank'>".get_nombre_rci($id)." - ".$row_proyectos['titulo_entregable'].'  ('.$row_proyectos['fecha_entregable'].")</strong></a><br>".$row_proyectos['descripcion_entregable']."<br>  <hr>";
	}
	
	
?>
  
 
  
</h4>
  
  </div>
</div>
      

</div>
</body>
</html>

