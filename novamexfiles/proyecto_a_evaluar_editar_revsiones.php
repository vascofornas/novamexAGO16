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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
 
    <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script charset="utf-8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script charset="utf-8" src="//cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>

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
		
		 var x;
		    x = document.getElementById("fecha_final_proyecto1").value;
		    
		    if (x == "") {
		        alert("<?php echo $lang['FECHA_ERROR']?>");
		        return false;
		    };
		    alert ("<?php echo $lang['FECHA_EDITADA']?>");
		
		$.ajax({
			url: 'editrevisionproyecto.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			
		})
		.fail(function(){
				
		});
	});
$('#reg-form2').submit(function(e){
		
	 var x;
	    x = document.getElementById("fecha_final_proyecto2").value;
	    
	    if (x == "") {
	        alert("<?php echo $lang['FECHA_ERROR']?>");
	        return false;
	    };
	    alert ("<?php echo $lang['FECHA_EDITADA']?>");
		
		$.ajax({
			url: 'editrevisionproyecto.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			
		})
		.fail(function(){
			
		});
	});
$('#reg-form3').submit(function(e){
	
	 var x;
	    x = document.getElementById("fecha_final_proyecto3").value;
	    
	    if (x == "") {
	        alert("<?php echo $lang['FECHA_ERROR']?>");
	        return false;
	    };
	    alert ("<?php echo $lang['FECHA_EDITADA']?>");
	
	$.ajax({
		url: 'editrevisionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		
	})
	.fail(function(){
			
	});
});

$('#reg-form4').submit(function(e){
	
	 var x;
	    x = document.getElementById("fecha_final_proyecto4").value;
	    
	    if (x == "") {
	        alert("<?php echo $lang['FECHA_ERROR']?>");
	        return false;
	    };
	    alert ("<?php echo $lang['FECHA_EDITADA']?>");
	
	$.ajax({
		url: 'editrevisionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		
	})
	.fail(function(){
			
	});
});
$('#reg-form5').submit(function(e){
	
	 var x;
	    x = document.getElementById("fecha_final_proyecto5").value;
	    
	    if (x == "") {
	        alert("<?php echo $lang['FECHA_ERROR']?>");
	        return false;
	    };
	    alert ("<?php echo $lang['FECHA_EDITADA']?>");
	
	$.ajax({
		url: 'editrevisionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
	
	})
	.fail(function(){
			
	});
});
$('#reg-form6').submit(function(e){
	
	 var x;
	    x = document.getElementById("fecha_final_proyecto6").value;
	    
	    if (x == "") {
	        alert("<?php echo $lang['FECHA_ERROR']?>");
	        return false;
	    };
	    alert ("<?php echo $lang['FECHA_EDITADA']?>");
	
	$.ajax({
		url: 'editrevisionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
});
$('#reg-form7').submit(function(e){
	
	 var x;
	    x = document.getElementById("fecha_final_proyecto7").value;
	    
	    if (x == "") {
	        alert("<?php echo $lang['FECHA_ERROR']?>");
	        return false;
	    };
	    alert ("<?php echo $lang['FECHA_EDITADA']?>");
	
	$.ajax({
		url: 'editrevisionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		
	})
	.fail(function(){
			
	});
});
$('#reg-form8').submit(function(e){
	
	 var x;
	    x = document.getElementById("fecha_final_proyecto8").value;
	    
	    if (x == "") {
	        alert("<?php echo $lang['FECHA_ERROR']?>");
	        return false;
	    };
	    alert ("<?php echo $lang['FECHA_EDITADA']?>");
	
	$.ajax({
		url: 'editrevisionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		
	})
	.fail(function(){
			
	});
});

$('#reg-form9').submit(function(e){
	
	 var x;
	    x = document.getElementById("fecha_final_proyecto9").value;
	    
	    if (x == "") {
	        alert("<?php echo $lang['FECHA_ERROR']?>");
	        return false;
	    };
	    alert ("<?php echo $lang['FECHA_EDITADA']?>");
	
	$.ajax({
		url: 'editrevisionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		
	})
	.fail(function(){
			
	});
});
$('#reg-form10').submit(function(e){
	
	 var x;
	    x = document.getElementById("fecha_final_proyecto10").value;
	    
	    if (x == "") {
	        alert("<?php echo $lang['FECHA_ERROR']?>");
	        return false;
	    };
	    alert ("<?php echo $lang['FECHA_EDITADA']?>");
	
	$.ajax({
		url: 'editrevisionproyecto.php',
		type: 'POST',
		data: $(this).serialize() // it will serialize the form data
	})
	.done(function(data){
		
	})
	.fail(function(){
			
	});
});



	 var date = new Date();
	    var currentMonth = date.getMonth();
	    var currentDate = date.getDate();
	    var currentYear = date.getFullYear();

	   var fecha_max = new Date('<?php echo $row_Recordset3['fecha_final_proyecto'] ?>');
	   
	   var maxMonth = fecha_max.getMonth();
	    var maxDate = fecha_max.getDate()+1;
	    var maxYear = fecha_max.getFullYear();
	   

	    $('#fecha_inicio_proyecto').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	       
	        dateFormat: 'yy-mm-dd'
	    });;
	    $('#fecha_final_proyecto1').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        maxDate: new Date(maxYear, maxMonth, maxDate),
	        dateFormat: 'yy-mm-dd'
	    });;
	    $('#fecha_final_proyecto2').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        maxDate: new Date(maxYear, maxMonth, maxDate),
	        dateFormat: 'yy-mm-dd'
	    });;

	    $('#fecha_final_proyecto3').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        maxDate: new Date(maxYear, maxMonth, maxDate),
	        dateFormat: 'yy-mm-dd'
	    });;

	    $('#fecha_final_proyecto4').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        maxDate: new Date(maxYear, maxMonth, maxDate),
	        dateFormat: 'yy-mm-dd'
	    });;

	    $('#fecha_final_proyecto5').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        maxDate: new Date(maxYear, maxMonth, maxDate),
	        dateFormat: 'yy-mm-dd'
	    });;

	    $('#fecha_final_proyecto6').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        maxDate: new Date(maxYear, maxMonth, maxDate),
	        dateFormat: 'yy-mm-dd'
	    });;

	    $('#fecha_final_proyecto7').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        maxDate: new Date(maxYear, maxMonth, maxDate),
	        dateFormat: 'yy-mm-dd'
	    });;

	    $('#fecha_final_proyecto8').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        maxDate: new Date(maxYear, maxMonth, maxDate),
	        dateFormat: 'yy-mm-dd'
	    });;

	    $('#fecha_final_proyecto9').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        maxDate: new Date(maxYear, maxMonth, maxDate),
	        dateFormat: 'yy-mm-dd'
	    });;

	    $('#fecha_final_proyecto10').datepicker({
	        minDate: new Date(currentYear, currentMonth, currentDate),
	        maxDate: new Date(maxYear, maxMonth, maxDate),
	        dateFormat: 'yy-mm-dd'
	    });;
	
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

<?php  include 'menu.php'?>
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
  <div class="col-sm-6 col-md-6 col-lg-6 col-lg-offset-0"><H3><?php echo $lang['PROJECT_REVISIONS_EDITING']?></H3>
  <HR>
 
  
 

  
 
  

  

  
  
    <HR>
  
  
<?php
$id = $_GET['id'];
//run the query
$loop = mysqli_query($conexion, "SELECT * FROM tb_revisiones_proyectos LEFT JOIN tb_proyectos ON 
		tb_revisiones_proyectos.proyecto_revisado = tb_proyectos.id_proyecto WHERE proyecto_revisado = $id ORDER BY id_revisiones_proyectos")
    or die (mysqli_error($dbh));




$num = 0;
while ($row_proyectos = mysqli_fetch_array($loop))
{
	$num++;



?>
 <p><strong><?php echo $row_proyectos['opcion_revision']?><strong></p>
 
<div id="form-content<?php echo $num;?>">
     <form method="post" id="reg-form<?php echo $num;?>" name="form1" autocomplete="off" >
			

	
	<div class="input_container">
            <label for="nombre_revision"><?php echo $lang['REVISION_NAME']?>: </label>
            <div class="field_container">
            <label for="nombre_revision"><?php echo $row_proyectos['nombre_revision'] ?></label>
           
              <input type="hidden" class="text" name="nombre_revision" id="nombre_revision" value="<?php echo $row_proyectos['nombre_revision'] ?>" required>
           <input type="hidden" class="text" name="id_revisiones_proyectos" id="id_revisiones_proyectos" value="<?php echo $row_proyectos['id_revisiones_proyectos'] ?>" >
            <input type="hidden" class="text" name="id_proyecto" id="id_proyecto" value="<?php echo $_GET['id'] ?>" >
          
            </div>
          </div>	
  	
<div class="input_container">
            <label for="fecha_revision"><?php echo $lang['REVISION_DATE']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="fecha_revision"  id="fecha_final_proyecto<?php echo $num;?>" value="<?php echo $row_proyectos['fecha_revision'] ?>" required readonly>
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

