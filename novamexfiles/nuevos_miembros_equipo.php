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
  //test dell
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

//gestion ed la form


if (isset($_POST["submit"])) {//submit
	
	$usuarios=$_POST["usuarios"]; 
	 

	if (isset($_POST['usuarios'])){//usuarios
		for ($i=0;$i<count($usuarios);$i++)
		{//for
			$query = "INSERT INTO tb_miembros_equipos SET ";
			if (isset($_POST['equipo'])) { $query .= "equipo = '" . mysqli_real_escape_string($conexion, $_POST['equipo']) . "', "; }
			if (isset($_POST['fecha_alta'])) { $query .= "fecha_alta = '" . mysqli_real_escape_string($conexion, $_POST['fecha_alta']) . "', "; }
			if (isset($_POST['fecha_baja'])) { $query .= "fecha_baja = '" . mysqli_real_escape_string($conexion, $_POST['fecha_baja']) . "', "; }
			
		
			 
			$query .= "usuario = '" . $usuarios[$i] . "'";
			
			
			$query = mysqli_query($conexion, $query);
			if (!$query){//query
				$result  = 'error';
				$message = 'query error';
			
			} 
			else 
			{
				$result  = 'success';
				$message = 'query success';
				// Add company
				//add log
				$texto = "USUARIO CREA NUEVO MIEMBRO DE EQUIPO";
				$codigo = "022";
				$miemail = get_email($_SESSION['userSession']);
				add_log($texto,$miemail,$codigo);
				
				$usuario_miembro = $usuarios[$i];
				$email_usuario = get_email($usuario_miembro);
				$idioma_miembro =  get_idioma($usuario_miembro);
				$nombre_usuario = get_nombre($usuario_miembro);
				$equipo = get_team($_POST['equipo']);
				if ($idioma_miembro == "en"){
					$message = "Hi, ".$nombre_usuario."!<br><br>";
					$message .= "You have been assigned to Team: ".$equipo.".";
					$message .= "<br>from ".$_POST['fecha_alta']." to ".$_POST['fecha_baja'];
					$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
					$subject = "You have been assigned to Team ".$equipo;
					send_mail($email_usuario,$message,$subject);
				}
				else {
					$message = "Hola, ".$nombre_usuario."!<br><br>";
					$message .= "Te han asignado al equipo: ".$equipo.".";
					$message .= "<br>desde el ".$_POST['fecha_alta']." al ".$_POST['fecha_baja'];
					$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
					$subject = "Te han asignado al equipo ".$equipo;
					send_mail($email_usuario,$message,$subject);
				
				}
				 
				header("Location: admin_miembros_equipos.php" );
			}
		}//for
	}//usuarios
	
	
	
}	//submit
	
	

	


	


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
 
}
div.logo {
    position: fixed;
    left: 20px;
    top: 10px;
    width: 414px;
 
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
   


<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
<style type="text/css">
textarea {
  width: 100%;
}

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
  $(document).ready(function() {

    var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();

    $('#fecha_alta').datepicker({
        minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'yy-mm-dd'
    });;
    $('#fecha_baja').datepicker({
        minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'yy-mm-dd'
    });;
  });
  </script>

</head> 
<body>
<?php include 'menu_admin.php'?>

<div class="container">
	<div class="row">

    </div>
    </div>
</div>


   
    <div class="container">
  		<div class="row">
  			<div class="col-md-6 col-md-offset-3">
  				<h1 class="page-header text-center"><?php echo $lang['ADD_TEAM_MEMBER_MULTIPLE']?></h1>
				<form class="form-horizontal" role="form" method="post" action="nuevos_miembros_equipo.php">
				
							<div class="form-group">
						   <?php   $sqlBU="SELECT * FROM tbl_users WHERE autorizado = 1 ORDER BY apellidos_usuario";?>
						   
        <label for="expertise" class="col-sm-2 control-label"><?php echo $lang['TEAM_MEMBERS']?></label>
        <div class="col-sm-10">
        <select class="form-control inputstl" id="usuarios" name="usuarios[]" multiple>

         <?php   if ($resultusers=mysqli_query($conexion,$sqlBU))
  {
  // Fetch one and one row
  while ($rowusers=mysqli_fetch_row($resultusers))
    {
    printf ("%s (%s)\n",$rowusers[0],$rowusers[1]);
    echo '<option value='.$rowusers[0].' >'.strtoupper($rowusers[8])." ,  ".strtoupper($rowusers[7]).'</option>';
    }
 
  }
     ?>           
        
        </select>          
          
        </div>
                  
						</div>
											<div class="form-group">
						   <?php   $sqlTE="SELECT * FROM tb_equipos WHERE equipo_activo = 1 ORDER BY nombre_equipo";?>
						   
        <label for="expertise" class="col-sm-2 control-label"><?php echo $lang['TEAM']?></label>
        <div class="col-sm-10">
        <select class="form-control inputstl" id="equipo" name="equipo" required>
       
         <?php   if ($resultteams=mysqli_query($conexion,$sqlTE))
  {
  // Fetch one and one row
  while ($rowteams=mysqli_fetch_row($resultteams))
    {
    printf ("%s (%s)\n",$rowteams[0],$rowteams[1]);
    echo '<option value='.$rowteams[0].' >'.strtoupper($rowteams[1]).'</option>';
    }
 
  }
     ?>           
        
        </select>          
          
        </div>
                  
						</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label"><?php echo $lang['START_DATE']?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="fecha_alta" name="fecha_alta" placeholder="<?php echo $lang['START_DATE']?>" >
						
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label"><?php echo $lang['END_DATE']?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="fecha_baja" name="fecha_baja" placeholder="<?php echo $lang['END_DATE']?>" >
							
						</div>
					</div>
				
		
					
					
					
					
					
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="<?php echo $lang['GO']?>" class="btn btn-primary">
						</div>
					</div>
					
				</form> 
			</div>
		</div>
	</div>   

</body>
</html>
