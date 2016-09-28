<?php require_once('Connections/conexion.php'); 
header('Content-type: text/html; charset=utf-8' , true );
include_once 'common.php';
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

mysqli_select_db($conexion,$database_conexion);
$query_Recordset1 = "SELECT * FROM tb_welcome_message WHERE tb_welcome_message.id_mensaje =1";
$Recordset1 = mysqli_query($conexion,$query_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

mysqli_select_db($conexion,$database_conexion);
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
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
div.fixed {
    position: fixed;
    right: 10px;
    top: 10px;
    width: 300px;
 
}div.logo {
    position: fixed;
    left: 20px;
    top: 10px;
    width: 414px;
 
}
textarea {
    background: yellow !important;
    color:#000;
    text-shadow:0 1px 0 rgba(0, 0, 0, 0.4);
}
</style>
<title><?php echo $row['userName']?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout.css">
    <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script charset="utf-8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script charset="utf-8" src="//cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
    <script charset="utf-8" src="webapp_tipos_proyectos.js"></script>

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

<style type="text/css">
    .bs-example{
    	margin: 20px;
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

<script>
function myFunction() {
	var a = parseInt(document.getElementById("porcentaje1").value, 10);
	  var b = parseInt(document.getElementById("porcentaje2").value, 10);
	  var c = parseInt(document.getElementById("porcentaje3").value, 10);
	  var d = parseInt(document.getElementById("porcentaje4").value, 10);
	  var e = parseInt(document.getElementById("porcentaje5").value, 10);
	  var f = parseInt(document.getElementById("porcentaje6").value, 10);
	  var g = parseInt(document.getElementById("porcentaje7").value, 10);
	  var h = parseInt(document.getElementById("porcentaje8").value, 10);
	  var i = parseInt(document.getElementById("porcentaje9").value, 10);
	  var j = parseInt(document.getElementById("porcentaje10").value, 10);




	  var sum =  a + b + c + d + e + f + g + h + i + j ;
 
   alert ( "<?php echo $lang['PORCENTAJE_ACUMULADO']?>: " + sum + "%");
}
</script>
<style type="text/css">
.styled-select {
   background: url(http://i62.tinypic.com/15xvbd5.png) no-repeat 96% 0;
   height: 29px;
   overflow: hidden;
   width: 240px;
}

.styled-select select {
   background: transparent;
   border: none;
   font-size: 14px;
   height: 29px;
   padding: 5px; /* If you add too much padding here, the options won't show in IE */
   width: 268px;
}

.styled-select.slate {
   background: url(http://i62.tinypic.com/2e3ybe1.jpg) no-repeat right center;
   height: 34px;
   width: 240px;
}

.styled-select.slate select {
   border: 1px solid #ccc;
   font-size: 16px;
   height: 34px;
   width: 268px;
}

/* -------------------- Rounded Corners */
.rounded {
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
}

.semi-square {
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border-radius: 5px;
}

/* -------------------- Colors: Background */
.slate   { background-color: #ddd; }
.green   { background-color: #779126; }
.blue    { background-color: #3b8ec2; }
.yellow  { background-color: #eec111; }
.black   { background-color: #000; }

/* -------------------- Colors: Text */
.slate select   { color: #000; }
.green select   { color: #fff; }
.blue select    { color: #fff; }
.yellow select  { color: #000; }
.black select   { color: #fff; }


/* -------------------- Select Box Styles: danielneumann.com Method */
/* -------------------- Source: http://danielneumann.com/blog/how-to-style-dropdown-with-css-only/ */
#mainselection select {
   border: 0;
   color: #EEE;
   background: transparent;
   font-size: 20px;
   font-weight: bold;
   padding: 2px 10px;
   width: 378px;
   *width: 350px;
   *background: #58B14C;
   -webkit-appearance: none;
}

#mainselection {
   overflow:hidden;
   width:350px;
   -moz-border-radius: 9px 9px 9px 9px;
   -webkit-border-radius: 9px 9px 9px 9px;
   border-radius: 9px 9px 9px 9px;
   box-shadow: 1px 1px 11px #330033;
   background: #58B14C url("http://i62.tinypic.com/15xvbd5.png") no-repeat scroll 319px center;
}


/* -------------------- Select Box Styles: stackoverflow.com Method */
/* -------------------- Source: http://stackoverflow.com/a/5809186 */
select#soflow, select#soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
   background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
   background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   margin: 20px;
   overflow: hidden;
   padding: 5px 10px;
   text-overflow: ellipsis;
   white-space: nowrap;
   width: 300px;
}

select#soflow-color {
   color: #fff;
   background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#779126, #779126 40%, #779126);
   background-color: #779126;
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
   padding-left: 15px;
}
body {
	background-image: url(white.jpg);
}
</style>
</head> 
<body>
<div class="logo">

<img src="logonovamex100.png" width="414" height="110" /></a>
</div>
<div class="fixed">
  <?php 
  $idioma_actual = $_SESSION['lang'];
  
  
  if ($idioma_actual == "es"){?>
  <a href="admin_tipo_proyectos.php?lang=es"><img src="mexico.png" width="45" height="45" /></a>
<a href="admin_tipo_proyectos.php?lang=en"><img src="usa.png" width="30" height="30" /></a>
  <?php }
  if ($idioma_actual == "en"){?>
  <a href="admin_tipo_proyectos.php?lang=en"><img src="usa.png" width="45" height="45" /></a>
  <a href="admin_tipo_proyectos.php?lang=es"><img src="mexico.png" width="30" height="30" /></a>

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
            <a href="#" class="navbar-brand"><?php echo $lang['ADMIN_ZONE']?></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="admin_home.php"><?php echo $lang['ADMIN_ZONE']?></a></li>
               <li ><a href="home.php"><?php echo $lang['MEMBER_HOME']?></a></li>
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
			
				if ($nivel == "Level 5") {
					?>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['LEVEL_5_OPTIONS']?> <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="admin_welcome_message.php"><?php echo $lang['WELCOME_MESSAGE']?></a></li>
                        <li><a href="admin_news.php"><?php echo $lang['NEWS']?></a></li>
                        <li class="divider"></li>
                        <li><a href="admin_bu.php"><?php echo $lang['BUSINESS_UNITS']?></a></li>
                        <li><a href="admin_departamentos.php"><?php echo $lang['DEPARTMENTS']?></a></li>
                        <li><a href="admin_equipos.php"><?php echo $lang['TEAMS']?></a></li>
                        <li><a href="admin_miembros_equipos.php"><?php echo $lang['TEAM_MEMBERS']?></a></li>
                        <li class="divider"></li>
                        <li><a href="admin_proyectos.php"><?php echo $lang['PROJECTS']?></a></li>
                        <li><a href="admin_tipo_proyectos.php"><?php echo $lang['PROJECT_TYPES']?></a></li>
                        <li><a href="admin_evaluacion_proyectos.php"><?php echo $lang['PROJECT_EVAL']?></a></li>
                        <li class="divider"></li>
                          <li><a href="admin_historico.php"><?php echo $lang['HISTORICO']?></a></li>
                       
                        <li class="divider"></li>
                        <li><a href="admin_usuarios.php"><?php echo $lang['USERS']?></a></li>
                        
                        
                        
                    </ul>
                </li>
                <?php }?>
                
                
                
                
                
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
<div class="container">
	<div class="row">

    </div>
    </div>
</div>


    <p>&nbsp;</p>
    <h1 align="center"><?php echo $lang['PROJECT_TYPES']?></h1>
    <p align="center">&nbsp;</p>
    <div id="page_container">

      

      <div align="center">
        <button type="button" class="button" id="add_company"><?php echo $lang['ADD_PROJECT_TYPE']?></button>
        
      </div>
      <table class="datatable" id="table_companies">
        <thead>
          <tr>
           
            
            <th><?php echo $lang['PROJECT_TYPE_NAME']?></th>
            <th><?php echo $lang['PROJECT_TYPE_POINTS']?></th>
              <th><?php echo $lang['PROJECT_TYPE_REVISIONS']?></th>
              
         
            
            <th><?php echo $lang['ACTIONS']?></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

</div>

    <div class="lightbox_bg"></div>

    <div class="lightbox_container">
      <div class="lightbox_close"></div>
      <div class="lightbox_content">
        
        <h2><?php echo $lang['ADD_PROJECT_TYPE']?></h2>
        <form class="form add" id="form_company" data-id="" novalidate>
          
          <div class="input_container">
            <label for="nombre_tipo_proyecto"><?php echo $lang['PROJECT_TYPE_NAME']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="nombre_tipo_proyecto" id="nombre_tipo_proyecto" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="puntos_tipo_proyecto"><?php echo $lang['PROJECT_TYPE_POINTS']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="puntos_tipo_proyecto" id="puntos_tipo_proyecto" value="" onchange="myFunction()" required>
            </div>
          </div>
       
          <div class="input_container">
            <label for="num_revisiones"><?php echo $lang['PROJECT_TYPE_REVISIONS']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="num_revisiones" id="num_revisiones" value="" required>
            </div>
          </div>
          <hr>
          <div class="input_container">
            <label for="opcion1"><?php echo $lang['PROJECT_TYPE_OPTION1']?>: </label>
            <div class="field_container">
              <input type="text" class="text" name="opcion1" id="opcion1" value=""  >
            </div>
          </div>
                         
          <div class="input_container">
            <label for="porcentaje1"><?php echo $lang['PROJECT_TYPE_PERCENTAGE1']?>: </label>
            <div class="field_container">
              <input type="number" class="text" name="porcentaje1" id="porcentaje1" value="" onchange="myFunction()">
            </div>
          </div>
         <hr>
          <div class="input_container">
            <label for="opcion2"><?php echo $lang['PROJECT_TYPE_OPTION2']?>: </label>
            <div class="field_container">
              <input type="text" class="text" name="opcion2" id="opcion2" value="" >
            </div>
          </div>
                         
          <div class="input_container">
            <label for="porcentaje2"><?php echo $lang['PROJECT_TYPE_PERCENTAGE2']?>: </label>
            <div class="field_container">
              <input type="number" class="text" name="porcentaje2" id="porcentaje2" value="" onchange="myFunction()">
            </div>
          </div>
         <hr>
          <div class="input_container">
            <label for="opcion3"><?php echo $lang['PROJECT_TYPE_OPTION3']?>: </label>
            <div class="field_container">
              <input type="text" class="text" name="opcion3" id="opcion3" value="" >
            </div>
          </div>
                         
          <div class="input_container">
            <label for="porcentaje3"><?php echo $lang['PROJECT_TYPE_PERCENTAGE3']?>: </label>
            <div class="field_container">
              <input type="number" class="text" name="porcentaje3" id="porcentaje3" value="" onchange="myFunction()">
            </div>
          </div> 
             <hr>
          <div class="input_container">
            <label for="opcion4"><?php echo $lang['PROJECT_TYPE_OPTION4']?>: </label>
            <div class="field_container">
              <input type="text" class="text" name="opcion4" id="opcion4" value="" >
            </div>
          </div>
                         
          <div class="input_container">
            <label for="porcentaje4"><?php echo $lang['PROJECT_TYPE_PERCENTAGE4']?>: </label>
            <div class="field_container">
              <input type="number" class="text" name="porcentaje4" id="porcentaje4" value="" onchange="myFunction()">
            </div>
          </div>
       
            <hr>
          <div class="input_container">
            <label for="opcion5"><?php echo $lang['PROJECT_TYPE_OPTION5']?>: </label>
            <div class="field_container">
              <input type="text" class="text" name="opcion5" id="opcion5" value="" >
            </div>
          </div>
                         
          <div class="input_container">
            <label for="porcentaje5"><?php echo $lang['PROJECT_TYPE_PERCENTAGE5']?>: </label>
            <div class="field_container">
              <input type="number" class="text" name="porcentaje5" id="porcentaje5" value="" onchange="myFunction()">
            </div>
          </div>
          
          
             <hr>
          <div class="input_container">
            <label for="opcion6"><?php echo $lang['PROJECT_TYPE_OPTION6']?>: </label>
            <div class="field_container">
              <input type="text" class="text" name="opcion6" id="opcion6" value=""  >
            </div>
          </div>
                         
          <div class="input_container">
            <label for="porcentaje6"><?php echo $lang['PROJECT_TYPE_PERCENTAGE6']?>: </label>
            <div class="field_container">
              <input type="number" class="text" name="porcentaje6" id="porcentaje6" value="" onchange="myFunction()">
            </div>
          </div>
               <hr>
          <div class="input_container">
            <label for="opcion7"><?php echo $lang['PROJECT_TYPE_OPTION7']?>: </label>
            <div class="field_container">
              <input type="text" class="text" name="opcion7" id="opcion7" value="" >
            </div>
          </div>
                         
          <div class="input_container">
            <label for="porcentaje7"><?php echo $lang['PROJECT_TYPE_PERCENTAGE7']?>: </label>
            <div class="field_container">
              <input type="number" class="text" name="porcentaje7" id="porcentaje7" value="" onchange="myFunction()">
            </div>
          </div>
               <hr>
          <div class="input_container">
            <label for="opcion8"><?php echo $lang['PROJECT_TYPE_OPTION8']?>: </label>
            <div class="field_container">
              <input type="text" class="text" name="opcion8" id="opcion8" value="" >
            </div>
          </div>
                         
          <div class="input_container">
            <label for="porcentaje8"><?php echo $lang['PROJECT_TYPE_PERCENTAGE8']?>: </label>
            <div class="field_container">
              <input type="number" class="text" name="porcentaje8" id="porcentaje8" value="" onchange="myFunction()">
            </div>
          </div>
          
          
          
               <hr>
          <div class="input_container">
            <label for="opcion9"><?php echo $lang['PROJECT_TYPE_OPTION9']?>: </label>
            <div class="field_container">
              <input type="text" class="text" name="opcion9" id="opcion9" value="" >
            </div>
          </div>
                         
          <div class="input_container">
            <label for="porcentaje9"><?php echo $lang['PROJECT_TYPE_PERCENTAGE9']?>: </label>
            <div class="field_container">
              <input type="number" class="text" name="porcentaje9" id="porcentaje9" value="" onchange="myFunction()">
            </div>
          </div>
          
               <hr>
          <div class="input_container">
            <label for="opcion10"><?php echo $lang['PROJECT_TYPE_OPTION10']?>: </label>
            <div class="field_container">
              <input type="text" class="text" name="opcion10" id="opcion10" value="" >
            </div>
          </div>
                         
          <div class="input_container">
            <label for="porcentaje10"><?php echo $lang['PROJECT_TYPE_PERCENTAGE10']?>: </label>
            <div class="field_container">
              <input type="number" class="text" name="porcentaje10" id="porcentaje10" value="" onchange="myFunction()">
            </div>
          </div>
          <div class="button_container">
            <button type="submit"><?php echo $lang['ADD_PROJECT_TYPE']?></button>
          </div>
        </form>
        
      </div>
    </div>

    <noscript id="noscript_container">
      <div id="noscript" class="error">
        <p>JavaScript support is needed to use this page.</p>
      </div>
    </noscript>

    <div id="message_container">
      <div id="message" class="success">
        <p>This is a success message.</p>
      </div>
    </div>

    <div id="loading_container">
      <div id="loading_container2">
        <div id="loading_container3">
          <div id="loading_container4">
           <?php echo $lang['PROCESSING']?>
          </div>
        </div>
      </div>
    </div>
    
</body>
</html>
<?php

?>
