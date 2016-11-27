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

    	
        var proceed = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields       
        $("#contact_form input[required=true], #contact_form textarea[required=true]").each(function(){
            $(this).css('border-color',''); 
            if(!$.trim($(this).val())){ //if this field is empty 
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag
            }
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag              
            }   
        });
       
        if(proceed) //everything looks good! proceed...
        {
            //get input field values data to be sent to server
            post_data = {
                
                'eval_c1'           : $('select[name=eval_c1]').val(),

                'eval_c2'           : $('select[name=eval_c2]').val(),
                'eval_c3'           : $('select[name=eval_c3]').val(),
                'eval_c4'           : $('select[name=eval_c4]').val(),
                'eval_id'           : $('input[name=eval_id]').val(),
                'proveedor'           : $('input[name=proveedor]').val(),
                
                
            };
            
            //Ajax post data to server
            $.post('evaluar_proveedor_interno.php', post_data, function(response){  
                if(response.type == 'error'){ //load json data from server and output message     
                    output = '<div class="error">'+response.text+'</div>';
                }else{
                    output = '<div class="success">'+response.text+'</div>';
                    //reset values in all input fields
                    $("#contact_form  input[required=true], #contact_form textarea[required=true]").val(''); 
                    $("#contact_form #contact_body").slideUp(); //hide form after success
                }
                $("#contact_form #contact_results").hide().html(output).slideDown();
            }, 'json');
        }
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
<h2><?php echo $lang['EVALUATE']?></h2>

<div class="form-style" id="contact_form">
    
    <div id="contact_results" style="background-color:#f44242;font-family: Arial Black; font-size: 24px; 
color: white"></div>
    <div id="contact_body">

<h2 align="center"><?php echo  $row_Recordset3['nombre_revision']." -> ".$row_Recordset3['fecha_inicio_rci'];?></h2>
<br>
<div class="row">

  <img src="entregables.png" width="60" height="60" /></a>
    <bR><bR>
    <?php 
   
    $id = $_GET['id'];
//run the query
$loop = mysqli_query($conexion, "SELECT * FROM tb_entregables_rci WHERE rci_entregable = $id")
    or die (mysqli_error($dbh));



//display the results
$num = 0;
while ($row_proyectos = mysqli_fetch_array($loop))
{
	$num = $num+1;
	echo $num." - ".$row_proyectos['fecha_entregable']." - ".$row_proyectos['titulo_entregable'].'  <a href="entregables_rci/'.$row_proyectos['nombre_entregable'].' "  target="_blank"  class="btn btn-info btn-lg active " role="button" > <span class="glyphicon glyphicon-download-alt"></span></a><br><br>';;
}
    ?>
	
	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['CUSTOMER']?></label>
                      <h4><?php echo  get_nombre($row_Recordset3['cliente_rci']);?></h4>
                      <input type="hidden" class="form-control" id="eval_id" name="eval_id" placeholder="Enter ..." disabled value="<?php echo $_GET['id'];?>">
      
                      <input type="hidden" class="form-control" id="proveedor" name="proveedor" placeholder="Enter ..." disabled value="<?php echo $row_Recordset3['proveedor_rci'];?>">
        </div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['INTERNAL_SUPPLIER']?></label>
                      <h4><?php echo  get_nombre($row_Recordset3['proveedor_rci']);?></h4>
                      
                      <input type="hidden" class="form-control" id="cliente" name="cliente" placeholder="Enter ..." disabled value="<?php echo $_SESSION['userSession'];?>">
        </div>
	</div>

	
              
<div class="col-md-6">
         
         <div class="form-group">
                      <label><?php echo $lang['TITLE_REQ']?></label>
                      <h4><?php echo $row_Recordset3['titulo_rci'];?></h4>
                      <input type="hidden" name="titulo" id="titulo" class="form-control" placeholder="<?php echo $lang['TITLE_REQ']?> ...">
                    </div>I
                    

 </div>
 <div class="col-md-6">
         
         <div class="form-group">
                      <label><?php echo $lang['DESC_REQ']?></label>
                      <h4><?php echo get_descripcion_rci($row_Recordset3['rci_revisado']);?></h4>
                      <input type="hidden" name="titulo" id="titulo" class="form-control" placeholder="<?php echo $lang['TITLE_REQ']?> ...">
                    </div>
                    

 </div>
 
	<div class="col-md-12">
		<div class="form-group">
                      <label><?php echo $lang['EVALUATION_DATE']?></label>
                   <h4><?php echo $row_Recordset3['fecha_inicio_rci'];?></h4>
                      <input type="hidden" name="titulo" id="titulo" class="form-control" placeholder="<?php echo $lang['TITLE_REQ']?> ...">
                    </div>

</div>

<div class="col-md-6">
         <?php if (get_concepto1_rci($row_Recordset3['rci_revisado']) ==""){
         
         }
        else {?>
         
         <div class="form-group">
                      <label><?php echo $lang['CONCEPT']." #1"?></label>
                       <h4><?php echo get_concepto1_rci($row_Recordset3['rci_revisado']);?></h4>
                      <input type="hidden" name="titulo" id="titulo" class="form-control" placeholder="<?php echo $lang['TITLE_REQ']?> ...">
                    </div>
                    

 </div>
 <div class="col-md-6">
         
         <div class="form-group">
                      <label><?php echo $lang['EVALUATE']." (".$row_Recordset3['evaluacion_c1']." pts)"?></label>
                    
                    <select id="eval_c1" name="eval_c1" class="form-control select2" style="width: 100%;">
                      <option  value="<?php echo get_na_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['NO_ANSWER_POINTS']." (". get_na_rci($row_Recordset3['rci_revisado']).")"?></option>
                      <option value="<?php echo get_el_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_LEVE']." (". get_el_rci($row_Recordset3['rci_revisado']).")"?></option>
                     <option  value="<?php echo get_ea_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_ACEPTABLE']." (". get_ea_rci($row_Recordset3['rci_revisado']).")"?></option>
                      <option value="<?php echo get_ee_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_EXCEPCIONAL']." (". get_ee_rci($row_Recordset3['rci_revisado']).")"?></option>
                    
                      </select> 
                      </div>
                    
<?php }?>
 </div>
<div class="col-md-6">
         <?php if (get_concepto2_rci($row_Recordset3['rci_revisado']) ==""){
         
         }
        else {?>
         
         <div class="form-group">
                      <label><?php echo $lang['CONCEPT']." #2"?></label>
                       <h4><?php echo get_concepto2_rci($row_Recordset3['rci_revisado']);?></h4>
                      <input type="hidden" name="titulo" id="titulo" class="form-control" placeholder="<?php echo $lang['TITLE_REQ']?> ...">
                    </div>
                    

 </div>
 <div class="col-md-6">
         
         <div class="form-group">
                      <label><?php echo $lang['EVALUATE']." (".$row_Recordset3['evaluacion_c2']." pts)"?></label>
                    
                    <select id="eval_c2" name="eval_c2" class="form-control select2" style="width: 100%;">
                      <option selected="selected" value="<?php echo get_na_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['NO_ANSWER_POINTS']." (". get_na_rci($row_Recordset3['rci_revisado']).")"?></option>
                      <option value="<?php echo get_el_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_LEVE']." (". get_el_rci($row_Recordset3['rci_revisado']).")"?></option>
                     <option  value="<?php echo get_ea_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_ACEPTABLE']." (". get_ea_rci($row_Recordset3['rci_revisado']).")"?></option>
                      <option value="<?php echo get_ee_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_EXCEPCIONAL']." (". get_ee_rci($row_Recordset3['rci_revisado']).")"?></option>
                    
                      </select> </div> 
                    
<?php }?>
 </div>
<div class="col-md-6">
         <?php if (get_concepto3_rci($row_Recordset3['rci_revisado']) ==""){
         
         }
        else {?>
         <div class="form-group">
                      <label><?php echo $lang['CONCEPT']." #3"?></label>
                       <h4><?php echo get_concepto3_rci($row_Recordset3['rci_revisado']);?></h4>
                      <input type="hidden" name="titulo" id="titulo" class="form-control" placeholder="<?php echo $lang['TITLE_REQ']?> ...">
                    </div>
                    

 </div>
 <div class="col-md-6">
       
         <div class="form-group">
                      <label><?php echo $lang['EVALUATE']." (".$row_Recordset3['evaluacion_c3']." pts)"?></label>
                    
                   <select id="eval_c3" name="eval_c3" class="form-control select2" style="width: 100%;">
                      <option selected="selected" value="<?php echo get_na_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['NO_ANSWER_POINTS']." (". get_na_rci($row_Recordset3['rci_revisado']).")"?></option>
                      <option value="<?php echo get_el_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_LEVE']." (". get_el_rci($row_Recordset3['rci_revisado']).")"?></option>
                     <option  value="<?php echo get_ea_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_ACEPTABLE']." (". get_ea_rci($row_Recordset3['rci_revisado']).")"?></option>
                      <option value="<?php echo get_ee_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_EXCEPCIONAL']." (". get_ee_rci($row_Recordset3['rci_revisado']).")"?></option>
                    
                      </select> </div> 
                    
<?php }?>
 </div>
 
 
<div class="col-md-6">
         <?php if (get_concepto4_rci($row_Recordset3['rci_revisado']) ==""){
         
         }
        else {?>
         <div class="form-group">
                      <label><?php echo $lang['CONCEPT']." #4"?></label>
                       <h4><?php echo get_concepto4_rci($row_Recordset3['rci_revisado']);?></h4>
                      <input type="hidden" name="titulo" id="titulo" class="form-control" placeholder="<?php echo $lang['TITLE_REQ']?> ...">
                    </div>
                    

 </div>
 <div class="col-md-6">
         
         <div class="form-group">
                      <label><?php echo $lang['EVALUATE']." (".$row_Recordset3['evaluacion_c4']." pts)"?></label>
                    
                   <select id="eval_c4" name="eval_c4" class="form-control select2" style="width: 100%;">
                      <option selected="selected" value="<?php echo get_na_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['NO_ANSWER_POINTS']." (". get_na_rci($row_Recordset3['rci_revisado']).")"?></option>
                      <option value="<?php echo get_el_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_LEVE']." (". get_el_rci($row_Recordset3['rci_revisado']).")"?></option>
                     <option  value="<?php echo get_ea_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_ACEPTABLE']." (". get_ea_rci($row_Recordset3['rci_revisado']).")"?></option>
                      <option value="<?php echo get_ee_rci($row_Recordset3['rci_revisado'])?>"><?php echo $lang['ESFUERZO_EXCEPCIONAL']." (". get_ee_rci($row_Recordset3['rci_revisado']).")"?></option>
                    
                      </select> </div> </div>
                    <?php }?>

 </div>


	
	


	
	



	
	<div class="row">
	<div class="col-md-6">
	<input type="submit" id="submit_btn" class="btn btn-primary btn-lg" value="Enviar" />
	</div></div>
	</div></div></div></div>
</div>
</body>
</html>

