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
		
 	var fecha = document.getElementById("fecha_inicio_proyecto").value;
	
	location.href = "tor_create_revisions.php?rev=" + tor + "&id="+<?php echo $_GET['id']?> + "&pu=" + fecha;



    	
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
			$scope = $lang['INDIVIDUAL'];
		}
		if ($ambito == 2){
			$scope = $lang['EQUIPO'];
		}
		if ($ambito == 3){
			$scope = $lang['REGION'];
		}
		if ($ambito == 4){
			$scope = $lang['UN'];
		}
		if ($ambito == 5){
			$scope = $lang['TODOS'];
		}
		
	
                      ?>
                      <h4><?php echo $scope;?></h4>
                      <input type="hidden" class="form-control" id="cliente" name="cliente" placeholder="Enter ..." disabled value="<?php echo $_SESSION['userSession'];?>">
        </div>
	</div>
		
	
	
	 <div class="col-md-6">
         <div class="form-group">
            <input type="hidden" class="text" name="tipo" id="tipo" value="<?php echo $_GET['id']?>" required>
            <div class="input_container">
            <label for="fecha_inicio_proyecto"><?php echo $lang['START_DATE_REQ']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="fecha_inicio_proyecto" id="fecha_inicio_proyecto" value="" required>
            </div>
          </div>
		<?php   
		
		
		//AMBITO = 1
		
		if ($ambito == 1){
		$sqlBU="SELECT * FROM tbl_users  ORDER BY nombre_usuario,apellidos_usuario ";?>
 
  
         
         
                    <label><?php echo $lang['SELECT_EMPLOYEE']?></label>
                    <select class="form-control select2" id="tor" name="tor[]" style="width: 100%;"height: 150pt" multiple>
                                
        <?php   if ($result=mysqli_query($conexion,$sqlBU))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
    	
    	
    printf ("%s (%s)\n",$row[0],$row[1]);
    	
    	
    	 	printf ("%s (%s)\n",$row[0],$row[8]);
    	 	echo '<option value='.$row[0].' selected>'.$row[7].' '.$row[8].'</option>';
    	 	
    	
    }
  // Free result set
  mysqli_free_result($result);
}
     ?>           
                
                    </select>
          </div><!-- /.form-group -->
          
              

          
	<div class="row">
	<br>
	<div class="col-md-6">
	<input type="submit" id="submit_btn" class="btn btn-primary btn-lg" value="Enviar" />
	</div></div>
	</div></div></div></div>

<?php 	// FIN AMBITO = 1
		}
		
		//AMBITO = 2
		
		if ($ambito == 2){
		$sqlBU="SELECT * FROM tb_equipos  ORDER BY nombre_equipo ";?>
 
  
         
         
                    <label><?php echo $lang['SELECT_TEAM']?></label>
                    <select class="form-control select2" id="tor" name="tor[]" style="width: 100%;"height: 150pt" multiple>
                                
        <?php   if ($result=mysqli_query($conexion,$sqlBU))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
    	
    	
    printf ("%s (%s)\n",$row[0],$row[1]);
    	
    	
    	 	printf ("%s (%s)\n",$row[0],$row[8]);
    	 	echo '<option value='.$row[0].' selected>'.$row[1].'</option>';
    	 	
    	
    }
  // Free result set
  mysqli_free_result($result);
}
     ?>           
                
                    </select>
          </div><!-- /.form-group -->
           </div>
              

	<div class="row">
	<div class="col-md-6">
	<input type="submit" id="submit_btn" class="btn btn-primary btn-lg" value="Enviar" />
	</div></div>
	</div></div></div></div>

<?php 	// FIN AMBITO = 2
		}
     //AMBITO = 3
     
     if ($ambito == 3){
     	$sqlBU="SELECT * FROM tb_departamentos  ORDER BY nombre_departamento ";?>
      
       
              
              
                         <label><?php echo $lang['SELECT_REGION']?></label>
                         <select class="form-control select2" id="tor" name="tor[]" style="width: 100%;"height: 150pt" multiple>
                                     
             <?php   if ($result=mysqli_query($conexion,$sqlBU))
       {
       // Fetch one and one row
       while ($row=mysqli_fetch_row($result))
         {
         	
         	
         printf ("%s (%s)\n",$row[0],$row[1]);
         	
         	
         	 	printf ("%s (%s)\n",$row[0],$row[8]);
         	 	echo '<option value='.$row[0].' selected>'.$row[1].'</option>';
         	 	
         	
         }
       // Free result set
       mysqli_free_result($result);
     }
          ?>           
                     
                         </select>
               </div><!-- /.form-group -->
                </div>
                   
     
     	<div class="row">
     	<div class="col-md-6">
     	<input type="submit" id="submit_btn" class="btn btn-primary btn-lg" value="Enviar" />
     	</div></div>
     	</div></div></div></div>
     
     <?php 	// FIN AMBITO = 3
          //AMBITO = 4
     }  
          if ($ambito == 4){
          	$sqlBU="SELECT * FROM tb_unidades_negocio  ORDER BY unidad_negocio ";?>
                
                 
                        
                        
                                   <label><?php echo $lang['SELECT_UN']?></label>
                                   <select class="form-control select2" id="tor" name="tor[]" style="width: 100%;"height: 150pt" multiple>
                                               
                       <?php   if ($result=mysqli_query($conexion,$sqlBU))
                 {
                 // Fetch one and one row
                 while ($row=mysqli_fetch_row($result))
                   {
                   	
                   	
                   printf ("%s (%s)\n",$row[0],$row[1]);
                   	
                   	
                   	 	printf ("%s (%s)\n",$row[0],$row[8]);
                   	 	echo '<option value='.$row[0].' selected>'.$row[1].'</option>';
                   	 	
                   	
                   }
                 // Free result set
                 mysqli_free_result($result);
               }
                    ?>           
                               
                                   </select>
                         </div><!-- /.form-group -->
                          </div>
                             
               
               	<div class="row">
               	<div class="col-md-6">
               	<input type="submit" id="submit_btn" class="btn btn-primary btn-lg" value="Enviar" />
               	</div></div>
               	</div></div></div></div>
               
               <?php 	// FIN AMBITO = 4
                    //AMBITO = 5
                    }
                    if ($ambito == 5){
                    	$sqlBU="SELECT * FROM tb_unidades_negocio  ORDER BY unidad_negocio ";?>
                      
                                                 
                                   
                                   	<div class="row">
                                   	<div class="col-md-6">
                                   	<input type="submit" id="submit_btn" class="btn btn-primary btn-lg" value="Enviar" />
                                   	</div></div>
                                   	</div></div></div></div>
                                   
                                   <?php 	// FIN AMBITO = 5
		}?>
		

</div>
</body>
</html>

