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
                'supervisor'     : $('input[name=supervisor]').val(), 
                'cliente'    : $('input[name=cliente]').val(), 
                'proveedor'  : $('select[name=proveedor]').val(), 
                'titulo'  : $('input[name=titulo]').val(), 
                'texto'       : $('textarea[name=texto]').val(), 
                'periodicidad'           : $('select[name=periodicidad]').val(),

                'repeticiones'           : $('select[name=repeticiones]').val(),
                'fecha'  : $('input[name=fecha]').val(),
                'concepto1'  : $('input[name=concepto1]').val(),

                'concepto2'  : $('input[name=concepto2]').val(),

                'concepto3'  : $('input[name=concepto3]').val(),

                'concepto4'  : $('input[name=concepto4]').val(),

                'sin_puntos'  : $('input[name=sin_puntos]').val(),

                'leve'  : $('input[name=leve]').val(),

                'aceptable'  : $('input[name=aceptable]').val(),

                'excepcional'  : $('input[name=excepcional]').val(),
            };
            
            //Ajax post data to server
            $.post('enviar_re_cliente_interno.php', post_data, function(response){  
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
<h2><?php echo $lang['CREATE_NEW_REQ']?></h2>
<div class="form-style" id="contact_form">
    
    <div id="contact_results" style="background-color:#f44242;font-family: Arial Black; font-size: 24px; 
color: white"></div>
    <div id="contact_body">
<div class="row">


	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['SUPERVISOR']?></label>
                      <h4><?php echo get_nombre( get_supervisor($_SESSION['userSession']));?></h4>
                      <input type="hidden" class="form-control" id="supervisor" name="supervisor" placeholder="Enter ..." disabled value="<?php echo get_supervisor($_SESSION['userSession']);?>">
        </div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['CUSTOMER']?></label>
                      <h4><?php echo get_nombre( ($_SESSION['userSession']));?></h4>
                      
                      <input type="hidden" class="form-control" id="cliente" name="cliente" placeholder="Enter ..." disabled value="<?php echo $_SESSION['userSession'];?>">
        </div>
	</div>

		<?php   $sqlBU="SELECT * FROM tbl_users ORDER BY nombre_usuario";?>
 
   <div class="col-md-6">
         <div class="form-group">
                    <label><?php echo $lang['INTERNAL_SUPPLIER']?></label>
                    <select class="form-control select2" id="proveedor" name="proveedor" style="width: 100%;">
                                
        <?php   if ($result=mysqli_query($conexion,$sqlBU))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
    	
    	
    printf ("%s (%s)\n",$row[0],$row[1]);
    	
    	
    	 	printf ("%s (%s)\n",$row[0],$row[1]);
    	 	echo '<option value='.$row[0].' selected>'.$row[7].' '.$row[8].'</option>';
    	 	
    	
    }
  // Free result set
  mysqli_free_result($result);
}
     ?>           
                
                    </select>
          </div><!-- /.form-group -->
           </div>
              
<div class="col-md-6">
         
         <div class="form-group">
                      <label><?php echo $lang['TITLE_REQ']?></label>
                      <input type="text" name="titulo" id="titulo" class="form-control" placeholder="<?php echo $lang['TITLE_REQ']?> ...">
                    </div>
                    

 </div>
 <div class="col-md-12">
 <div class="form-group">
                      <label><?php echo $lang['DESC_REQ']?></label>
                      <textarea class="form-control" id="texto" name="texto" rows="3" placeholder="<?php echo $lang['DESC_REQ']?>..."></textarea>
 </div>
 

 <div class="row">

	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['PERIODICITY']?></label>
                   <select id="periodicidad" name="periodicidad" class="form-control select2" style="width: 100%;">
                        <option selected="selected" value="1"><?php echo $lang['ONLY_ONCE']?></option>
                      <option value="2"><?php echo $lang['EVERYDAY']?></option>
                      <option value="3"><?php echo $lang['EVERY_WEEK']?></option>
                      <option value="4"><?php echo $lang['EVERY_TWO_WEEKS']?></option>
                      <option value="5"><?php echo $lang['EVERY_MONTH']?></option>
                      <option value="6"><?php echo $lang['EVERY_TWO_MONTHS']?></option>
                      <option value="7"><?php echo $lang['EVERY_THREE_MONTHS']?></option>
                      <option value="8"><?php echo $lang['EVERY_FOUR_MONTHS']?></option>
                      
                      <option value="9"><?php echo $lang['EVERY_SIX_MONTHS']?></option>
                      
                      <option value="10"><?php echo $lang['EVERY_TWELVE_MONTHS']?></option>
                    </select>  </div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['REPEATS']?></label>
                      <select id="repeticiones" name="repeticiones" class="form-control select2" style="width: 100%;">
                      <option selected="selected">1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                      <option>10</option>
                      </select>   </div>
	</div>
	</div>
	 <div class="row">

	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['START_DATE_REQ']?></label>
                  <input type="text" id="fecha" name="fecha" class="form-control" name="fecha_inicio_proyecto" id="fecha_inicio_proyecto" placeholder="<?php echo $lang['START_DATE_REQ']?> ...">  </div>
	</div>

	<div class="col-md-6">
		
	</div>
</div>
<div class="row">

	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['CONCEPT']?> 1</label>
                     <input type="text" class="form-control" name="concepto1" id="concepto1" placeholder="<?php echo $lang['CONCEPT']?> 1 ...">    </div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['CONCEPT']?> 2</label>
       <input type="text" class="form-control" name="concepto2" id="concepto2" placeholder="<?php echo $lang['CONCEPT']?> 2...">  </div>
	</div>
</div>
<div class="row">

	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['CONCEPT']?> 3</label>
                     <input type="text" class="form-control" name="concepto3" id="concepto3"  placeholder="<?php echo $lang['CONCEPT']?> 3 ...">    </div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
                      <label><?php echo $lang['CONCEPT']?> 4</label>
       <input type="text" class="form-control"name="concepto4" id="concepto4"  placeholder="<?php echo $lang['CONCEPT']?> 4 ...">  </div>
	</div>
</div>
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
                      <label>Sin PUNTUAR</label>
       <input type="text" class="form-control" name="sin_puntuar" id="sin_puntuar"  placeholder="Puntos por sin puntuar ...">  </div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
                      <label>Puntos ESFUERZO LEVE</label>
                     <input type="text" class="form-control" name="leve" id="leve" placeholder="Puntos por esfuerzo leve ...">    </div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
                      <label>Puntos ESFUERZO ACEPTABLE</label>
       <input type="text" class="form-control" name="aceptable" id="aceptable"  placeholder="Puntos por esfuerzo aceptable ...">  </div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group">
                      <label>Puntos ESFUERZO EXCEPCIONAL</label>
       <input type="text" class="form-control" name="excepcional" id="excepcional"  placeholder="Puntos por esfuerzo excepcional ...">  </div>
	</div>
	</div>
	<div class="row">
	<div class="col-md-6">
	<input type="submit" id="submit_btn" class="btn btn-primary btn-lg" value="Enviar" />
	</div></div>
	</div></div></div></div>
</div>
</body>
</html>

