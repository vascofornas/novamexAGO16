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


if (isset($_POST["submit"])) {
	$titulo = $_POST['titulo'];
	$texto = $_POST['texto'];
	$message = $_POST['message'];
	
	
	$emisor =  $row['userID'];
	
	$leido = "NO";
	$contestado = "NO";
	$receptores=$_POST["receptor"]; 
	$receptores_equipo=$_POST["receptor_equipo"]; 

	if (isset($_POST['receptor'])){
		for ($i=0;$i<count($receptores);$i++)
		{
			$query = "INSERT INTO tb_mensajes SET ";
			if (isset($_POST['titulo'])) { $query .= "titulo = '" . mysqli_real_escape_string($conexion, $_POST['titulo']) . "', "; }
			if (isset($_POST['texto'])) { $query .= "texto = '" . mysqli_real_escape_string($conexion, $_POST['texto']) . "', "; }
			if (isset($_POST['receptor'])) { $query .= "receptor = '" . $receptores[$i] . "', "; }
			 
			 
			$query .= "emisor = '" . $row['userID'] . "'";
			
			
			$query = mysqli_query($conexion, $query);
			if (!$query){
				$result  = 'error';
				$message = 'query error';
			} else {
				$result  = 'success';
				$message = 'query success';
			}
		}
	}
	if (isset($_POST['receptor_equipo'])){
	
		

	for ($j=0;$j<count($receptores_equipo);$j++)
	{
		
		$team = $receptores_equipo[$j];
	
	
	$sql = "SELECT usuario FROM tb_miembros_equipos WHERE equipo = '".$team."'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    
    while($row1 = $result->fetch_assoc()) {
    	$user =  $row1['usuario'];
    	
    	mysqli_query($conexion,"INSERT INTO tb_mensajes (`titulo`, `texto`, `emisor`, `receptor`)
VALUES ('$titulo','$texto', '$emisor', '$user')")
    	or die(mysqli_error($link));
    }
} else {

}
		
		
		
		
		
		
			
		
		
				
		
		
		
		
		
		
		
		
		
	}
		
	}
	
	
	
	
	header("Location: mensajes.php" );
	
	}
	else {
		
	}

	

	
	


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

</style>

<title><?php echo $row['userName']?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout.css">
    <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script charset="utf-8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
    <script charset="utf-8" src="//cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
    <script charset="utf-8" src="webapp_mensajes.js"></script>
   


<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
<style type="text/css">
textarea {
  width: 100%;
}

body {
	background-image: url(white.jpg);
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
$(".js-example-basic-multiple").select2();
</script>
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
</head> 
<body>
 <div class="fixed">
  <?php 
  $idioma_actual = $_SESSION['lang'];
  
  
  if ($idioma_actual == "es"){?>
  <a href="nuevo_mensaje.php?lang=es"><img src="mexico.png" width="45" height="45" /></a>
<a href="nuevo_mensaje.php?lang=en"><img src="usa.png" width="30" height="30" /></a>
  <?php }
  if ($idioma_actual == "en"){?>
  <a href="nuevo_mensaje.php?lang=en"><img src="usa.png" width="45" height="45" /></a>
  <a href="nuevo_mensaje.php?lang=es"><img src="mexico.png" width="30" height="30" /></a>

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
<div class="container">
	<div class="row">

    </div>
    </div>
</div>


   
    <div class="container">
  		<div class="row">
  			<div class="col-md-6 col-md-offset-3">
  				<h1 class="page-header text-center"><?php echo $lang['ADD_MESSAGE']?></h1>
				<form class="form-horizontal" role="form" method="post" action="nuevo_mensaje.php">
				
							<div class="form-group">
						   <?php   $sqlBU="SELECT * FROM tbl_users ORDER BY apellidos_usuario";?>
						   
        <label for="expertise" class="col-sm-2 control-label">Para (seleccionar uno o varios destinatarios):</label>
        <div class="col-sm-10">
        <select class="form-control inputstl" id="receptor" name="receptor[]" multiple>

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
						   <?php   $sqlTE="SELECT * FROM tb_equipos ORDER BY nombre_equipo";?>
						   
        <label for="expertise" class="col-sm-2 control-label">Para (seleccionar uno o varios equipos):</label>
        <div class="col-sm-10">
        <select class="form-control inputstl" id="receptor_equipo" name="receptor_equipo[]" multiple>
       
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
						<label for="name" class="col-sm-2 control-label">Titulo</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" value="<?php echo htmlspecialchars($_POST['titulo']); ?>">
							<?php echo "<p class='text-danger'>$errTitulo</p>";?>
						</div>
					</div>
				
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label">Mensaje</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="10" name="texto" id="texto"  placeholder="Texto"><?php echo htmlspecialchars($_POST['texto']);?></textarea>
							<?php echo "<p class='text-danger'>$errTexto</p>";?>
						</div>
					</div>
					
		
					
					
					
					
					
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Enviar Mensaje" class="btn btn-primary">
						</div>
					</div>
					
				</form> 
			</div>
		</div>
	</div>   

</body>
</html>
