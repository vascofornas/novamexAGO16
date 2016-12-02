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
<meta charset="ISO-8859-1">

  

<title><?php echo $row['userName']?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
 
<!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
 <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


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
 <script>
  $(document).ready(function() {

    var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();

    $('#fecha_inicio_proyecto').datepicker({
        minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'yy-mm-dd'
    });;
    $('#fecha_final_proyecto').datepicker({
        minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'yy-mm-dd'
    });;
  });
  </script>

<!-- Start jQuery code -->
<script type="text/javascript">
$(document).ready(function() {

	   var date = new Date();
	    var currentMonth = date.getMonth();
	    var currentDate = date.getDate();
	    var currentYear = date.getFullYear();

	    $('#fecha').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        dateFormat: 'yy-mm-dd'
	    });;
	  
    $("#submit_btn").click(function() { 

    	var tor = []; 
    	$('#tor :selected').each(function(i, selected){ 
    	  tor[i] = $(selected).val(); 
    	});
		alert (tor);

	
	location.href = "tor_create_revisions.php?id=" + tor + "&rev="+<?php echo $_GET['id']?>



    	
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function() { 
        $(this).css('border-color',''); 
        $("#contact_results").slideUp();
    });
});
</script>
<!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
 <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
</head> 
<body>
<?php include 'menu.php';?>

<div class = "container">
<h2><?php echo $lang['CREAR_OR']?></h2>
<div class="form-style" id="contact_form">
    
    <div id="contact_results" style="background-color:#f44242;font-family: Arial Black; font-size: 24px; 
color: white"></div>
    <div id="contact_body">
<div class="row">


	
	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['EVALUATOR']?></label>
                      <h4><?php echo get_nombre( ($_SESSION['userSession']));?></h4>
                      
                      <input type="hidden" class="form-control" id="cliente" name="cliente" placeholder="Enter ..." disabled value="<?php echo $_SESSION['userSession'];?>">
        </div>
	
<div class="form-group">
                      <label><?php echo $lang['TIPOS_OTROS_RUBROS']?></label>
                      <h4><?php echo get_nombre_rubro( ($_GET['id']));?></h4>
                      
                      <input type="hidden" class="form-control" id="cliente" name="cliente" placeholder="Enter ..." disabled value="<?php echo $_SESSION['userSession'];?>">
        </div>
	
	
	<div class="form-group">
                      <label><?php echo $lang['SCOPE']?></label>
                     <?php  $ambito =get_ambito_rubro($_GET['id']);
                     $scope ="";
		if ($ambito == 1){
			$scope = $lang['INDIVIDUAL'];?>
			<h4><?php echo $scope;?></h4>
			                          </div>
			                          <?php  
			      $proveedores =  $_GET['rev'];
			      
			      $myArray = explode(',', $proveedores);
			     
			      $resultado = count($myArray);
			      
				for ($x = 0; $x <= $resultado; $x++) {
			    echo get_nombre($myArray[$x])." <br>";
				} 
			     
			      ?>
			      <?php 
		}
		if ($ambito == 2){
			$scope = $lang['EQUIPO'];?>
			
			<h4><?php echo $scope;?></h4>
						                          </div>
						                          <?php  
						      $proveedores =  $_GET['rev'];
						      
						      $myArray = explode(',', $proveedores);
						     
						      $resultado = count($myArray);
						      
							for ($x = 0; $x <= $resultado; $x++) {
						    echo get_team($myArray[$x])." <br>";
							} 
						     
						      ?>
						      <?php 
					}
	
	
		if ($ambito == 3){
			$scope = $lang['REGION'];?>

			<h4><?php echo $scope;?></h4>
									                          </div>
									                          <?php  
									      $proveedores =  $_GET['rev'];
									      
									      $myArray = explode(',', $proveedores);
									     
									      $resultado = count($myArray);
									      
										for ($x = 0; $x <= $resultado; $x++) {
									    echo get_region($myArray[$x])." <br>";
										} 
									     
									     
								
		}
		if ($ambito == 4){
			$scope = $lang['UN'];?>
			<h4><?php echo $scope;?></h4>
												                          </div>
												                          <?php  
												      $proveedores =  $_GET['rev'];
												      
												      $myArray = explode(',', $proveedores);
												     
												      $resultado = count($myArray);
												      
													for ($x = 0; $x <= $resultado; $x++) {
												    echo get_bu($myArray[$x])." <br>";
													}
		}
		if ($ambito == 5){
			$scope = $lang['TODOS'];?>
			<h4><?php echo $scope;?></h4>
						                          </div>
						                          <?php  
						   
						     
		}
		
	
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}   ?>
    
	</div>
		
	
	
	 <div class="col-md-6">
     
<?php
$id = $_GET['id'];



//run the query
$loop = mysqli_query($conexion, "SELECT * FROM tb_tipos_otros_rubros WHERE id_tor = $id")
    or die (mysqli_error($dbh));



//display the results

while ($row_proyectos = mysqli_fetch_array($loop))
{//while
	
		echo "<BR>".$row_proyectos['id_tor'];
		
		//periodicidad 1 UNA SOLA VEZ
		$periodicidad = $row_proyectos['periodicidad_tor'];
		$repeticiones = $row_proyectos['repeticiones_tor'];
		$cliente_tor = $_SESSION['userSession'];
		$titulo_tor = $row_proyectos['titulo_tor'];
		$fecha_inicio = $_GET['pu'];
		$ambito = $row_proyectos['ambito_tor'];
		
		echo "<br>AMBITO".$ambito;
		
		echo "<br>REPETICIONES".$repeticiones;




if ($periodicidad == 2){//if periodicidad EVERY DAY
	$num = 0;
	echo "<br>ROTACION PERIODICIDAD=".$num."<br>";
	echo "<br>NUMERO DE REPETCIONES=".$repeticiones."<br>";
	$codigo1 = generateRandomString();
	$newdate = $fecha_inicio;
	$num_revision = 1;
	for ($y = 0; $y < $repeticiones; $y++) {//for
		echo  "PERODICIDAD =".$periodicidad;
		if ($num == 0){
			$newdate = $fecha_inicio;
		}
		else {
		$newdate = strtotime ( '1 day' , strtotime ( $newdate ) ) ;
		$newdate = date ( 'Y-m-j' , $newdate );
		}
		$num = $y+1;
		echo "<BR>fuera de loop REPETICION NUM:".$num;
		
		
				// AMBITO =  1
				
			if ($ambito == 1){
						
						$proveedores =  $_GET['rev'];
						 
						$myArray = explode(',', $proveedores);
						
						$resultado = count($myArray);
						 echo "NUMERO DE USUARIOS=".$resultado;
						 echo "<BR>dentro de loop REPETICION NUM:".$num;
						for ($x = 0; $x < $resultado; $x++) {
							echo get_nombre($myArray[$x])." <br>";
							$proveedor_tor = $myArray[$x];
						echo "ROTACION AMBITO=".$ambito."->".$x."<br>";
				$sql = "INSERT INTO tb_revisiones_tor (tor_revisado,nombre_revision,titulo_tor,cliente_tor,proveedor_tor,fecha_inicio_tor)
				VALUES ('$id','Revision # .$num','$titulo_tor','$cliente_tor','$proveedor_tor','$newdate')";
			
				if ($conexion->query($sql) === TRUE) {
					echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
				$last_id = mysqli_insert_id($conexion);
				}//if 
				else {
					echo "Error: " . $sql . "<br>" . $conexion->error;
				}//else
				$last_id = mysqli_insert_id($conexion);
				
						}
						
			}//fin ambito 1

			if ($ambito == 2){
			
				$proveedores =  $_GET['rev'];
					
				$myArray = explode(',', $proveedores);
			
				$resultado = count($myArray);
					
				for ($x = 0; $x < $resultado; $x++) {
					echo get_nombre($myArray[$x])." <br>";
					$proveedor_tor = $myArray[$x];
					echo "ROTACION AMBITO=".$x."<br>";
					
					
					
					//seleccionar miembros equipo
					$loop2 = mysqli_query($conexion, "SELECT * FROM tb_miembros_equipos  WHERE equipo = $proveedor_tor")
					or die (mysqli_error($dbh));
					
					echo "PROVEEDRORES=".$proveedores;
					//display the results
					
					while ($row_equipos = mysqli_fetch_array($loop2))
					{//while
						echo "<br>Usuario=".$row_equipos['usuario']."<br>";
						$proveedor = $row_equipos['usuario'];
									$sql = "INSERT INTO tb_revisiones_tor (tor_revisado,nombre_revision,titulo_tor,cliente_tor,proveedor_tor,fecha_inicio_tor)
								VALUES ('$id','Revision # .$num','$titulo_tor','$cliente_tor','$proveedor','$newdate')";
									
								if ($conexion->query($sql) === TRUE) {
									echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
									$last_id = mysqli_insert_id($conexion);
								}//if
								else {
									echo "Error: " . $sql . "<br>" . $conexion->error;
								}//else
								$last_id = mysqli_insert_id($conexion);
						
							}
				}
					
			}//fin ambito 2
			if ($ambito == 3){
					
				$proveedores =  $_GET['rev'];
					
				$myArray = explode(',', $proveedores);
					
				$resultado = count($myArray);
					
				for ($x = 0; $x < $resultado; $x++) {
					echo get_nombre($myArray[$x])." <br>";
					$proveedor_tor = $myArray[$x];
					echo "ROTACION AMBITO=".$x."<br>";
						
						echo "ESTOY EN AMBITO 3";
						
					//seleccionar miembros equipo
					$loop3 = mysqli_query($conexion, "SELECT * FROM tbl_users  WHERE region_usuario = $proveedor_tor")
					or die (mysqli_error($dbh));
						
					echo "PROVEEDRORES=".$proveedores;
					//display the results
						
					while ($row_regiones = mysqli_fetch_array($loop3))
					{//while
						echo "<br>Usuario=".$row_regiones['userID']."<br>";
						$proveedor = $row_regiones['userID'];
						$sql = "INSERT INTO tb_revisiones_tor (tor_revisado,nombre_revision,titulo_tor,cliente_tor,proveedor_tor,fecha_inicio_tor)
						VALUES ('$id','Revision # .$num','$titulo_tor','$cliente_tor','$proveedor','$newdate')";
							
						if ($conexion->query($sql) === TRUE) {
							echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
							$last_id = mysqli_insert_id($conexion);
						}//if
						else {
							echo "Error: " . $sql . "<br>" . $conexion->error;
						}//else
						$last_id = mysqli_insert_id($conexion);
			
					}
				}
					
			}//fin ambito 3
			if ($ambito == 4){
					
				$proveedores =  $_GET['rev'];
					
				$myArray = explode(',', $proveedores);
					
				$resultado = count($myArray);
					
				for ($x = 0; $x < $resultado; $x++) {
					echo get_nombre($myArray[$x])." <br>";
					$proveedor_tor = $myArray[$x];
					echo "ROTACION AMBITO=".$x."<br>";
			
					echo "ESTOY EN AMBITO 4";
			
					//seleccionar miembros equipo
					$loop3 = mysqli_query($conexion, "SELECT * FROM tbl_users  WHERE unidad_negocio_usuario = $proveedor_tor")
					or die (mysqli_error($dbh));
			
					echo "PROVEEDRORES=".$proveedores;
					//display the results
			
					while ($row_regiones = mysqli_fetch_array($loop3))
					{//while
						echo "<br>Usuario=".$row_regiones['userID']."<br>";
						$proveedor = $row_regiones['userID'];
						$sql = "INSERT INTO tb_revisiones_tor (tor_revisado,nombre_revision,titulo_tor,cliente_tor,proveedor_tor,fecha_inicio_tor)
						VALUES ('$id','Revision # .$num','$titulo_tor','$cliente_tor','$proveedor','$newdate')";
							
						if ($conexion->query($sql) === TRUE) {
							echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
							$last_id = mysqli_insert_id($conexion);
						}//if
						else {
							echo "Error: " . $sql . "<br>" . $conexion->error;
						}//else
						$last_id = mysqli_insert_id($conexion);
							
					}
				}
					
			}//fin ambito 4
			if ($ambito == 5){
					
				$proveedores =  $_GET['rev'];
					
				$myArray = explode(',', $proveedores);
					
				$resultado = count($myArray);
					
				for ($x = 0; $x < $resultado; $x++) {
					echo get_nombre($myArray[$x])." <br>";
					$proveedor_tor = $myArray[$x];
					echo "ROTACION AMBITO=".$x."<br>";
						
					echo "ESTOY EN AMBITO 4";
						
					//seleccionar miembros equipo
					$loop3 = mysqli_query($conexion, "SELECT * FROM tbl_users ")
					or die (mysqli_error($dbh));
						
					echo "PROVEEDRORES=".$proveedores;
					//display the results
						
					while ($row_regiones = mysqli_fetch_array($loop3))
					{//while
						echo "<br>Usuario=".$row_regiones['userID']."<br>";
						$proveedor = $row_regiones['userID'];
						$sql = "INSERT INTO tb_revisiones_tor (tor_revisado,nombre_revision,titulo_tor,cliente_tor,proveedor_tor,fecha_inicio_tor)
						VALUES ('$id','Revision # .$num','$titulo_tor','$cliente_tor','$proveedor','$newdate')";
							
						if ($conexion->query($sql) === TRUE) {
							echo " Revision # ".$num."  ".$lang['REVISION_CREATED']."<br>";
							$last_id = mysqli_insert_id($conexion);
						}//if
						else {
							echo "Error: " . $sql . "<br>" . $conexion->error;
						}//else
						$last_id = mysqli_insert_id($conexion);
							
					}
				}
					
			}//fin ambito 5
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
</body>
</html>

